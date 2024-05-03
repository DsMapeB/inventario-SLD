<?php
    class gestorcliente{
        public function agregarcliente(cliente $cliente){
            $conexion = new conexion();
            $doc_cli = $cliente->obtenerdocumento();
            $nombre_cli = $cliente->obtenernombre();
            $telefono_cli = $cliente->obtenertelefono();

            $sql = "INSERT INTO cliente VALUES ('$doc_cli', '$nombre_cli', '$telefono_cli')";
            $conexion->ejecutar_query($sql);

            $sql2 = "SELECT * FROM cliente WHERE docclie=$doc_cli";
            $conexion->buscar_query($sql2);

            $validar = $conexion->obtener_filas();
            if ($validar > 0){
                $result = $conexion->obtener_resultado();
                return $result;
            } else{
                return 1;
            }
        }

        public function consultarCli(){
            $conexion = new conexion();
            $sql = "SELECT * FROM cliente";
            $conexion->buscar_query($sql);
            $result = $conexion->obtener_resultado();
            return $result;
        }
    }
?>