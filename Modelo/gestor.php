<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as SpreadsheetDrawing;

class Gestor
{
  //-------------------------------Login y Registro ------------------------------------
  public function login($user, $pass)
  {
    $conexion = new Conexion();
    $sql = "SELECT * FROM usuario join rol on usuario.rol=rol.cargoUsu WHERE usuario = '$user' AND password = '$pass'";
    $conexion->buscar_query($sql);
    $existe = $conexion->obtener_filas();
    if ($existe > 0) {
      $result = $conexion->obtener_resultado();
      $filas = $result->fetch();
      $datos = [$filas["telefono"], $filas["usuario"], $filas["rol"], $filas["password"], $filas["nombrerol"], $filas["Usudoc"], $filas["foto"]];
      return $datos;
    } else {
      $sql2 = "SELECT usuario FROM usuario WHERE usuario = '$user'";
      $conexion->buscar_query($sql2);
      $existe2 = $conexion->obtener_filas();

      if ($existe2 > 0) {
        return 1;
      } else {
        return 2;
      }
    }
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

    $sql = "SELECT usuario FROM usuario WHERE Usudoc = '$doc' ";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_filas();

    if ($result > 0) {
      return 2;
    } else {
      $sql2 = "INSERT INTO usuario (Usudoc, usuario, telefono, password, foto, rol) VALUES ('$doc', '$usuario', '$tel', '$password', '$foto', '$rol')";
      $result2 = $conexion->ejecutar_query($sql2);

      if ($result2 > 0) {
        return 1;
      } else {
        return 3;
      }
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

    $sql2 = "SELECT * FROM venta join usuario on venta.Usu=usuario.Usudoc join cliente on venta.clie=cliente.docclie join producto on venta.produ=producto.codprodu";
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
    $sql = "SELECT * FROM usuario JOIN rol ON usuario.rol = rol.cargoUsu";
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

    $sql5 = "SELECT * FROM venta JOIN usuario ON venta.Usu = usuario.Usudoc JOIN cliente ON venta.clie = cliente.docclie JOIN producto ON venta.produ = producto.codprodu";
    $conexion->buscar_query($sql5);
    $stmt5 = $conexion->obtener_resultado(); // Obtener el objeto PDOStatement

    // Crear un nuevo libro de Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Informe_TCPPV'); // Nombrar la hoja de cálculo

    // Encabezados de las columnas para Trabajadores
    $sheet->setCellValue('A1', 'Documento del Trabajador');
    $sheet->setCellValue('B1', 'Nombre del Trabajador');
    $sheet->setCellValue('C1', 'Telefono del Trabajador');
    $sheet->setCellValue('D1', 'Contraseña del Trabajador');
    $sheet->setCellValue('E1', 'Rol del Trabajador');

    $fila_trabajador = 2;
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_trabajador, $row->Usudoc);
      $sheet->setCellValue('B' . $fila_trabajador, $row->usuario);
      $sheet->setCellValue('C' . $fila_trabajador, $row->telefono);
      $sheet->setCellValue('D' . $fila_trabajador, $row->password);
      $sheet->setCellValue('E' . $fila_trabajador, $row->nombrerol);
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

    $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

    // Centramos todos los datos
    $dataStyle = [
      'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    ];

    // Ajustar el ancho de las columnas automáticamente
    foreach (range('A', 'E') as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    $sheet->getStyle('A2:E' . ($fila_trabajador - 1))->applyFromArray($dataStyle);

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
    $sql = "SELECT * FROM usuario join rol on usuario.rol=rol.cargoUsu";
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

    $sql2 = "SELECT usuario FROM usuario WHERE Usudoc = $doc";
    $conexion->buscar_query($sql2);
    $validar = $conexion->obtener_filas();
    if ($validar > 0) {
      return 2;
    } else {
      $sql = "INSERT INTO usuario (Usudoc, usuario, telefono, password, foto, rol) VALUES ('$doc', '$usuario', '$tel', '$password', '$foto', '$rol')";
      $result = $conexion->ejecutar_query($sql);
      if ($result > 0) {
        return 1;
      } else {
        return 3;
      }
    }
  }

  public function editarUsu($doc)
  {
    $conexion = new Conexion();
    $sql = "SELECT * FROM usuario join rol on usuario.rol=rol.cargoUsu WHERE Usudoc = '$doc'";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
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

    $sql = "UPDATE usuario SET usuario = ?, telefono = ?, password = ?, foto = ?, rol = ? WHERE Usudoc = ?";
    $params = [$usuario, $telefono, $password, $foto, $rol, $doc];

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
    $sql = "SELECT * FROM usuario join rol on usuario.rol=rol.cargoUsu WHERE Usudoc ='" . $_SESSION['Usudoc'] . "'";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
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

    // Actualizar solo los campos editables
    $sql = "UPDATE usuario SET usuario = '$usuario', telefono = '$tel', password = '$password', foto = '$foto' WHERE Usudoc = '$doc'";
    $result = $conexion->ejecutar_query($sql);

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
    $sql2 = "SELECT * FROM rol WHERE nombrerol='$cargo'";
    $conexion->buscar_query($sql2);
    $validar = $conexion->obtener_filas();
    if ($validar > 0) {
      return 2;
    } else {
      $sql = "INSERT INTO rol (nombrerol) VALUES ('$cargo')";
      $result = $conexion->ejecutar_query($sql);
      if ($result > 0) {
        return 1;
      } else {
        return 3;
      }
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
    $sql = "SELECT * FROM rol WHERE cargoUsu = '$nomrol'";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function actualizarRol(roles $nomrol, $num)
  {
    $conexion = new Conexion();
    $cargo = $nomrol->obtenerrol();

    $sql = "UPDATE rol SET nombrerol = '$cargo' WHERE cargoUsu = '$num'";
    $result = $conexion->ejecutar_query($sql);
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
