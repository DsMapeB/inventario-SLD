<?php

class gestorusuario
{

  public function agregarusuario(usuario $usuario)
  {
    $conexion = new conexion();
    $codigoUsu = $usuario->obtenercodigo();
    $docUsu = $usuario->obtenerdoc();
    $nombreUsu = $usuario->obtenernombre();
    $telefonoUsu = $usuario->obtenertelefono();
    $ciudadUsu = $usuario->obtenerciudad();
    $direccionUsu = $usuario->obtenerdireccion();
    $fotoUsu = $usuario->obtenerfoto();
    $cargoUsu = $usuario->obtenercargo();

    $sql = "INSERT INTO usuarios VALUES ('', '$codigoUsu' ,'$docUsu', '$nombreUsu' , '$telefonoUsu', '$ciudadUsu', '$direccionUsu','$fotoUsu', '$cargoUsu')";

    $conexion->ejecutar_query($sql);

    $sql2 = "SELECT * FROM usuarios WHERE docUsu=$docUsu";
    $conexion->buscar_query($sql2);

    $validar = $conexion->obtener_filas();
      if ($validar>0){
        $result=$conexion->obtener_resultado();
        return $result;
      } else{
        return 1;
      }
  }

  public function consultarusuarios(){
    $conexion = new conexion();
    $sql = "SELECT * FROM usuarios";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }
}
