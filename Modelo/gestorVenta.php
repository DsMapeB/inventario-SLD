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

        $sql5 = "SELECT existenciaprodu FROM producto WHERE codprodu = ? LIMIT 1";
        $conexion->buscar_query_preparado($sql5, [$cod_produ]);
        $producto = $conexion->obtener_filas();

        if ($producto['existenciaprodu'] <= $total_venta) {
            $sql2 = "SELECT codventa FROM venta WHERE codventa = ? LIMIT 1";
            $conexion->buscar_query_preparado($sql2, [$cod_venta]);
            $validar = $conexion->obtener_filas();
            if ($producto['existenciaprodu'] >= $total_venta){
                return 4;
            }
            if ($validar > 0) {
                return 2;
            } else {
                $sql = "INSERT INTO venta (codventa, fecha, hora, Usu, clie, produ, observacion, total)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $result = $conexion->ejecutar_query_preparado(
                    $sql,
                    [$cod_venta, $fecha_venta, $hora_venta, $id_usu, $doc_clie, $cod_produ, $observacion_venta, $total_venta]
                );

                if ($result > 0) {
                    $sql3 = "UPDATE producto SET existenciaprodu = existenciaprodu - ? WHERE codprodu = ?";
                    $result2 = $conexion->ejecutar_query_preparado($sql3, [$total_venta, $cod_produ]);
                    if ($result2 > 0) {
                        return 1;
                    } else {
                        return 4;
                    }
                } else {
                    return 3;
                }
            }
        } else {
            return 4;
        }
    }

    public function consultarVenta()
    {
        $conexion = new Conexion();
        $sql = "SELECT venta.codventa, venta.fecha, venta.hora, venta.observacion, venta.total,
                       usuario.usuario, cliente.nombreclie, producto.nombreprodu, producto.precioprodu
                FROM venta
                JOIN usuario ON venta.Usu = usuario.Usudoc
                JOIN cliente ON venta.clie = cliente.docclie
                JOIN producto ON venta.produ = producto.codprodu
                ORDER BY venta.codventa ASC";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function editarventa($codventa)
    {
        $conexion = new Conexion();
        $sql = "SELECT venta.codventa, venta.fecha, venta.hora, venta.Usu, venta.clie, venta.produ,
                       venta.observacion, venta.total,
                       usuario.usuario, cliente.nombreclie, producto.nombreprodu
                FROM venta
                JOIN usuario ON venta.Usu = usuario.Usudoc
                JOIN cliente ON venta.clie = cliente.docclie
                JOIN producto ON venta.produ = producto.codprodu
                WHERE venta.codventa = ?
                LIMIT 1";
        $stmt = $conexion->buscar_query_preparado($sql, [$codventa]);
        return $stmt;
    }

    public function consultarUsuario()
    {
        $conexion = new Conexion();
        $sql = "SELECT Usudoc, usuario FROM usuario";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function consultarCliente()
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM cliente";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function consultarProducto()
    {
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

        $sql2 = "SELECT codventa, total FROM venta WHERE codventa = ? LIMIT 1";
        $conexion->buscar_query_preparado($sql2, [$codventa]);
        $validar = $conexion->obtener_filas();
        if ($validar) {
            $cantidadOriginal = $validar['total'];

            $sql5 = "SELECT existenciaprodu FROM producto WHERE codprodu = ? LIMIT 1";
            $conexion->buscar_query_preparado($sql5, [$codprodu]);
            $producto = $conexion->obtener_filas();

            if ($producto) {
                $existenciaActual = $producto['existenciaprodu'];

                $diferencia = $cantidadOriginal - $totalventa;
                if ($existenciaActual > $diferencia) {
                    return 4;
                } else {

                    if ($cantidadOriginal < $totalventa) {
                        $sql3 = "UPDATE producto SET existenciaprodu = existenciaprodu + ? WHERE codprodu = ?";
                    }
                    if ($cantidadOriginal >= $totalventa) {
                        $sql3 = "UPDATE producto SET existenciaprodu = existenciaprodu - ? WHERE codprodu = ?";
                    }
                    $result2 = $conexion->ejecutar_query_preparado($sql3, [$diferencia, $codprodu]);
                    if ($result2 > 0) {
                        $sql = "UPDATE venta SET fecha = ?, hora = ?, Usu = ?, clie = ?, produ = ?, observacion = ?, total = ?
                                WHERE codventa = ?";
                        $result = $conexion->ejecutar_query_preparado(
                            $sql,
                            [$fechaventa, $horaventa, $idusu, $docclie, $codprodu, $observacionventa, $totalventa, $codventa]
                        );

                        if ($result > 0) {
                            return 1;
                        } else {
                            return 4;
                        }
                    } else {
                        return 2;
                    }
                }
            }
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
