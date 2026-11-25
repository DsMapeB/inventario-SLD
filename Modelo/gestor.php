<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as SpreadsheetDrawing;

class Gestor
{
  //-------------------------------Login y Registro ------------------------------------

  /**
   * Comprueba si un valor almacenado es un hash generado por password_hash().
   */
  private function esHashPassword($valor)
  {
    if (!is_string($valor) || $valor === '') {
      return false;
    }

    $info = password_get_info($valor);

    return !empty($info['algo']);
  }

  public function login($user, $pass)
  {
    // Una contraseña vacía nunca es válida.
    if ($pass === null || $pass === '') {
      return 1;
    }

    $conexion = new Conexion();

    // Consulta preparada: el usuario nunca se concatena en el SQL.
    $sql = "SELECT usuario.Usudoc, usuario.usuario, usuario.telefono, usuario.password, usuario.foto, usuario.rol, rol.nombrerol
            FROM usuario
            JOIN rol ON usuario.rol = rol.cargoUsu
            WHERE usuario.usuario = ?
            LIMIT 1";
    $stmt = $conexion->buscar_query_preparado($sql, [$user]);
    $filas = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$filas) {
      // El usuario no existe.
      return 2;
    }

    $passwordAlmacenada = $filas['password'];
    $autenticado = false;

    // Una contraseña vacía o nula en la base de datos nunca debe autenticar.
    if ($passwordAlmacenada === null || $passwordAlmacenada === '') {
      return 1;
    }

    if ($this->esHashPassword($passwordAlmacenada)) {
      $autenticado = password_verify($pass, $passwordAlmacenada);

      // Actualiza el hash si PHP recomienda un algoritmo o coste distinto.
      if ($autenticado && password_needs_rehash($passwordAlmacenada, PASSWORD_DEFAULT)) {
        $nuevoHash = password_hash($pass, PASSWORD_DEFAULT);
        $conexion->ejecutar_query_preparado(
          "UPDATE usuario SET password = ? WHERE Usudoc = ?",
          [$nuevoHash, $filas['Usudoc']]
        );
      }
    } else {
      // Compatibilidad con contraseñas antiguas en texto plano.
      $autenticado = hash_equals((string) $passwordAlmacenada, (string) $pass);

      if ($autenticado) {
        // Migración progresiva y automática a password_hash().
        $nuevoHash = password_hash($pass, PASSWORD_DEFAULT);
        $conexion->ejecutar_query_preparado(
          "UPDATE usuario SET password = ? WHERE Usudoc = ?",
          [$nuevoHash, $filas['Usudoc']]
        );
      }
    }

    if (!$autenticado) {
      // El usuario existe pero la contraseña es incorrecta.
      return 1;
    }

