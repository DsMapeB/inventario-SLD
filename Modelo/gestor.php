<?php
class gestor
{
  //-------------------------------Login y Registro ------------------------------------
  public function login($user, $pass)
  {
    $conexion = new conexion();
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
    $conexion =  new conexion();
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


  //------------------------------Panel------------------------------\\
  public function consultarUsu()
  {
    $conexion = new conexion();
    $sql = "SELECT * FROM usuario join rol on usuario.rol=rol.cargoUsu";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function agregarUsuario(usu $usuarios)
  {
    $conexion = new conexion();
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
    $conexion = new conexion();
    $sql = "SELECT * FROM usuario WHERE Usudoc = '$doc'";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function actualizarUsu($usu)
  {
    $conexion = new conexion();
    $doc = $usu->obtenerdocumento();
    $usuario = $usu->obtenerusuario();
    $password = $usu->obtenerpassword();
    $foto = $usu->obtenerfoto();
    $rol = $usu->obtenerrol();

    $sql = "UPDATE usuario SET usuario = '$usuario', password = '$password', foto = '$foto', rol = '$rol' WHERE Usudoc = '$doc'";
    $result = $conexion->ejecutar_query($sql);
    if ($result > 0) {
      return 1;
    } else {
      return 2;
    }
  }

  public function eliminarUsu($usuario)
  {
    $conexion = new conexion();
    $sql = "DELETE FROM usuario WHERE Usudoc = ?";
    $params = array($usuario);
    $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
    return $filasAfectadas;
  }

  // ------------------------------------ Perfil --------------------------------------------------------------
  public function editarP()
  {
    $conexion = new conexion();
    $sql = "SELECT * FROM usuario join rol on usuario.rol=rol.cargoUsu WHERE Usudoc ='" . $_SESSION['Usudoc'] . "'";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function actualizarPerfil($usu)
  {
      $conexion = new conexion();
  
      $doc = $_SESSION["Usudoc"];
      $user = $usu;
  
      $tel = $user->obtenertelefono();
      $usuario = $user->obtenerusuario();
      $password = $user->obtenerpassword();
      $foto = $user->obtenerfoto();
      $rol = $user->obtenerrol(); // Aunque no se use, podemos obtenerlo para mantener el código consistente
  
      // Actualizar solo los campos editables
      $sql = "UPDATE usuario SET telefono = '$tel', password = '$password', foto = '$foto' WHERE Usudoc = '$doc' AND usuario = '$usuario'";
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
    $conexion = new conexion();
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
    $conexion = new conexion();
    $sql = "SELECT * FROM rol";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function editarRol($nomrol){
    $conexion = new conexion();
    $sql = "SELECT * FROM rol WHERE cargoUsu = '$nomrol'";
    $conexion->buscar_query($sql);
    $result = $conexion->obtener_resultado();
    return $result;
  }

  public function actualizarRol(roles $nomrol, $num){
    $conexion = new conexion();
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
    $conexion = new conexion();
    $sql = "DELETE FROM rol WHERE cargoUsu = ?";
    $params = array($rol);
    $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
    return $filasAfectadas;
  }
}
