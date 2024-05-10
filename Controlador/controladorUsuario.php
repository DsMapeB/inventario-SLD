<?php
class controladorusuario{
  /*=============================================
	REGISTRO DE Usuarios
	=============================================*/
  public function agregarusuario($docUsu, $nomUsu, $telUsu, $ciuUsu, $direUsu, $fotoUsu , $cargo){
    $usuario = new usuario($docUsu, $nomUsu, $telUsu, $ciuUsu, $direUsu, $fotoUsu , $cargo);
    $gestorusuario = new gestorusuario();
    $result = $gestorusuario->agregarusuario($usuario);
    if ($result=="0"){
      echo "<script>alert('No se registro correctamente');</script>";
      header("Location:index.php?accion=usuario");
    } else{
      echo "<script>alert('Registro Existoso');</script>";
      header("Location:index.php?accion=usuario");
    }
  }

  public function consultarUsu(){
    $gestorusuario = new gestorusuario();
    $result = $gestorusuario->consultarUsu();
    require_once 'Vista/html/consultarUsu.php';
  }

  public function eliminarUsu($usuario){
    $gestorusuario = new gestorusuario();
    $registro = $gestorusuario->eliminarUsu($usuario);
    if ($registro > 0) {
      echo "El Usuario se ha eliminado con exito";
  } else{
      echo "El Usuario no se ha podido eliminar";
  }
  }
}
?>