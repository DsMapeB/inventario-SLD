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
}
