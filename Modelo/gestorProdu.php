<?php
class gestorprodu
{
    public function agregarproducto(producto $producto)
    {
        $conexion = new conexion;
        $cod_produ = $producto->obtenercodigo();
        $nombre_produ = $producto->obtenernombre();
        $precio_produ = $producto->obtenerprecio();
        $existencia_produ = $producto->obtenerexistencia();
        $prove_produ = $producto->obtenerproveedor();

        $sql = "INSERT INTO producto VALUES ('$cod_produ', '$nombre_produ', '$precio_produ', '$existencia_produ', '$prove_produ')";

        $conexion->ejecutar_query($sql);

        $sql2 = "SELECT * FROM producto WHERE codprodu='$cod_produ'";
        $conexion->buscar_query($sql2);
        
        $validar = $conexion->obtener_filas();
        if ($validar > 0) {
            $result = $conexion->obtener_resultado();
            return $result;
        } else {
            return 1;
        }
    }

    public function consultarProdu(){
        $conexion = new conexion();
        $sql = "SELECT * FROM producto";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function editarProdu($codprodu){
        $conexion = new conexion();
        $sql = "SELECT * FROM producto WHERE codprodu = $codprodu";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function actualizarProdu($produ){
        $conexion = new conexion();
        $producto = $produ;

        $codprodu = $producto->obtenercodigo();
        $nombreprodu = $producto->obtenernombre();
        $precioprodu = $producto->obtenerprecio();
        $exisprodu = $producto->obtenerexistencia();
        $proveprodu = $producto->obtenerproveedor();

        $sql = "UPDATE producto SET codprodu = '$codprodu', nombreprodu = '$nombreprodu', precioprodu = '$precioprodu', existenciaprodu = '$exisprodu', nitprodu = '$proveprodu' ";
        $result = $conexion->ejecutar_query($sql);
        return $result;
    }

    public function eliminarProdu($producto){
        $conexion = new conexion();
        $sql = "DELETE FROM producto WHERE codprodu = ?";
        $params = array($producto);
        $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
        return $filasAfectadas;
    }
}
