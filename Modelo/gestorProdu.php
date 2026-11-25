<?php
class GestorProdu
{
    public function agregarproducto(Producto $producto)
    {
        $conexion = new Conexion;
        $cod_produ = $producto->obtenercodigo();
        $nombre_produ = $producto->obtenernombre();
        $precio_produ = $producto->obtenerprecio();
        $existencia_produ = $producto->obtenerexistencia();
        $prove_produ = $producto->obtenerproveedor();

        $sql2 = "SELECT codprodu FROM producto WHERE codprodu = ? LIMIT 1";
        $stmt = $conexion->buscar_query_preparado($sql2, [$cod_produ]);
        $validar = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($validar) {
            return 2;
        }

        $sql = "INSERT INTO producto (codprodu, nombreprodu, precioprodu, existenciaprodu, nitprodu)
                VALUES (?, ?, ?, ?, ?)";
        $result = $conexion->ejecutar_query_preparado(
            $sql,
            [$cod_produ, $nombre_produ, $precio_produ, $existencia_produ, $prove_produ]
        );
        if ($result > 0) {
            return 1;
        } else {
            return 3;
        }
    }

    public function consultarProdu()
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM producto join proveedores on producto.nitprodu=proveedores.nitpro";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function editarProdu($codprodu)
    {
        $conexion = new Conexion();
        $sql = "SELECT producto.codprodu, producto.nombreprodu, producto.precioprodu,
                       producto.existenciaprodu, producto.nitprodu, proveedores.nombrePro
                FROM producto
                JOIN proveedores ON producto.nitprodu = proveedores.nitpro
                WHERE producto.codprodu = ?
                LIMIT 1";
        $stmt = $conexion->buscar_query_preparado($sql, [$codprodu]);
        return $stmt;
    }

    public function consultarProve(){
        $conexion = new Conexion();
        $sql = "SELECT * FROM proveedores";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function actualizarProdu($produ)
    {
        $conexion = new Conexion();
        $producto = $produ;

        $codprodu = $producto->obtenercodigo();
        $nombreprodu = $producto->obtenernombre();
        $precioprodu = $producto->obtenerprecio();
        $exisprodu = $producto->obtenerexistencia();
        $proveprodu = $producto->obtenerproveedor();

        $sql = "UPDATE producto SET nombreprodu = ?, precioprodu = ?, existenciaprodu = ?, nitprodu = ?
                WHERE codprodu = ?";
        $result = $conexion->ejecutar_query_preparado(
            $sql,
            [$nombreprodu, $precioprodu, $exisprodu, $proveprodu, $codprodu]
        );
        if ($result > 0){
            return 1;
        } else {
            return 2;
        }
    }

    public function eliminarProdu($producto)
    {
        $conexion = new Conexion();
        $sql = "DELETE FROM producto WHERE codprodu = ?";
        $params = array($producto);
        $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
        return $filasAfectadas;
    }
}
