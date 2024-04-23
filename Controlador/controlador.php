<?php
  class controlador{
    public function verpagina($url){
      require_once($url);
    }

    public function login($user, $pass){
    $gestor = new gestor();
    $result = $gestor->login($user,$pass);
    if ($result!=1 && $result!=2){
      $_SESSION["usuario"] = $result[0];
      $_SESSION["id"] = $result[1];
      require_once("vista/html/panel.php");
    }
    if ($result==1){
      header("Location:index.php?error=1");
    }
    if ($result==2){
      header("Location:index.php?error=2");
    }
  }

  public function logout(){
    if (isset($_SESSION["usuario"])){
      unset($_SESSION["usuario"]);
    }
    session_destroy();
    header("Location:index.php");
  }
}
?>