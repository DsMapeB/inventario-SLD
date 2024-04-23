<?php
session_start();
require_once("controlador/controlador.php");
require_once("modelo/conexion.php");
require_once("modelo/gestor.php");

$controlador = new controlador();

if (isset($_SESSION["usuario"]) && isset($_SESSION["id"])) {
    if (isset($_GET["accion"])) {
        switch ($_GET["accion"]) {
            case 'logout':
                $controlador->logout();
                break;
            case 'usuario':
                $controlador->verpagina("Vista/html/usuario.php");
                break;
            case 'cliente':
                $controlador->verpagina("Vista/html/cliente.php");
                break;
            case 'provee':
                $controlador->verpagina("Vista/html/provee.php");
            default:
                $controlador->verpagina("vista/html/inicio.php");
        }
    } else {
        $controlador->verpagina("vista/html/login.php");
    }
} else {
    if (isset($_GET["accion"])) {
        switch ($_GET["accion"]) {
            case 'login':
                $controlador->login($_POST["user"], $_POST["pass"]);

            default:
                $controlador->verpagina("vista/html/login.php");
        }
    } else {
        $controlador->verpagina("vista/html/login.php");
    }
}
?>