    // No se devuelve la contraseña ni el hash al controlador.
    return [
      $filas["telefono"],
      $filas["usuario"],
      $filas["rol"],
      $filas["nombrerol"],
      $filas["Usudoc"],
      $filas["foto"]
    ];
  }

  public function registrar(usu $usu)
  {
    $conexion =  new Conexion();
    $usuarios = $usu;

    $doc = $usuarios->obtenerdocumento();
    $usuario = $usuarios->obtenerusuario();
    $tel = $usuarios->obtenertelefono();
    $password = $usuarios->obtenerpassword();
    $foto = $usuarios->obtenerfoto();
    $rol = $usuarios->obtenerrol();

    // No se permite registrar cuentas con contraseña vacía.
    if ($password === null || $password === '') {
      return 3;
    }

    $sql = "SELECT Usudoc FROM usuario WHERE Usudoc = ? LIMIT 1";
    $stmt = $conexion->buscar_query_preparado($sql, [$doc]);
    $existe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existe) {
      return 2;
    }

    // Nunca se almacena la contraseña en texto plano.
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql2 = "INSERT INTO usuario (Usudoc, usuario, telefono, password, foto, rol) VALUES (?, ?, ?, ?, ?, ?)";
    $result2 = $conexion->ejecutar_query_preparado(
      $sql2,
      [$doc, $usuario, $tel, $passwordHash, $foto, $rol]
    );

    if ($result2 > 0) {
      return 1;
    } else {
      return 3;
    }
  }
  //-----------------------Fin Login y Registro--------------------\\

  public function consultaTotal()
  {
    $conexion = new Conexion();
    $sql = "SELECT COUNT(*) AS cantUsu FROM usuario";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function consultaTotalProvee()
  {
    $conexion = new Conexion();
    $sql = "SELECT COUNT(*) AS cantProve FROM proveedores";
    $conexion->buscar_query($sql);
    $result2 = $conexion->obtener_resultado();
    return $result2;
  }

  public function consultaTotalProduc()
  {
    $conexion = new Conexion();
    $sql = "SELECT COUNT(*) AS cantProdu FROM producto";
    $conexion->buscar_query($sql);
    $result3 = $conexion->obtener_resultado();
    return $result3;
  }

  //------------------------------Panel------------------------------\\
  public function DescargaBD()
  {
    $conexion = new Conexion(); // Reemplaza esto con tu lógica para conectar a la base de datos
    $sql = "SELECT * FROM Proveedores";
    $conexion->buscar_query($sql);
    $stmt = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    $sql1 = "SELECT * FROM producto join proveedores on producto.nitprodu=proveedores.nitpro";
    $conexion->buscar_query($sql1);
    $stmt_produ = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    $sql2 = "SELECT venta.codventa, venta.fecha, venta.hora, venta.observacion, venta.total,
                    usuario.usuario, cliente.nombreclie, producto.nombreprodu
             FROM venta
             JOIN usuario ON venta.Usu = usuario.Usudoc
             JOIN cliente ON venta.clie = cliente.docclie
             JOIN producto ON venta.produ = producto.codprodu";
    $conexion->buscar_query($sql2);
    $stmt_venta = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    // Crear un nuevo libro de Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Informe_PPV'); // Nombrar la hoja de cálculo

    // Encabezados de las columnas para proveedores
    $sheet->setCellValue('A1', 'Nit del Proveedor');
    $sheet->setCellValue('B1', 'Nombre del Proveedor');
    $sheet->setCellValue('C1', 'Contacto del Proveedor');
    $sheet->setCellValue('D1', 'Telefono del Proveedor');
    $sheet->setCellValue('E1', 'Direccion del Proveedor');
    $sheet->setCellValue('F1', 'Ciudad del Proveedor');

    $fila = 2;
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila, $row->nitpro);
      $sheet->setCellValue('B' . $fila, $row->nombrePro);
      $sheet->setCellValue('C' . $fila, $row->contactoPro);
      $sheet->setCellValue('D' . $fila, $row->telefonoPro);
      $sheet->setCellValue('E' . $fila, $row->direccionPro);
      $sheet->setCellValue('F' . $fila, $row->ciudadPro);
      $fila++;
    }

    // Aplicar estilo a los encabezados (color de fondo, centrado y bordes)
    $headerStyle = [
      'font' => ['bold' => true],
      'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
      'borders' => [
        'allBorders' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
      'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
      ],
    ];

    $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente
    foreach (range('A', 'F') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Centramos todos los datos
    $dataStyle = [
      'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    ];
    $sheet->getStyle('A2:F' . ($fila - 1))->applyFromArray($dataStyle);

    // Encabezados de las columnas para productos
    $sheet->setCellValue('A' . ($fila + 1), 'Codigo del Producto');
    $sheet->setCellValue('B' . ($fila + 1), 'Nombre del Producto');
    $sheet->setCellValue('C' . ($fila + 1), 'Precio de Producto');
    $sheet->setCellValue('D' . ($fila + 1), 'Existencia de Producto');
    $sheet->setCellValue('E' . ($fila + 1), 'Nit del Producto/Proveedor');
    $sheet->setCellValue('F' . ($fila + 1), 'Nombre de Proveedor');

    $fila_produ = $fila + 2;
    while ($row = $stmt_produ->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_produ, $row->codprodu);
      $sheet->setCellValue('B' . $fila_produ, $row->nombreprodu);
      $sheet->setCellValue('C' . $fila_produ, $row->precioprodu);
      $sheet->setCellValue('D' . $fila_produ, $row->existenciaprodu);
      $sheet->setCellValue('E' . $fila_produ, $row->nitprodu);
      $sheet->setCellValue('F' . $fila_produ, $row->nombrePro);
      $fila_produ++;
    }

    // Aplicar estilo a los encabezados para productos
    $sheet->getStyle('A' . ($fila + 1) . ':F' . ($fila + 1))->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente para productos
    foreach (range('A', 'F') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Centramos todos los datos de productos
    $sheet->getStyle('A' . ($fila + 2) . ':F' . ($fila_produ - 1))->applyFromArray($dataStyle);

    // Encabezados de las columnas para ventas
    $sheet->setCellValue('A' . ($fila_produ + 1), 'Codigo de la Venta');
    $sheet->setCellValue('B' . ($fila_produ + 1), 'Fecha de la Venta');
    $sheet->setCellValue('C' . ($fila_produ + 1), 'Hora de la Venta');
    $sheet->setCellValue('D' . ($fila_produ + 1), 'Trabajador');
    $sheet->setCellValue('E' . ($fila_produ + 1), 'Cliente');
    $sheet->setCellValue('F' . ($fila_produ + 1), 'Producto');
    $sheet->setCellValue('G' . ($fila_produ + 1), 'Observacion de la Venta');
    $sheet->setCellValue('H' . ($fila_produ + 1), 'Precio de la Venta');

    $fila_venta = $fila_produ + 2;
    while ($row = $stmt_venta->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_venta, $row->codventa);
      $sheet->setCellValue('B' . $fila_venta, $row->fecha);
      $sheet->setCellValue('C' . $fila_venta, $row->hora);
      $sheet->setCellValue('D' . $fila_venta, $row->usuario);
      $sheet->setCellValue('E' . $fila_venta, $row->nombreclie);
      $sheet->setCellValue('F' . $fila_venta, $row->nombreprodu);
      $sheet->setCellValue('G' . $fila_venta, $row->observacion);
      $sheet->setCellValue('H' . $fila_venta, $row->total);
      $fila_venta++;
    }

    // Aplicar estilo a los encabezados para ventas
    $sheet->getStyle('A' . ($fila_produ + 1) . ':H' . ($fila_produ + 1))->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente para ventas
    foreach (range('A', 'H') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Centramos todos los datos de ventas
    $sheet->getStyle('A' . ($fila_produ + 2) . ':H' . ($fila_venta - 1))->applyFromArray($dataStyle);

    // Guardar el archivo Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'Informe_PPV.xlsx'; // Nombre del archivo

    // Limpiar el búfer de salida antes de enviar las cabeceras HTTP
    ob_end_clean();

    // Configurar cabeceras para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Leer y enviar el archivo Excel al navegador
    $writer->save('php://output');
    exit;
  }

  ///--------------------------------------------------//---------------------------------------------//

  public function DescargaBDUC()
  {
    $conexion = new Conexion(); // Supongamos que esta es tu clase de conexión a la base de datos
    // Se seleccionan solo columnas necesarias: nunca se consulta ni exporta el password.
    $sql = "SELECT usuario.Usudoc, usuario.usuario, usuario.telefono, rol.nombrerol
            FROM usuario
            JOIN rol ON usuario.rol = rol.cargoUsu";
    $conexion->buscar_query($sql);
    $stmt = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    $sql2 = "SELECT * FROM cliente";
    $conexion->buscar_query($sql2);
    $stmt2 = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    $sql3 = "SELECT * FROM proveedores";
    $conexion->buscar_query($sql3);
    $stmt3 = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    $sql4 = "SELECT * FROM producto JOIN proveedores ON producto.nitprodu = proveedores.nitpro";
    $conexion->buscar_query($sql4);
    $stmt4 = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    $sql5 = "SELECT venta.codventa, venta.fecha, venta.hora, venta.observacion, venta.total,
                    usuario.usuario, cliente.nombreclie, producto.nombreprodu
             FROM venta
             JOIN usuario ON venta.Usu = usuario.Usudoc
             JOIN cliente ON venta.clie = cliente.docclie
             JOIN producto ON venta.produ = producto.codprodu";
    $conexion->buscar_query($sql5);
    $stmt5 = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    // Crear un nuevo libro de Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Informe_TCPPV'); // Nombrar la hoja de cálculo

    // Encabezados de las columnas para Trabajadores (sin contraseña)
    $sheet->setCellValue('A1', 'Documento del Trabajador');
    $sheet->setCellValue('B1', 'Nombre del Trabajador');
    $sheet->setCellValue('C1', 'Telefono del Trabajador');
    $sheet->setCellValue('D1', 'Rol del Trabajador');

    $fila_trabajador = 2;
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_trabajador, $row->Usudoc);
      $sheet->setCellValue('B' . $fila_trabajador, $row->usuario);
      $sheet->setCellValue('C' . $fila_trabajador, $row->telefono);
      $sheet->setCellValue('D' . $fila_trabajador, $row->nombrerol);
      $fila_trabajador++;
    }

    // Aplicar estilo a los encabezados (color de fondo, centrado y bordes)
    $headerStyle = [
      'font' => ['bold' => true],
      'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
      'borders' => [
        'allBorders' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
      'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
      ],
    ];

    $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

    // Centramos todos los datos
    $dataStyle = [
      'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    ];

    // Ajustar el ancho de las columnas automáticamente
    foreach (range('A', 'D') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    $sheet->getStyle('A2:D' . ($fila_trabajador - 1))->applyFromArray($dataStyle);

    // Encabezados de las columnas para clientes
    $fila_En_cliente = $fila_trabajador + 1;
    $sheet->setCellValue('A' . ($fila_En_cliente + 1), 'Documento del Cliente');
    $sheet->setCellValue('B' . ($fila_En_cliente + 1), 'Nombre del Cliente');
    $sheet->setCellValue('C' . ($fila_En_cliente + 1), 'Telefono del Cliente');

    $fila_cliente = $fila_En_cliente + 2;
    while ($row = $stmt2->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_cliente, $row->docclie);
      $sheet->setCellValue('B' . $fila_cliente, $row->nombreclie);
      $sheet->setCellValue('C' . $fila_cliente, $row->telefonoclie);
      $fila_cliente++;
    }

    // Aplicar estilo a los encabezados para clientes
    $sheet->getStyle('A' . ($fila_En_cliente + 1) . ':C' . ($fila_En_cliente + 1))->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente para clientes
    foreach (range('A', 'C') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Centramos todos los datos de clientes
    $sheet->getStyle('A' . ($fila_En_cliente + 2) . ':C' . ($fila_cliente - 1))->applyFromArray($dataStyle);

    // Encabezados de las columnas para proveedores
    $fila_En_proveedor = $fila_cliente + 1;
    $sheet->setCellValue('A' . ($fila_En_proveedor + 1), 'Nit del Proveedor');
    $sheet->setCellValue('B' . ($fila_En_proveedor + 1), 'Nombre del Proveedor');
    $sheet->setCellValue('C' . ($fila_En_proveedor + 1), 'Contacto del Proveedor');
    $sheet->setCellValue('D' . ($fila_En_proveedor + 1), 'Telefono del Proveedor');
    $sheet->setCellValue('E' . ($fila_En_proveedor + 1), 'Direccion del Proveedor');
    $sheet->setCellValue('F' . ($fila_En_proveedor + 1), 'Ciudad del Proveedor');

    $fila_proveedor = $fila_En_proveedor + 2;
    while ($row = $stmt3->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_proveedor, $row->nitpro);
      $sheet->setCellValue('B' . $fila_proveedor, $row->nombrePro);
      $sheet->setCellValue('C' . $fila_proveedor, $row->contactoPro);
      $sheet->setCellValue('D' . $fila_proveedor, $row->telefonoPro);
      $sheet->setCellValue('E' . $fila_proveedor, $row->direccionPro);
      $sheet->setCellValue('F' . $fila_proveedor, $row->ciudadPro);
      $fila_proveedor++;
    }

    // Aplicar estilo a los encabezados para proveedores
    $sheet->getStyle('A' . ($fila_En_proveedor + 1) . ':F' . ($fila_En_proveedor + 1))->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente para proveedores
    foreach (range('A', 'F') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Centramos todos los datos de proveedores
    $sheet->getStyle('A' . ($fila_En_proveedor + 2) . ':F' . ($fila_proveedor - 1))->applyFromArray($dataStyle);

    // Encabezados de las columnas para productos
    $fila_En_producto = $fila_proveedor + 1;
    $sheet->setCellValue('A' . ($fila_En_producto + 1), 'Codigo del Producto');
    $sheet->setCellValue('B' . ($fila_En_producto + 1), 'Nombre del Producto');
    $sheet->setCellValue('C' . ($fila_En_producto + 1), 'Precio de Producto');
    $sheet->setCellValue('D' . ($fila_En_producto + 1), 'Existencia de Producto');
    $sheet->setCellValue('E' . ($fila_En_producto + 1), 'Nit del Producto/Proveedor');
    $sheet->setCellValue('F' . ($fila_En_producto + 1), 'Nombre de Proveedor');

    $fila_producto = $fila_En_producto + 2;
    while ($row = $stmt4->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_producto, $row->codprodu);
      $sheet->setCellValue('B' . $fila_producto, $row->nombreprodu);
      $sheet->setCellValue('C' . $fila_producto, $row->precioprodu);
      $sheet->setCellValue('D' . $fila_producto, $row->existenciaprodu);
      $sheet->setCellValue('E' . $fila_producto, $row->nitprodu);
      $sheet->setCellValue('F' . $fila_producto, $row->nombrePro);
      $fila_producto++;
    }

    // Aplicar estilo a los encabezados para productos
    $sheet->getStyle('A' . ($fila_En_producto + 1) . ':F' . ($fila_En_producto + 1))->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente para productos
    foreach (range('A', 'F') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Centramos todos los datos de productos
    $sheet->getStyle('A' . ($fila_En_producto + 2) . ':F' . ($fila_producto - 1))->applyFromArray($dataStyle);

    // Encabezados de las columnas para ventas
    $fila_En_venta = $fila_producto + 1;
    $sheet->setCellValue('A' . ($fila_En_venta + 1), 'Codigo de la Venta');
    $sheet->setCellValue('B' . ($fila_En_venta + 1), 'Fecha de la Venta');
    $sheet->setCellValue('C' . ($fila_En_venta + 1), 'Hora de la Venta');
    $sheet->setCellValue('D' . ($fila_En_venta + 1), 'Trabajador');
    $sheet->setCellValue('E' . ($fila_En_venta + 1), 'Cliente');
    $sheet->setCellValue('F' . ($fila_En_venta + 1), 'Producto');
    $sheet->setCellValue('G' . ($fila_En_venta + 1), 'Observacion de la Venta');
    $sheet->setCellValue('H' . ($fila_En_venta + 1), 'Precio de la Venta');

    $fila_venta = $fila_En_venta + 2;
    while ($row = $stmt5->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_venta, $row->codventa);
      $sheet->setCellValue('B' . $fila_venta, $row->fecha);
      $sheet->setCellValue('C' . $fila_venta, $row->hora);
      $sheet->setCellValue('D' . $fila_venta, $row->usuario);
      $sheet->setCellValue('E' . $fila_venta, $row->nombreclie);
      $sheet->setCellValue('F' . $fila_venta, $row->nombreprodu);
      $sheet->setCellValue('G' . $fila_venta, $row->observacion);
      $sheet->setCellValue('H' . $fila_venta, $row->total);
      $fila_venta++;
    }

    // Aplicar estilo a los encabezados para ventas
    $sheet->getStyle('A' . ($fila_En_venta + 1) . ':H' . ($fila_En_venta + 1))->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente para ventas
    foreach (range('A', 'H') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Centramos todos los datos de ventas
    $sheet->getStyle('A' . ($fila_En_venta + 2) . ':H' . ($fila_venta - 1))->applyFromArray($dataStyle);

    // Guardar el archivo Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'Informe_TCPPV.xlsx'; // Nombre del archivo

    // Limpiar el búfer de salida antes de enviar las cabeceras HTTP
    ob_end_clean();

    // Configurar cabeceras para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Leer y enviar el archivo Excel al navegador
    $writer->save('php://output');
    exit;
  }
//---------------------------------------------------//-----------------------------------------------//

  public function consultarUsu()
  {
    $conexion = new Conexion();
    // No se consulta el password para no transportarlo a la vista.
    $sql = "SELECT usuario.Usudoc, usuario.usuario, usuario.telefono, usuario.foto, usuario.rol, rol.nombrerol
            FROM usuario
            JOIN rol ON usuario.rol = rol.cargoUsu";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function agregarUsuario(usu $usuarios)
  {
    $conexion = new Conexion();
    $doc = $usuarios->obtenerdocumento();
    $usuario = $usuarios->obtenerusuario();
    $tel = $usuarios->obtenertelefono();
    $password = $usuarios->obtenerpassword();
    $foto = $usuarios->obtenerfoto();
    $rol = $usuarios->obtenerrol();

    // No se permite crear usuarios con contraseña vacía.
    if ($password === null || $password === '') {
      return 3;
    }

    $sql2 = "SELECT Usudoc FROM usuario WHERE Usudoc = ? LIMIT 1";
    $stmt = $conexion->buscar_query_preparado($sql2, [$doc]);
    $validar = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($validar) {
      return 2;
    }

    // Toda contraseña nueva se guarda con password_hash().
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (Usudoc, usuario, telefono, password, foto, rol) VALUES (?, ?, ?, ?, ?, ?)";
    $result = $conexion->ejecutar_query_preparado(
      $sql,
      [$doc, $usuario, $tel, $passwordHash, $foto, $rol]
    );
    if ($result > 0) {
      return 1;
    } else {
      return 3;
    }
  }

  public function editarUsu($doc)
  {
    $conexion = new Conexion();
    // No se devuelve el password; la vista ya no lo necesita.
    $sql = "SELECT usuario.Usudoc, usuario.usuario, usuario.telefono, usuario.foto, usuario.rol, rol.nombrerol
            FROM usuario
            JOIN rol ON usuario.rol = rol.cargoUsu
            WHERE usuario.Usudoc = ?
            LIMIT 1";
    $stmt = $conexion->buscar_query_preparado($sql, [$doc]);
    return $stmt;
  }

  public function consultarRolUsu()
  {
    $conexion = new Conexion();
    $sql2 = "SELECT * FROM rol";
    $conexion->buscar_query($sql2);
    $result2 = $conexion->obtener_resultado();
    return $result2;
  }

  public function actualizarUsu($usu)
  {
    $conexion = new Conexion();
    $doc = $usu->obtenerdocumento();
    $usuario = $usu->obtenerusuario();
    $telefono = $usu->obtenertelefono();
    $password = $usu->obtenerpassword();
    $foto = $usu->obtenerfoto();
    $rol = $usu->obtenerrol();

    // Recupera la contraseña actual para no perderla si el campo viene vacío.
    $stmt = $conexion->buscar_query_preparado(
      "SELECT password FROM usuario WHERE Usudoc = ? LIMIT 1",
      [$doc]
    );
    $actual = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$actual) {
      return 2;
    }

    $passwordFinal = $actual['password'];

    if ($password !== null && $password !== '') {
      // Solo se reemplaza cuando el formulario envía una contraseña nueva.
      $passwordFinal = password_hash($password, PASSWORD_DEFAULT);
    }

    $sql = "UPDATE usuario SET usuario = ?, telefono = ?, password = ?, foto = ?, rol = ? WHERE Usudoc = ?";
    $params = [$usuario, $telefono, $passwordFinal, $foto, $rol, $doc];

    $result = $conexion->ejecutar_query_preparado($sql, $params);

    if ($result > 0) {
      return 1;
    } else {
      return 2;
    }
  }


  public function eliminarUsu($usuario)
  {
    $conexion = new Conexion();
    $sql = "DELETE FROM usuario WHERE Usudoc = :usuario";
    $params = array(':usuario' => $usuario);
    $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
    return $filasAfectadas;
  }

  // ------------------------------------ Perfil --------------------------------------------------------------
  public function editarP()
  {
    $conexion = new Conexion();
    $sql = "SELECT usuario.Usudoc, usuario.usuario, usuario.telefono, usuario.foto, usuario.rol, rol.nombrerol
            FROM usuario
            JOIN rol ON usuario.rol = rol.cargoUsu
            WHERE usuario.Usudoc = ?
            LIMIT 1";
    $stmt = $conexion->buscar_query_preparado($sql, [$_SESSION['Usudoc']]);
    return $stmt;
  }

  public function actualizarPerfil($usu)
  {
    $conexion = new Conexion();

    $doc = $_SESSION["Usudoc"];
    $user = $usu;

    $tel = $user->obtenertelefono();
    $usuario = $user->obtenerusuario();
    $password = $user->obtenerpassword();
    $foto = $user->obtenerfoto();
    $rol = $user->obtenerrol(); // Aunque no se use, podemos obtenerlo para mantener el código consistente

    // Recupera la contraseña actual para conservarla si el campo viene vacío.
    $stmt = $conexion->buscar_query_preparado(
      "SELECT password FROM usuario WHERE Usudoc = ? LIMIT 1",
      [$doc]
    );
    $actual = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$actual) {
      return 2;
    }

    $passwordFinal = $actual['password'];

    if ($password !== null && $password !== '') {
      $passwordFinal = password_hash($password, PASSWORD_DEFAULT);
    }

    // Actualizar solo los campos editables.
    $sql = "UPDATE usuario SET usuario = ?, telefono = ?, password = ?, foto = ? WHERE Usudoc = ?";
    $result = $conexion->ejecutar_query_preparado(
      $sql,
      [$usuario, $tel, $passwordFinal, $foto, $doc]
    );

    if ($result > 0) {
      return 1;
    } else {
      return 2;
    }
  }

  // ------------------------------------- fin Perfil ---------------------------------------------------------

  //---------------------------------------------------------------roles-------------------------------------------------------------------
  public function agregarRol(roles $rol1)
  {
    $conexion = new Conexion();
    $cargo = $rol1->obtenerrol();
    $sql2 = "SELECT cargoUsu FROM rol WHERE nombrerol = ? LIMIT 1";
    $stmt = $conexion->buscar_query_preparado($sql2, [$cargo]);
    $validar = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($validar) {
      return 2;
    }

    $sql = "INSERT INTO rol (nombrerol) VALUES (?)";
    $result = $conexion->ejecutar_query_preparado($sql, [$cargo]);
    if ($result > 0) {
      return 1;
    } else {
      return 3;
    }
  }

  public function consultarRol()
  {
    $conexion = new Conexion();
    $sql = "SELECT * FROM rol";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function editarRol($nomrol)
  {
    $conexion = new Conexion();
    $sql = "SELECT cargoUsu, nombrerol FROM rol WHERE cargoUsu = ? LIMIT 1";
    $stmt = $conexion->buscar_query_preparado($sql, [$nomrol]);
    return $stmt;
  }

  public function actualizarRol(roles $nomrol, $num)
  {
    $conexion = new Conexion();
    $cargo = $nomrol->obtenerrol();

    $sql = "UPDATE rol SET nombrerol = ? WHERE cargoUsu = ?";
    $result = $conexion->ejecutar_query_preparado($sql, [$cargo, $num]);
    if ($result > 0) {
      return 1;
    } else {
      return 2;
    }
  }

  public function eliminarRol($rol)
  {
    $conexion = new Conexion();
    $sql = "DELETE FROM rol WHERE cargoUsu = ?";
    $params = array($rol);
    $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
    return $filasAfectadas;
  }
}
