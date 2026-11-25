<?php
class GestorProveedor
{
    public function agregarproveedor(Proveedor $proveedor)
    {
        $conexion = new Conexion();
        $nit_pro = $proveedor->obtenernit();
        $nombre_pro = $proveedor->obtenernombre();
        $contacto_pro = $proveedor->obtenercontacto();
        $telefono_pro = $proveedor->obtenertelefono();
        $direccion_pro = $proveedor->obtenerdireccion();
        $ciudad_pro = $proveedor->obtenerciudad();

        $sql2 = "SELECT nitpro FROM proveedores WHERE nitpro = ? LIMIT 1";
        $stmt = $conexion->buscar_query_preparado($sql2, [$nit_pro]);
        $validar = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($validar) {
            return 2;
        }

        $sql = "INSERT INTO proveedores (nitpro, nombrePro, contactoPro, telefonoPro, direccionPro, ciudadPro)
                VALUES (?, ?, ?, ?, ?, ?)";
        $result2 = $conexion->ejecutar_query_preparado(
            $sql,
            [$nit_pro, $nombre_pro, $contacto_pro, $telefono_pro, $direccion_pro, $ciudad_pro]
        );
        if ($result2 > 0) {
            return 1;
        } else {
            return 3;
        }
    }
    public function consultarPro()
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM proveedores";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function editarPro($nitpro)
    {
        $conexion = new Conexion();
        $sql = "SELECT nitpro, nombrePro, contactoPro, telefonoPro, direccionPro, ciudadPro
                FROM proveedores WHERE nitpro = ? LIMIT 1";
        $stmt = $conexion->buscar_query_preparado($sql, [$nitpro]);
        return $stmt;
    }

    public function actualizarprovee($provee)
    {
        $conexion =  new Conexion();
        $proveedor = $provee;

        $nitpro = $proveedor->obtenernit();
        $nombrepro = $proveedor->obtenernombre();
        $contactopro = $proveedor->obtenercontacto();
        $telefonopro = $proveedor->obtenertelefono();
        $direccionpro = $proveedor->obtenerdireccion();
        $ciudadpro = $proveedor->obtenerciudad();

        $sql = "UPDATE proveedores SET nombrePro = ?, contactoPro = ?, telefonoPro = ?, direccionPro = ?, ciudadPro = ?
                WHERE nitpro = ?";
        $result = $conexion->ejecutar_query_preparado(
            $sql,
            [$nombrepro, $contactopro, $telefonopro, $direccionpro, $ciudadpro, $nitpro]
        );
        if($result>0){
            return 1;
        }
        else{
            return 2;
        }
    }

    public function eliminarPro($proveedor)
    {
        $conexion = new Conexion();
        $sql = "DELETE FROM proveedores WHERE nitpro = ?";
        $params = array($proveedor);
        $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
        return $filasAfectadas;
    }
}
