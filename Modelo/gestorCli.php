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

        public function editarCli(){
            $conexion = new conexion();
            $sql = "SELECT * FROM cliente WHERE docclie";
            $conexion->buscar_query($sql);
            $result = $conexion->obtener_resultado();
            return $result;
        }

        public function actualizarCli($cli){
            $conexion = new conexion();
            $cliente = $cli;

            $doc_cli = $cliente->obtenerdocumento();
            $nombre_cli = $cliente->obtenernombre();
            $telefono_cli = $cliente->obtenertelefono();

            $sql = "UPDATE cliente SET nombre = '$nombre_cli' WHERE documento = '$doc_cli' AND telefono = '$telefono_cli'";
            $result = $conexion->ejecutar_query($sql);
            return $result;
        }

        public function eliminarCli($cliente){
            $conexion = new conexion();
            $sql = "DELETE FROM cliente WHERE docclie = ?";
            $params = array($cliente);
            $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
            return $filasAfectadas;
        }
    }
?>