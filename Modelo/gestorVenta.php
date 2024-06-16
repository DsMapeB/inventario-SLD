<?php
class GestorVenta
{
    public function agregarventa(Venta $venta)
    {
        $conexion = new Conexion();
        $cod_venta = $venta->obtenercodigo();
        $fecha_venta = $venta->obtenerfecha();
        $hora_venta = $venta->obtenerhora();
        $id_usu = $venta->obteneridusu();
        $doc_clie = $venta->obtenerdocclie();
        $cod_produ = $venta->obtenercodprodu();
        $observacion_venta = $venta->obtenerobs();
        $total_venta = $venta->obtenertotal();

        $sql2 = "SELECT * FROM venta WHERE codventa=$cod_venta";
        $conexion->buscar_query($sql2);

        $validar = $conexion->obtener_filas();
        if ($validar > 0) {
            return 2;
        } else {
            $sql = "INSERT INTO venta VALUES ('$cod_venta','$fecha_venta','$hora_venta','$id_usu','$doc_clie','$cod_produ','$observacion_venta','$total_venta')";
            $result = $conexion->ejecutar_query($sql);
            if ($result > 0) {
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function consultarVenta()
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM venta join usuario on venta.Usu=usuario.Usudoc join cliente on venta.clie=cliente.docclie join producto on venta.produ=producto.codprodu";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function editarventa($codventa)
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM venta join usuario on venta.Usu=usuario.Usudoc join cliente on venta.clie=cliente.docclie join producto on venta.produ=producto.codprodu WHERE codventa = '$codventa'";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function consultarUsuario(){
        $conexion = new Conexion();
        $sql = "SELECT * FROM usuario";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function consultarCliente(){
        $conexion = new Conexion();
        $sql = "SELECT * FROM cliente";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function consultarProducto(){
        $conexion = new Conexion();
        $sql = "SELECT * FROM producto";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function actualizarVenta($vent)
    {
        $conexion = new Conexion();
        $venta = $vent;

        $codventa = $venta->obtenercodigo();
        $fechaventa = $venta->obtenerfecha();
        $horaventa = $venta->obtenerhora();
        $idusu = $venta->obteneridusu();
        $docclie = $venta->obtenerdocclie();
        $codprodu = $venta->obtenercodprodu();
        $observacionventa = $venta->obtenerobs();
        $totalventa = $venta->obtenertotal();

        $sql = "UPDATE venta SET fecha = '$fechaventa', hora = '$horaventa', Usu = '$idusu', clie = '$docclie', produ = '$codprodu', observacion = '$observacionventa', total = '$totalventa' WHERE codventa = '$codventa'";
        $result = $conexion->ejecutar_query($sql);
        if ($result > 0) {
            return 1;
        } else {
            return 2;
        }
    }

    public function eliminarVenta($venta)
    {
        $conexion = new Conexion();
        $sql = "DELETE FROM venta WHERE codventa = ?";
        $params = array($venta);
        $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
        return $filasAfectadas;
    }
}
