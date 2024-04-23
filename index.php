<?php 
    if(isset($_GET["accion"])){
        if($_GET["accion"] == "login"){
            require_once 'Vista/html/login.php';
        }
        if($_GET["accion"] == "inicio"){
            require_once 'Vista/html/inicio.php';
        }
        if($_GET["accion"] == "provee"){
            require_once 'Vista/html/provee.php';
        }
        if($_GET["accion"] == "usuario"){
            require_once 'Vista/html/usuario.php';
        }
        if($_GET["accion"] == "produ"){
            require_once 'Vista/html/produ.php';
        }
    } else{
        require_once 'Vista/html/login.php';
    }
?>

