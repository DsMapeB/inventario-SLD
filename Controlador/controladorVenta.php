<?php
class controladorventa
{
    /*=============================================
        REGISTRO DE VENTAS
        =============================================*/
    public function agregarventa($codventa,$fechaventa,$horaventa,$idusu,$docclie,$codprodu,$obs,$total)
    {
        $venta = new venta($codventa,$fechaventa,$horaventa,$idusu,$docclie,$codprodu,$obs,$total);
        $gestorventa = new gestorVenta();
        $result = $gestorventa->agregarventa($venta);
        if ($result == "0") {
            echo "<script>alert('No se registró correctamente');</script>";
            header("Location:index.php?accion=venta");
        } else {
            echo "<script>alert('Registro exitoso');</script>";
            header("Location:index.php?accion=venta");
        }
    }

    public function consultarVenta(){
        $gestorventa = new gestorVenta();
        $result = $gestorventa->consultarVenta();
        require_once 'Vista/html/consultarVen.php';
    }

    public function eliminarVenta($venta){
        $gestorventa = new gestorventa();
        $registro = $gestorventa->eliminarVenta($venta);
        if ($registro > 0) {
            echo "La venta se ha eliminado con exito";
        } else{
            echo "La venta no se ha podido eliminar";
        }
    }
}