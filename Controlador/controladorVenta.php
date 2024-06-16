<?php
class ControladorVenta
{
    /*=============================================
        REGISTRO DE VENTAS
        =============================================*/
    public function agregarventa($codventa,$fechaventa,$horaventa,$idusu,$docclie,$codprodu,$obs,$total)
    {
        $venta = new Venta($codventa,$fechaventa,$horaventa,$idusu,$docclie,$codprodu,$obs,$total);
        $gestorventa = new GestorVenta();
        $result = $gestorventa->agregarventa($venta);
        if ($result == 1) {
            /***   Registro satisfactorio    ***/
            header("Location:index.php?accion=venta&error=1");
        }
        if ($result == 2) {
            /***   Usuario Repetido    ***/
            header("Location:index.php?accion=venta&error=2");
        }
        if ($result == 3) {
            /***   Error en registro    ***/
            header("Location:index.php?accion=venta&error=3");
        }
    }

    public function consultarVenta(){
        $gestorventa = new GestorVenta();
        $result = $gestorventa->consultarVenta();
        require_once 'Vista/html/consultarVen.php';
    }

    public function editarventa($codventa){
        $gestorventa = new GestorVenta();
        $result = $gestorventa->editarventa($codventa);
        $result2 = $gestorventa->consultarUsuario();
        $result3 = $gestorventa->consultarCliente();
        $result4 = $gestorventa->consultarProducto();
        require_once 'Vista/html/modalEditventa.php';
    }

    public function actualizarVenta($codventa,$fechaventa,$horaventa,$idusu,$docclie,$codprodu,$obs,$total){
        $venta = new venta($codventa,$fechaventa,$horaventa,$idusu,$docclie,$codprodu,$obs,$total);
        $gestorventa = new GestorVenta();
        $result = $gestorventa->actualizarVenta($venta);
        if ($result == 1) {
            /***   Registro satisfactorio    ***/
            header("Location:index.php?accion=venta&error2=1");
        }
        if ($result == 2) {
            /***   Usuario Repetido    ***/
            header("Location:index.php?accion=venta&error2=2");
        }
    }

    public function eliminarVenta($venta){
        $gestorventa = new GestorVenta();
        $registro = $gestorventa->eliminarVenta($venta);
        if ($registro > 0) {
            echo "La venta se ha eliminado con exito";
        } else{
            echo "La venta no se ha podido eliminar";
        }
    }
}