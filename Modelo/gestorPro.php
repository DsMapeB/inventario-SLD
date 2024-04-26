<?php
    class gestorproveedor{
        public function agregarproveedor(proveedor $proveedor){
            $conexion =new conexion();
            $nombre_pro = $proveedor->obtenernombre();
            $contacto_pro = $proveedor->obtenercontacto();
            $telefono_pro = $proveedor->obtenertelefono();
            $direccion_pro = $proveedor->obtenerdireccion();
            $ciudad_pro = $proveedor->obtenerciudad();

            $sql = "INSERT INTO proveedores VALUES ('', '$nombre_pro', '$contacto_pro', '$telefono_pro', '$direccion_pro', '$ciudad_pro')";

            $conexion->ejecutar_query($sql);

            $sql2 = "SELECT * FROM proveedores WHERE nombrepro=$nombre_pro";
            $conexion->buscar_query($sql2);

            $validar = $conexion->obtener_filas();
                if ($validar>0){
                    $result=$conexion->obtener_resultado();
                    return $result;
                } else {
                    return 1;
                }
        }

    }
?>