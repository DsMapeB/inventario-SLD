<?php
class ControladorProveedor
{
    /*=============================================
        REGISTRO DE proveedores
        =============================================*/

    public function agregarproveedores($nitpro, $nompro, $contpro, $telpro, $direpro, $ciupro)
    {
        $proveedor = new Proveedor($nitpro, $nompro, $contpro, $telpro, $direpro, $ciupro);
        $gestorproveedor = new GestorProveedor();
        $result = $gestorproveedor->agregarproveedor($proveedor);
        if ($result == 1) {
            /***   Registro satisfactorio    ***/
            header("Location:index.php?accion=provee&error=1");
        }
        if ($result == 2) {
            /***   Usuario Repetido    ***/
            header("Location:index.php?accion=provee&error=2");
        }
        if ($result == 3) {
            /***   Error en registro    ***/
            header("Location:index.php?accion=provee&error=3");
        }
    }

    public function consultarPro()
    {
        $gestorproveedor = new GestorProveedor();
        $result = $gestorproveedor->consultarPro();
        require_once 'Vista/html/consultarPro.php';
    }

    public function editarprove($nitpro){
        $gestorproveedor = new GestorProveedor();
        $result = $gestorproveedor->editarPro($nitpro);
        require_once 'Vista/html/modalEditprove.php';
    }

    public function actualizarprove($nitpro,$nombrepro,$contactopro,$telpro,$direcpro,$ciupro){
        $proveedor = new Proveedor($nitpro,$nombrepro,$contactopro,$telpro,$direcpro,$ciupro);
        $gestorproveedor = new GestorProveedor();
        $result = $gestorproveedor->actualizarprovee($proveedor);
        if ($result == 1) {
            /***   Registro satisfactorio    ***/
            header("Location:index.php?accion=provee&error2=1");
        }
        if ($result == 2) {
            /***   Usuario Repetido    ***/
            header("Location:index.php?accion=provee&error2=2");
        }
    }

    public function eliminarPro($proveedor)
    {
        $gestorproveedor = new GestorProveedor();
        $registro = $gestorproveedor->eliminarPro($proveedor);
        if ($registro > 0) {
            echo "El Proveedor se ha eliminado con exito";
        } else{
            echo "El Proveedor no se ha podido eliminar";
        }
    }
}
