<?php
class gestorusuario
{

  public function agregarusuario(usuario $usuario)
  {
    $conexion = new conexion();
    $codigoUsu = $usuario->obtenercodigo();
    $nombreUsu = $usuario->obtenernombre();
    $telefonoUsu = $usuario->obtenertelefono();
    $ciudadUsu = $usuario->obtenerciudad();
    $direccionUsu = $usuario->obtenerdireccion();
    $cargoUsu = $usuario->obtenercargo();

    $sql = "INSERT INTO usuarios VALUES ('', '$codigoUsu' , '$nombreUsu' , '$telefonoUsu', '$ciudadUsu', '$direccionUsu', '$cargoUsu')";

    $conexion->ejecutar_query($sql);
  }

  public function consultarusuario(){
    $conexion = new conexion();
    $sql = "SELECT * FROM usuarios";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }
}
