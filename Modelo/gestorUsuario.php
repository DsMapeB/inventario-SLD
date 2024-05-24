<?php

class gestorusuario
{

  public function agregarusuario(usuario $usuario)
  {
    $conexion = new conexion();
    $docUsu = $usuario->obtenerdoc();
    $nombreUsu = $usuario->obtenernombre();
    $passwordUsu = $usuario->obtenerpassword();
    $telefonoUsu = $usuario->obtenertelefono();
    $ciudadUsu = $usuario->obtenerciudad();
    $direccionUsu = $usuario->obtenerdireccion();
    $cargoUsu = $usuario->obtenercargo();

    $sql = "INSERT INTO usuarios VALUES ('$docUsu', '$nombreUsu', '$passwordUsu' , '$telefonoUsu', '$ciudadUsu', '$direccionUsu', '$cargoUsu')";

    $conexion->ejecutar_query($sql);

    $sql2 = "SELECT * FROM usuarios WHERE docUsu=$docUsu";
    $conexion->buscar_query($sql2);

    $validar = $conexion->obtener_filas();
    if ($validar > 0) {
      $result = $conexion->obtener_resultado();
      return $result;
    } else {
      return 1;
    }
  }

  public function consultarUsu()
  {
    $conexion = new conexion();
    $sql = "SELECT * FROM usuarios";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function editarUsu($docusu)
  {
    $conexion = new conexion();
    $sql = "SELECT * FROM usuarios join rol on usuarios.cargoUsu=rol.cargoUsu WHERE docUsu = $docusu";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function actualizarUsu($usu)
  {
    $conexion = new conexion();
    $usuario = $usu;

    $docUsu = $usuario->obtenerdoc();
    $nombreUsu = $usuario->obtenernombre();
    $passwordUsu = $usuario->obtenerpassword();
    $telefonoUsu = $usuario->obtenertelefono();
    $ciudadUsu = $usuario->obtenerciudad();
    $direccionUsu = $usuario->obtenerdireccion();
    $cargoUsu = $usuario->obtenercargo();

    $sql = "UPDATE usuarios SET nombreUsu = '$nombreUsu', contraseñaUsu = '$passwordUsu', telefonoUsu = '$telefonoUsu', ciudadUsu = '$ciudadUsu', direccionUsu = '$direccionUsu', cargoUsu = '$cargoUsu' WHERE docUsu = '$docUsu'";
    $result = $conexion->ejecutar_query($sql);
    return $result;
  }

  public function eliminarUsu($usuario)
  {
    $conexion = new conexion();
    $sql = "DELETE FROM usuarios WHERE docUsu = ?";
    $params = array($usuario);
    $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
    return $filasAfectadas;
  }
}
