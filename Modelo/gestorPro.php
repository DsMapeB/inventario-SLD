<?php
class gestorproveedor
{
    public function agregarproveedor(proveedor $proveedor)
    {
        $conexion = new conexion();
        $nit_pro = $proveedor->obtenernit();
        $nombre_pro = $proveedor->obtenernombre();
        $contacto_pro = $proveedor->obtenercontacto();
        $telefono_pro = $proveedor->obtenertelefono();
        $direccion_pro = $proveedor->obtenerdireccion();
        $ciudad_pro = $proveedor->obtenerciudad();

        $sql = "INSERT INTO proveedores VALUES ('$nit_pro', '$nombre_pro', '$contacto_pro', '$telefono_pro', '$direccion_pro', '$ciudad_pro')";

        $conexion->ejecutar_query($sql);

        $sql2 = "SELECT * FROM proveedores WHERE nitpro=$nit_pro";
        $conexion->buscar_query($sql2);

        $validar = $conexion->obtener_filas();
        if ($validar > 0) {
            $result = $conexion->obtener_resultado();
            return $result;
        } else {
            return 1;
        }
    }
    public function consultarPro()
    {
        $conexion = new conexion();
        $sql = "SELECT * FROM proveedores";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function eliminarPro($proveedor)
    {
        $conexion = new conexion();
        $sql = "DELETE FROM proveedores WHERE nitpro = ?";
        $params = array($proveedor);
        $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
        return $filasAfectadas;
    }
}
