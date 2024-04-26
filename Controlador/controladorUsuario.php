<?php
class controladorusuario{
  /*=============================================
	REGISTRO DE Usuarios
	=============================================*/

  public function agregarusuario($codusu, $nomUsu, $telUsu, $ciuUsu, $direUsu, $cargo){
    $usuario = new usuario($codusu, $nomUsu, $telUsu, $ciuUsu, $direUsu, $cargo);
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

  public function consultarusuarios(){
    $gestorusuario = new gestorusuario();
    $result = $gestorusuario->consultarusuarios();
    require_once 'Vista/html/usuario.php';
  }
}
?>