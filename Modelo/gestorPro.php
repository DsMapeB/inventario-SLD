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

        $sql2 = "SELECT * FROM proveedores WHERE nitpro=$nit_pro";
        $conexion->buscar_query($sql2);
        $validar = $conexion->obtener_filas();
        if ($validar > 0) {
            return 2;
        } else {

            $sql = "INSERT INTO proveedores VALUES ('$nit_pro', '$nombre_pro', '$contacto_pro', '$telefono_pro', '$direccion_pro', '$ciudad_pro')";
            $result2 = $conexion->ejecutar_query($sql);
            if ($result2 > 0) {
                return 1;
            } else {
                return 3;
            }
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

    public function editarPro($nitpro)
    {
        $conexion = new conexion();
        $sql = "SELECT * FROM proveedores WHERE nitpro = $nitpro";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function actualizarprovee($provee)
    {
        $conexion =  new conexion();
        $proveedor = $provee;

        $nitpro = $proveedor->obtenernit();
        $nombrepro = $proveedor->obtenernombre();
        $contactopro = $proveedor->obtenercontacto();
        $telefonopro = $proveedor->obtenertelefono();
        $direccionpro = $proveedor->obtenerdireccion();
        $ciudadpro = $proveedor->obtenerciudad();

        $sql = "UPDATE proveedores SET nombrePro = '$nombrepro', contactoPro = '$contactopro', telefonoPro = '$telefonopro', direccionPro = '$direccionpro', ciudadPro = '$ciudadpro' WHERE nitpro = '$nitpro'";
        $result = $conexion->ejecutar_query($sql);
        if($result>0){
            return 1;
        }
        else{
            return 2;
        }
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
