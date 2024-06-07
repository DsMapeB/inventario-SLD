<?php
session_start();
//------------------------------------ Gestor conexion -----------------------------------------
require_once("Modelo/conexion.php");
//-------------------------- controlador y gestor usuario, logueos y rol ----------------------------------
require_once("Controlador/controlador.php");
require_once("Modelo/gestor.php");
require_once("Modelo/usu.php");
require_once("Modelo/rol.php");
// ----------------------------------- Controlador y Gestor Cliente -----------------------------------------
require_once("Controlador/controladorCli.php");
require_once("Modelo/gestorCli.php");
require_once("Modelo/cliente.php");
// ----------------------------------- Controlador y Gestor Proveedor -----------------------------------------
require_once("Controlador/controladorPro.php");
require_once("Modelo/proveedor.php");
require_once("Modelo/gestorPro.php");
// ----------------------------------- Controlador y Gestor Producto ------------------------------------------
require_once("Controlador/controladorProdu.php");
require_once("Modelo/producto.php");
require_once("Modelo/gestorProdu.php");
// ----------------------------------- Controlador y Gestor Venta ---------------------------------------------
require_once("Controlador/controladorVenta.php");
require_once("Modelo/gestorVenta.php");
require_once("Modelo/venta.php");
//--------------------------------------------------------------------------------------------------------------//

$controlador = new controlador();
$controladorPro = new controladorproveedor();
$controladorCli = new controladorcli();
$controladorProdu = new controladorprodu();
$controladorVenta = new controladorventa();

if (isset($_SESSION["Usudoc"]) && isset($_SESSION["usuario"]) && isset($_SESSION["rol"]) && isset($_SESSION["password"]) && isset($_SESSION["nombrerol"]) && isset($_SESSION["foto"])) {
    if (isset($_GET["accion"])) {
        switch ($_GET["accion"]) {
            case 'logout':
                $controlador->logout();
                break;

            case 'ingresarusuario':
                $controlador->agregarUsuario(
                    $_REQUEST["Usudoc"],
                    $_REQUEST["usuario"],
                    $_REQUEST["password"],
                    $_REQUEST["foto"],
                    $_REQUEST["cargo"]
                );
                break;
            case 'usuario':
                $controlador->verpagina("Vista/html/usuario.php");
                break;
            case 'consultarUsu';
                $controlador->consultarUsu();
                break;
            case 'editarUsu':
                $controlador->editarUsu($_GET["numero"]);
                break;
            case 'actualizarUsuario':
                $controlador->actualizarUsu(
                    $_REQUEST["Usudoc2"],
                    $_REQUEST["usuario2"],
                    $_REQUEST["password2"],
                    $_FILES["foto2"],
                    $_REQUEST["cargo2"]
                );
                break;
            case 'eliminarusu':
                $controlador->eliminarUsu($_GET["numero"]);
                break;

// -------------------------------------------------- Perfil ----------------------------------------------------------------
            case 'perfil':
                $controlador->verpagina("Vista/html/perfil.php");
                break;
            case 'editarPerfil';
                $controlador->editar();
                break;
            case 'actualizarPerfilF':
                $controlador->actualizarPerfil(
                    $_POST["Usudoc3"],
                    $_POST["usuario3"],
                    $_POST["contraseña3"],
                    $_FILES["foto3"],
                    $_POST["rol3"]
                );
                break;


                // -------------------------------------------- Rol ----------------------------------------------
            case 'rol':
                $controlador->verpagina("Vista/html/roles.php");
                break;
            case 'ingresarRol':
                $controlador->agregarRol($_REQUEST["rol"]);
                break;
            case 'consultarRol':
                $controlador->consultarRol();
                break;
            case 'editarRol':
                $controlador->editarRol($_GET["numero"]);
                break;
            case 'actualizarRol':
                $controlador->actualizarRol(
                    $_REQUEST["rol2"],
                    $_REQUEST["numrol2"]

                );
                break;
            case 'eliminarRol':
                $controlador->eliminarRol($_GET["numero"]);
                break;

                //------------------------------------- Cliente ------------------------------------------------
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

                // -------------------------------------------- Proveedor ---------------------------------------//
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

                // ------------------------------------------- Producto -------------------------------------------
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

                // --------------------------------------------- Venta -------------------------------------------
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
                    $_REQUEST["obs"],
                    $_REQUEST["total"],
                );
                break;
            case 'consultarVen':
                $controladorVenta->consultarVenta();
                break;
            case 'editarVen':
                $controladorVenta->editarVenta($_GET["numero"]);
                break;
            case 'actualizarVenta':
                $controladorVenta->actualizarVenta(
                    $_POST["codventa2"],
                    $_POST["fecha2"],
                    $_POST["hora2"],
                    $_POST["idUsu2"],
                    $_POST["docclie2"],
                    $_POST["codprodu2"],
                    $_POST["obs2"],
                    $_POST["total2"],
                );
                break;
            case 'eliminarven':
                $controladorVenta->eliminarVenta($_GET["numero5"]);
                break;
            default:
                $controlador->verpagina("Vista/html/inicio.php");
                break;
        }
    } else {
        $controlador->verpagina("Vista/html/login.php");
    }
} else {
    if (isset($_GET["accion"])) {
        switch ($_GET["accion"]) {
            case 'log':
                $controlador->verpagina("Vista/html/login.php");
                break;
            case 'login':
                $controlador->login($_POST["user"], $_POST["pass"]);
                break;
            case 'registro':
                $controlador->verpagina("Vista/html/registrar.php");
                break;
            case 'registrar':
                $controlador->registrar(
                    $_POST["Usudoc"],
                    $_POST["usuario"],
                    $_POST["password"],
                    $_POST["foto"],
                    $_POST["cargo"]
                );
                break;
            default:
                $controlador->verpagina("Vista/html/login.php");
                break;
        }
    } else {
        $controlador->verpagina("Vista/html/panel.php");
    }
}
