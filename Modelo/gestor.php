<?php
  class gestor{
    public function login($user, $pass){
      $conexion = new conexion();
      $sql = "SELECT usuario, password, rol FROM usuario WHERE usuario = '$user' AND password = '$pass'";
      $conexion->buscar_query($sql);
      $existe = $conexion->obtener_filas();
      if($existe>0){
        $result = $conexion->obtener_resultado();
        $filas = $result->fetch();
        $datos = [$filas["usuario"], $filas["rol"]];
        return $datos;
      }
      else{
        $sql2 = "SELECT usuario FROM usuario WHERE usuario = '$user'";
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

    public function registrar($usu){
      $conexion =  new conexion();
      $usuarios = $usu;

      $usuario = $usuarios->obtenerusuario();
      $password = $usuarios->obtenerpassword();
      $rol = $usuarios->obtenerrol();

      $sql = "SELECT usuario FROM usuario WHERE usuario = '$usuario' ";
      $conexion->buscar_query($sql);
      $result = $conexion->obtener_filas();

      if ($result>0){
        return 2;
      }
      else{
        $sql2 = "INSERT INTO usuario (usuario, password, rol) VALUES ('$usuario', '$password', '$rol')";
        $result2 = $conexion->ejecutar_query($sql2);

        if ($result2>0){
          return 1;
        } else{
          return 3;
        }
      }
    }
  }
?>