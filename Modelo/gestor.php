<?php
  class gestor{
    public function login($user, $pass){
      $conexion = new conexion();
      $sql = "SELECT usuario, password, id FROM usuario WHERE usuario = '$user' AND password = '$pass'";
      $conexion->buscar_query($sql);
      $existe = $conexion->obtener_filas();
      if($existe>0){
        $result = $conexion->obtener_resultado();
        $filas = $result->fetch();
        $datos = [$filas["usuario"], $filas["id"]];
        return $datos;
      }
      else{
        $sql2 = "SELECT usuario, password FROM usuario WHERE usuario = '$user'";
        $conexion->buscar_query($sql2);
        $existe2 = $conexion->obtener_filas();

        if($existe2>0){
          return 1;
        }
        else{
          return 2;
        }
      }
    }
  }
?>