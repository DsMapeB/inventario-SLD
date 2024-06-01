<?php
class controladorusuario
{
  /*=============================================
	REGISTRO DE Usuarios
	=============================================*/
  public function agregarusuario($docUsu, $nomUsu, $passUsu, $telUsu, $ciuUsu, $direUsu, $cargo)
  {
    $usuario = new usuario($docUsu, $nomUsu, $passUsu, $telUsu, $ciuUsu, $direUsu, $cargo);
    $gestorusuario = new gestorusuario();
    $result = $gestorusuario->agregarusuario($usuario);
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

  public function consultarUsu()
  {
    $gestorusuario = new gestorusuario();
    $result = $gestorusuario->consultarUsu();
  }

  public function editarUsu($docUsu)
  {
    $gestorusuario =  new gestorusuario();
    $result = $gestorusuario->editarUsu($docUsu);
    require_once 'Vista/html/modalEditusu.php';
  }

  public function actualizarUsu($docUsu, $nomUsu, $passUsu, $telUsu, $ciuUsu, $direUsu, $cargo)
  {
    $usuario = new usuario($docUsu, $nomUsu, $passUsu, $telUsu, $ciuUsu, $direUsu, $cargo);
    $gestorusuario = new gestorusuario();
    $result = $gestorusuario->actualizarUsu($usuario);
    if ($result == 1) {
      header("Location:index.php?accion=usuario&error2=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=usuario&error2=2");
    }
  }

  public function eliminarUsu($usuario)
  {
    $gestorusuario = new gestorusuario();
    $registro = $gestorusuario->eliminarUsu($usuario);
    if ($registro > 0) {
      echo "El Usuario se ha eliminado con exito";
    } else {
      echo "El Usuario no se ha podido eliminar";
    }
  }
}
