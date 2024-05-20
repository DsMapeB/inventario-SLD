<?php
  class controlador{
    public function verpagina($url){
      require_once($url);
    }

    public function login($user, $pass){
    $gestor = new gestor();
    $result = $gestor->login($user,$pass);
    if ($result!=1 && $result!=2){
      $_SESSION["nombreUsu"] = $result[0];
      $_SESSION["contraseñaUsu"] = $result[1];
      require_once("Vista/html/inicio.php");
    }
    if ($result==1){
      header("Location:index.php?error=1");
    }
    if ($result==2){
      header("Location:index.php?error=2");
    }
  }

  public function logout(){
    if (isset($_SESSION["nombreUsu"])){
      unset($_SESSION["nombreUsu"]);
    }
    session_destroy();
    header("Location:index.php");
  }
}
?>