<?php
class gestorVenta
{
    public function agregarventa(venta $venta)
    {
        $conexion = new conexion();
        $cod_venta = $venta->obtenercodigo();
        $fecha_venta = $venta->obtenerfecha();
        $hora_venta = $venta->obtenerhora();
        $id_usu = $venta->obteneridusu();
        $doc_clie = $venta->obtenerdocclie();
        $cod_produ = $venta->obtenercodprodu();
        $observacion_venta = $venta->obtenerobs();
        $total_venta = $venta->obtenertotal();

        $sql = "INSERT INTO venta VALUES ('$cod_venta','$fecha_venta','$hora_venta','$id_usu','$doc_clie','$cod_produ','$observacion_venta','$total_venta')";

        $conexion->ejecutar_query($sql);
        
        $sql2 = "SELECT * FROM venta WHERE codventa=$cod_venta";
        $conexion->buscar_query($sql2);

        $validar = $conexion->obtener_filas();
        if ($validar > 0) {
            $result = $conexion->obtener_resultado();
            return $result;
        } else {
            return 1;
        }
    }
}