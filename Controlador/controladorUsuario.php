<?php
class controladorusuario{
  /*=============================================
	REGISTRO DE Usuarios
	=============================================*/

  public function agregarusuario($codusu, $docUsu, $nomUsu, $telUsu, $ciuUsu, $direUsu, $fotoUsu , $cargo){
    $usuario = new usuario($codusu, $docUsu, $nomUsu, $telUsu, $ciuUsu, $direUsu, $fotoUsu , $cargo);
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
}
?>