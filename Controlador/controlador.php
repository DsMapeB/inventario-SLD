<?php
class Controlador
{
  public function verpagina($url)
  {
    require_once($url);
  }

  //------------------------------Login Y Registro---------------------------------
  public function login($user, $pass)
  {
    $gestor = new Gestor();
    $result = $gestor->login($user, $pass);
    if ($result != 1 && $result != 2 && $result != 3 && $result != 4 && $result != 5 && $result != 6) {
      $_SESSION["telefono"] = $result[0];
      $_SESSION["usuario"] = $result[1];
      $_SESSION["rol"] = $result[2];
      $_SESSION["password"] = $result[3];
      $_SESSION["nombrerol"] = $result[4];
      $_SESSION["Usudoc"] = $result[5];
      $_SESSION["foto"] = $result[6];
      header("Location:index.php?accion=inicio&error=1");
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

  public function registrar($doc, $usu, $tel, $pass, $foto, $rol)
  {
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
      $rutaimg = 'uploads/';

      $fotoname = $_FILES['foto']['name'];

      move_uploaded_file($_FILES['foto']['tmp_name'], $rutaimg . $fotoname);

      $foto = $rutaimg . $fotoname;
    } else {
      $foto = '';
    }


    $usu = new Usu($doc, $usu, $tel, $pass, $foto, $rol);
    $gestor = new Gestor();
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
    $gestor = new Gestor();
    $result = $gestor->consultarUsu();
    require_once 'Vista/html/consultarUsu.php';
  }

  public function agregarUsuario($doc, $usu, $tel, $pass, $foto, $rol)
  {
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
      $rutaimg = 'uploads/';

      $fotoname = $_FILES['foto']['name'];

      move_uploaded_file($_FILES['foto']['tmp_name'], $rutaimg . $fotoname);

      $foto = $rutaimg . $fotoname;
    } else {
      $foto = '';
    }
    $usuarios = new Usu($doc, $usu, $tel, $pass, $foto, $rol);
    $gestor = new Gestor();
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
    $gestor = new Gestor();
    $result = $gestor->editarUsu($doc);
    require_once 'Vista/html/modalEditusu.php';
  }

  public function actualizarUsu($doc, $usu, $tel, $pass, $foto, $rol)
  {
    // Obtener el nombre del archivo de la imagen existente en la base de datos
    $foto_existente = $_POST["foto_existente"];

    // Comprobar si se cargó una nueva imagen
    if ($foto['error'] === UPLOAD_ERR_OK) {
      $rutaimg = 'uploads/';
      $fotoname = $foto['name'];
      move_uploaded_file($foto['tmp_name'], $rutaimg . $fotoname);
      $foto_actualizada = $rutaimg . $fotoname;
    } else {
      // Si no se cargó una nueva imagen, usar la imagen existente
      $foto_actualizada = $foto_existente;
    }

    $usu = new Usu($doc, $usu, $tel, $pass, $foto_actualizada, $rol);
    $gestor = new Gestor();
    $result = $gestor->actualizarPerfil($usu);
    if ($result == 1) {
      header("Location:index.php?accion=usuario&error2=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=usuario&error2=2");
    }
  }

  public function eliminarUsu($doc)
  {
    $gestor = new Gestor();
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
    $gestor = new Gestor();
    $result = $gestor->editarP();
    require_once 'Vista/html/modaleditPerfil.php';
  }

  public function actualizarPerfil($doc, $usuario, $tel, $pass, $foto, $rol)
  {
    // Obtener el nombre del archivo de la imagen existente en la base de datos
    $foto_existente = $_POST["foto_existente"];

    // Comprobar si se cargó una nueva imagen
    if ($foto['error'] === UPLOAD_ERR_OK) {
      $rutaimg = 'uploads/';
      $fotoname = $foto['name'];
      move_uploaded_file($foto['tmp_name'], $rutaimg . $fotoname);
      $foto_actualizada = $rutaimg . $fotoname;
    } else {
      // Si no se cargó una nueva imagen, usar la imagen existente
      $foto_actualizada = $foto_existente;
    }

    $usu = new Usu($doc, $usuario, $tel, $pass, $foto_actualizada, $rol);
    $gestor = new Gestor();
    $result = $gestor->actualizarPerfil($usu);
    if ($result == 1) {
      $_SESSION['Usudoc'] = $doc;
      $_SESSION['usuario'] = $usuario;
      $_SESSION['telefono'] = $tel;
      $_SESSION['password'] = $pass;
      $_SESSION['foto'] = $foto_actualizada;
      $_SESSION['rol'] = $rol;
      header("Location:index.php?accion=perfil&error=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=perfil&error=2");
    }
  }


  //----------------------------------------------------roles-----------------------------------------------------------------
  public function agregarRol($rol)
  {
    $rol1 = new Roles($rol);
    $gestor = new Gestor();
    $result = $gestor->agregarRol($rol1);
    if ($result == 1) {
      /***   Registro satisfactorio    ***/
      header("Location:index.php?accion=rol&error=1");
      exit;
    }
    if ($result == 2) {
      /***   Usuario Repetido    ***/
      header("Location:index.php?accion=rol&error=2");
      exit;
    }
    if ($result == 3) {
      /***   Error en registro    ***/
      header("Location:index.php?accion=rol&error=3");
      exit;
    }
  }

  public function consultarRol()
  {
    $gestor = new Gestor();
    $result = $gestor->consultarRol();
    require_once 'Vista/html/consultarRol.php';
  }

  public function editarRol($rol)
  {
    $gestor = new Gestor();
    $result = $gestor->editarRol($rol);
    require_once 'Vista/html/modaleditRol.php';
  }

  public function actualizarRol($rol, $num)
  {
    $nomrol = new Roles($rol);
    $gestor = new Gestor();
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
    $gestor = new Gestor();
    $result = $gestor->eliminarRol($rol);
    if ($result > 0) {
      echo "El Rol se ha eliminado con éxito";
      exit; // Detiene la ejecución aquí si el rol se eliminó con éxito
    } else {
      echo "El Rol no se ha podido eliminar";
      exit; // Detiene la ejecución aquí si el rol no se pudo eliminar
    }
  }
}
