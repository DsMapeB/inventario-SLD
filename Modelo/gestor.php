<?php
  class gestor{
    public function login($user, $pass){
      $conexion = new conexion();
      $sql = "SELECT nombreUsu, contraseñaUsu FROM usuarios WHERE nombreUsu = '$user' AND contraseñaUsu = '$pass'";
      $conexion->buscar_query($sql);
      $existe = $conexion->obtener_filas();
      if($existe>0){
        $result = $conexion->obtener_resultado();
        $filas = $result->fetch();
        $datos = [$filas["nombreUsu"], $filas["contraseñaUsu"]];
        return $datos;
      }
      else{
        $sql2 = "SELECT nombreUsu FROM usuarios WHERE nombreUsu = '$user'";
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