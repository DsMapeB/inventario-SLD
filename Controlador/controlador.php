<?php
class controlador
{
  public function verpagina($url)
  {
    require_once($url);
  }

  public function login($user, $pass)
  {
    $gestor = new gestor();
    $result = $gestor->login($user, $pass);
    if ($result != 1 && $result != 2 && $result != 3 && $result != 4) {
      $_SESSION["usuario"] = $result[0];
      $_SESSION["rol"] = $result[1];
      $_SESSION["password"] = $result[2];
      $_SESSION["nombrerol"] = $result[3];
      $_SESSION["id"] = $result[4];
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

  public function registrar($usu, $pass, $rol)
  {
    $usu = new usu($usu, $pass, $rol);
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

  public function editar()
  {
    $gestor = new gestor();
    $result = $gestor->editar();
    require_once 'Vista/html/modaleditPerfil.php';
  }

  public function actualizar($usua, $pass, $rol)
  {
    $usu = new usu($usua, $pass, $rol);
    $gestor = new gestor();
    $result = $gestor->actualizar($usu);
    if ($result == 1) {
      header("Location:index.php?accion=perfil&error=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=perfil&error=2");
    }
  }

  //roles
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
