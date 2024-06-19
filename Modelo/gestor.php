<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    // Encabezados de las columnas
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

    // Encabezados de las columnas
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

    // Aplicar estilo a los encabezados para OtraTabla (ejemplo)
    $sheet->getStyle('A' . ($fila + 0) . ':F' . ($fila + 0))->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente para OtraTabla (ejemplo)
    foreach (range('A', 'F') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Encabezados de las columnas
    $sheet->setCellValue('A' . ($fila + 3), 'Codigo de la Venta');
    $sheet->setCellValue('B' . ($fila + 3), 'Fecha de la Venta');
    $sheet->setCellValue('C' . ($fila + 3), 'Hora de la Venta');
    $sheet->setCellValue('D' . ($fila + 3), 'Trabajador ');
    $sheet->setCellValue('E' . ($fila + 3), 'Cliente');
    $sheet->setCellValue('F' . ($fila + 3), 'Producto');
    $sheet->setCellValue('G' . ($fila + 3), 'Observacion de la Venta');
    $sheet->setCellValue('H' . ($fila + 3), 'Precio de la Venta');

    $fila_venta = $fila + 4;
    while ($row = $stmt_venta->fetch(PDO::FETCH_OBJ)) {
      $sheet->setCellValue('A' . $fila_venta, $row->codventa);
      $sheet->setCellValue('B' . $fila_venta, $row->fecha);
      $sheet->setCellValue('C' . $fila_venta, $row->hora);
      $sheet->setCellValue('D' . $fila_venta, $row->Usu );
      $sheet->setCellValue('E' . $fila_venta, $row->clie);
      $sheet->setCellValue('F' . $fila_venta, $row->produ);
      $sheet->setCellValue('G' . $fila_venta, $row->observacion);
      $sheet->setCellValue('H' . $fila_venta, $row->total);
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

    // Aplicar estilo a los encabezados para OtraTabla (ejemplo)
    $sheet->getStyle('A' . ($fila + 0) . ':H' . ($fila + 0))->applyFromArray($headerStyle);

    // Ajustar el ancho de las columnas automáticamente para OtraTabla (ejemplo)
    foreach (range('A', 'H') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

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
