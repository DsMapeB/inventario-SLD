<?php
class controlador
{
  public function verpagina($url)
  {
    require_once($url);
  }

  //------------------------------Login Y Registro---------------------------------
  public function login($user, $pass)
  {
    $gestor = new gestor();
    $result = $gestor->login($user, $pass);
    if ($result != 1 && $result != 2 && $result != 3 && $result != 4 && $result != 5 && $result != 6 ) {
      $_SESSION["telefono"] = $result[0];
      $_SESSION["usuario"] = $result[1];
      $_SESSION["rol"] = $result[2];
      $_SESSION["password"] = $result[3];
      $_SESSION["nombrerol"] = $result[4];
      $_SESSION["Usudoc"] = $result[5];
      $_SESSION["foto"] = $result[6];
      require_once("Vista/html/inicio.php");
    }
    if ($result == 1) {
      header("Location:index.php?accion=log&error=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=log&error=2");
    }
  }

  public function logout()
  {
    if (isset($_SESSION["usuario"])) {
      unset($_SESSION["usuario"]);
    }
    session_destroy();
    header("Location:index.php");
  }

  public function registrar($doc,$usu,$tel, $pass, $foto, $rol)
  {
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
      $rutaimg = 'uploads/';

      $fotoname = $_FILES['foto']['name'];

      move_uploaded_file($_FILES['foto']['tmp_name'], $rutaimg . $fotoname);

      $foto = $rutaimg . $fotoname;
    } else {
      $foto = '';
    }


    $usu = new usu($doc,$usu,$tel, $pass, $foto, $rol);
    $gestor = new gestor();
    $result = $gestor->registrar($usu);

    if ($result == 1) {
      /***   Registro satisfactorio    ***/
      header("Location:index.php?accion=registro&error=1");
    }
    if ($result == 2) {
      /***   Usuario Repetido    ***/
      header("Location:index.php?accion=registro&error=2");
    }
    if ($result == 3) {
      /***   Error en registro    ***/
      header("Location:index.php?accion=registro&error=3");
    }
  }

  //----------------------------------Panel--------------------------------------\\
  public function consultarUsu()
  {
    $gestor = new gestor();
    $result = $gestor->consultarUsu();
    require_once 'Vista/html/consultarUsu.php';
  }

  public function agregarUsuario($doc,$usu,$tel, $pass, $foto, $rol)
  {
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
      $rutaimg = 'uploads/';

      $fotoname = $_FILES['foto']['name'];

      move_uploaded_file($_FILES['foto']['tmp_name'], $rutaimg . $fotoname);

      $foto = $rutaimg . $fotoname;
    } else {
      $foto = '';
    }
    $usuarios = new usu($doc,$usu,$tel, $pass, $foto, $rol);
    $gestor = new gestor();
    $result = $gestor->agregarUsuario($usuarios);
    if ($result == 1) {
      /***   Registro satisfactorio    ***/
      header("Location:index.php?accion=usuario&error=1");
    }
    if ($result == 2) {
      /***   Usuario Repetido    ***/
      header("Location:index.php?accion=usuario&error=2");
    }
    if ($result == 3) {
      /***   Error en registro    ***/
      header("Location:index.php?accion=usuario&error=3");
    }
  }

  public function editarUsu($doc)
  {
    $gestor = new gestor();
    $result = $gestor->editarUsu($doc);
    require_once 'Vista/html/modalEditusu.php';
  }

  public function actualizarUsu($doc,$usu,$tel, $pass, $foto, $rol)
  {
    if ($foto['error'] === UPLOAD_ERR_OK) {
      $rutaimg = 'uploads/';
      $fotoname = $foto['name'];
      move_uploaded_file($foto['tmp_name'], $rutaimg . $fotoname);
      $foto = $rutaimg . $fotoname;
    } else {
      $foto = ''; // Opcionalmente, puedes establecer un valor predeterminado si no se carga ninguna imagen.
    }
    $usu = new usu($doc,$usu,$tel, $pass, $foto, $rol);
    $gestor = new gestor();
    $result = $gestor->actualizarUsu($usu);
    if ($result == 1) {
      header("Location:index.php?accion=usuario&error2=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=usuario&error2=2");
    }
  }

  public function eliminarUsu($doc)
  {
    $gestor = new gestor();
    $registro = $gestor->eliminarUsu($doc);
    if ($registro > 0) {
      echo "El Usuario se ha eliminado con exito";
    } else {
      echo "El Usuario no se ha podido eliminar";
    }
  }


  //------------------------------------- Perfil --------------------------------
  public function editarP()
  {
    $gestor = new gestor();
    $result = $gestor->editarP();
    require_once 'Vista/html/modaleditPerfil.php';
  }

  public function actualizarPerfil($doc,$usu,$tel, $pass, $foto, $rol)
  {
    if ($foto['error'] === UPLOAD_ERR_OK) {
      $rutaimg = 'uploads/';
      $fotoname = $foto['name'];
      move_uploaded_file($foto['tmp_name'], $rutaimg . $fotoname);
      $foto = $rutaimg . $fotoname;
    } else {
      $foto = ''; // Opcionalmente, puedes establecer un valor predeterminado si no se carga ninguna imagen.
    }
    $usu = new usu($doc,$usu,$tel, $pass, $foto, $rol);
    $gestor = new gestor();
    $result = $gestor->actualizarPerfil($usu);
    if ($result == 1) {
      header("Location:index.php?accion=perfil&error=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=perfil&error=2");
    }
  }

  //----------------------------------------------------roles-----------------------------------------------------------------
  public function agregarRol($rol)
  {
    $rol1 = new roles($rol);
    $gestor = new gestor();
    $result = $gestor->agregarRol($rol1);
    if ($result == 1) {
      /***   Registro satisfactorio    ***/
      header("Location:index.php?accion=rol&error=1");
    }
    if ($result == 2) {
      /***   Usuario Repetido    ***/
      header("Location:index.php?accion=rol&error=2");
    }
    if ($result == 3) {
      /***   Error en registro    ***/
      header("Location:index.php?accion=rol&error=3");
    }
  }

  public function consultarRol()
  {
    $gestor = new gestor();
    $result = $gestor->consultarRol();
    require_once 'Vista/html/consultarRol.php';
  }

  public function editarRol($rol)
  {
    $gestor = new gestor();
    $result = $gestor->editarRol($rol);
    require_once 'Vista/html/modaleditRol.php';
  }

  public function actualizarRol($rol, $num)
  {
    $nomrol = new roles($rol);
    $gestor = new gestor();
    $result = $gestor->actualizarRol($nomrol, $num);
    if ($result == 1) {
      header("Location:index.php?accion=rol&error2=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=rol&error2=2");
    }
  }

  public function eliminarRol($rol)
  {
    $gestor = new gestor();
    $result = $gestor->eliminarRol($rol);
    if ($result > 0) {
      echo "El Rol se ha eliminado con exito";
    } else {
      echo "El Rol no se ha podido eliminar";
    }
  }
}
