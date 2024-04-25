<?php
session_start();
require_once("controlador/controlador.php");
require_once("controlador/controladorUsuario.php");
require_once("modelo/conexion.php");
require_once("modelo/gestor.php");
require_once ("modelo/gestorUsuario.php");
require_once("modelo/usuario.php");

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
            case 'ingresarusuario':
                $controladorusuario->agregarusuario(

                );
                break;
            case 'cliente':
                $controlador->verpagina("Vista/html/cliente.php");
                break;
            case 'provee':
                $controlador->verpagina("Vista/html/provee.php");
                break;
            case 'produ':
                $controlador->verpagina("Vista/html/produ.php");
                break;
            case 'venta':
                $controlador->verpagina("Vista/html/venta.php");
                break;
            default:
                $controlador->verpagina("vista/html/inicio.php");
        }
    } else {
        $controlador->verpagina("vista/html/inicio.php");
    }
} else {
    if (isset($_GET["accion"])) {
        switch ($_GET["accion"]) {
            case 'login':
                $controlador->login($_POST["user"], $_POST["pass"]);

            default:
                $controlador->verpagina("vista/html/inicio.php");
        }
    } else {
        $controlador->verpagina("vista/html/login.php");
    }
}
?>