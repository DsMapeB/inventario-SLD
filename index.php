<?php
session_start();
require_once("Controlador/controlador.php");
require_once("Controlador/controladorUsuario.php");
require_once("Controlador/controladorPro.php");
require_once("Controlador/controladorCli.php");
require_once("Controlador/controladorProdu.php");
require_once("Controlador/controladorVenta.php");
require_once("Modelo/conexion.php");
require_once("Modelo/gestor.php");
require_once("Modelo/proveedor.php");
require_once("Modelo/gestorPro.php");
require_once("Modelo/producto.php");
require_once("Modelo/gestorProdu.php");
require_once("Modelo/gestorVenta.php");
require_once("Modelo/venta.php");
require_once("Modelo/gestorCli.php");
require_once("Modelo/cliente.php");
require_once("Modelo/gestorUsuario.php");
require_once("Modelo/usuario.php");


$controlador = new controlador();
$controladorUsuario = new controladorusuario();
$controladorPro = new controladorproveedor();
$controladorCli = new controladorcli();
$controladorProdu = new controladorprodu();
$controladorVenta = new controladorventa();

if (isset($_SESSION["usuario"]) && isset($_SESSION["password"])) {
    if (isset($_GET["accion"])) {
        switch ($_GET["accion"]) {
            case 'logout':
                $controlador->logout();
                break;
            case 'perfil':
                $controlador->verpagina("Vista/html/perfil.php");
                break;

                //Usuario
            case 'usuario':
                $controlador->verpagina("Vista/html/usuario.php");
                break;
            case 'ingresarusuario':
                $controladorUsuario->agregarusuario(
                    $_REQUEST["docUsuario"],
                    $_REQUEST["nombreUsuario"],
                    $_REQUEST["passUsuario"],
                    $_REQUEST["telUsuario"],
                    $_REQUEST["ciudadUsuario"],
                    $_REQUEST["direcUsuario"],
                    $_REQUEST["fotoUsuario"],
                    $_REQUEST["cargoUsuario"]
                );
                break;
            case 'consultarUsu':
                $controladorUsuario->consultarUsu();
                break;
            case 'editarUsu':
                $controladorUsuario->editarUsu($_GET["numero"]);
                break;
            case 'actualizarUsuario':
                $controladorUsuario->actualizarUsu(
                    $_POST["docUsuario"],
                    $_POST["nombreUsuario"],
                    $_POST["passUsuario"],
                    $_POST["telUsuario"],
                    $_POST["ciudadUsuario"],
                    $_POST["direcUsuario"],
                    $_POST["fotoUsuario"],
                    $_POST["cargoUsuario"]
                );
                break;
            case 'eliminarusu':
                $controladorUsuario->eliminarUsu($_GET["numero2"]);
                break;

                //Cliente
            case 'cliente':
                $controlador->verpagina("Vista/html/cliente.php");
                break;
            case 'ingresarCliente':
                $controladorCli->agregarclientes(
                    $_REQUEST["doccliente"],
                    $_REQUEST["nombrecliente"],
                    $_REQUEST["telcliente"]
                );
                break;
            case 'consultarCli':
                $controladorCli->consultarCli();
                break;
            case 'editarCli':
                $controladorCli->editarCli($_GET["numero"]);
                break;
            case 'actualizarCliente':
                $controladorCli->actualizarCli(
                    $_POST["documento"],
                    $_POST["nombre"],
                    $_POST["telefono"]
                );
                break;
            case 'eliminarcli':
                $controladorCli->eliminarCli($_GET["numero3"]);
                break;

                //Proveedor
            case 'provee':
                $controlador->verpagina("Vista/html/provee.php");
                break;
            case 'ingresarProveedor':
                $controladorPro->agregarproveedores(
                    $_REQUEST["nitprovee"],
                    $_REQUEST["nombreprovee"],
                    $_REQUEST["contactoprovee"],
                    $_REQUEST["telprovee"],
                    $_REQUEST["direcprovee"],
                    $_REQUEST["ciuprovee"]
                );
                break;
            case 'consultarPro':
                $controladorPro->consultarPro();
                break;
            case 'editarProvee':
                $controladorPro->editarprove($_GET["numero"]);
                break;
            case 'actualizarProveedor':
                $controladorPro->actualizarprove(
                    $_POST["nitprovee"],
                    $_POST["nombreprovee"],
                    $_POST["contactoprovee"],
                    $_POST["telprovee"],
                    $_POST["direcprovee"],
                    $_POST["ciuprovee"]
                );
                break;
            case 'eliminarpro':
                $controladorPro->eliminarPro($_GET["numero"]);
                break;

                //Producto
            case 'produ':
                $controlador->verpagina("Vista/html/produ.php");
                break;
            case 'ingresarprodu':
                $controladorProdu->agregarproductos(
                    $_REQUEST["codprodu"],
                    $_REQUEST["nombreprodu"],
                    $_REQUEST["precioprodu"],
                    $_REQUEST["exisprodu"],
                    $_REQUEST["proprodu"]
                );
                break;
            case 'consultarprodu':
                $controladorProdu->consultarProdu();
                break;
            case 'editarprodu':
                $controladorProdu->editarProdu($_GET["numero"]);
                break;
            case 'actualizarprodu':
                $controladorProdu->actualizarProdu(
                    $_POST["codprodu"],
                    $_POST["nombreprodu"],
                    $_POST["precioprodu"],
                    $_POST["exisprodu"],
                    $_POST["proprodu"],
                );
                break;
            case 'eliminarprodu':
                $controladorProdu->eliminarProdu($_GET["numero4"]);
                break;

                //Venta
            case 'venta':
                $controlador->verpagina("Vista/html/venta.php");
                break;
            case 'ingresarventa':
                $controladorVenta->agregarventa(
                    $_REQUEST["codventa"],
                    $_REQUEST["fecha"],
                    $_REQUEST["hora"],
                    $_REQUEST["idUsu"],
                    $_REQUEST["docclie"],
                    $_REQUEST["codprodu"],
                    $_REQUEST["docclie"],
                    $_REQUEST["obs"],
                    $_REQUEST["total"],
                );
                break;
            case 'consultarVen':
                $controladorVenta->consultarVenta();
                break;
            case 'eliminarven':
                $controladorVenta->eliminarVenta($_GET["numero5"]);
                break;
            default:
                $controlador->verpagina("Vista/html/inicio.php");
        }
    } else {
        $controlador->verpagina("Vista/html/login.php");
    }
} else {
    if (isset($_GET["accion"])) {
        switch ($_GET["accion"]) {
            case 'login':
                $controlador->login($_POST["user"], $_POST["pass"]);
            default:
                $controlador->verpagina("Vista/html/inicio.php");
        }
    } else {
        $controlador->verpagina("Vista/html/login.php");
    }
}
