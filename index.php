<?php
session_start();
require_once("Controlador/controlador.php");
require_once("Controlador/controladorUsuario.php");
require_once("Controlador/controladorPro.php");
require_once("Modelo/conexion.php");
require_once("Modelo/gestor.php");
require_once("Modelo/gestorUsuario.php");
require_once("Modelo/usuario.php");

$controlador = new controlador();
$controladorUsuario = new controladorusuario();
$controladorPro = new controladorProveedor(); 

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
                    $_REQUEST["nombreUsuario"],
                    $_REQUEST["telUsuario"],
                    $_REQUEST["ciudadUsuario"],
                    $_REQUEST["direcUsuario"],
                    $_REQUEST["cargoUsuario"]
                );
                break;
            case 'consultarusuario':
                $controladorusuario->consultarusuarios();
                break;
            case 'cliente':
                $controlador->verpagina("Vista/html/cliente.php");
                break;
            case 'provee':
                $controlador->verpagina("Vista/html/provee.php");
                break;
            case 'ingresarProveedor':
                $controladorPro->agregarproveedores(
                $_REQUEST["nombreprovee"],
                $_REQUEST["contactoprovee"],
                $_REQUEST["telprovee"],
                $_REQUEST["direcprovee"],
                $_REQUEST["ciuprovee"]
            );
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
        $controlador->verpagina("vista/html/login.php");
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