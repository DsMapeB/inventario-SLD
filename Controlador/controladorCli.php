<?php
    class controladorcli {
        public function agregarclientes ($doccli, $nomcli, $telcli){
            $cliente = new cliente($doccli, $nomcli, $telcli);
            $gestorcliente = new gestorcliente();
            $result = $gestorcliente->agregarcliente($cliente);
            if ($result == "0") {
                echo "<script>alert('No Se Registro Correctamente');</script>";
                header("Location:index.php?accion=cliente");
            } else {
                echo "<script>alert('Registro Exitoso');</script>";
                header("Location:index.php?accion=cliente");
            }
        }

        public function consultarCli(){
            $gestorcliente = new gestorcliente();
            $result = $gestorcliente->consultarCli();
            require_once 'Vista/html/consultarCli.php';
        }
    }
?>