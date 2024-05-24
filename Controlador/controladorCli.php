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

        public function editarCli($docclie){
            
            $gestorcliente = new gestorcliente();
            $result2 = $gestorcliente->editarcli($docclie);
            require_once 'Vista/html/modalEditCli.php';
        }

        public function actualizarCli($doccli, $nomcli, $telcli){
            $cliente = new cliente($doccli, $nomcli, $telcli);
            $gestorcliente = new gestorcliente();
            $result = $gestorcliente->actualizarCli($cliente);
            if ($result > 0) {
                header("Location:index.php?accion=cliente");
            } else{
                header("Location:index.php?accion=cliente");
            }
            
        }

        public function eliminarCli($cliente){
            $gestorcliente = new gestorcliente();
            $registro = $gestorcliente->eliminarCli($cliente);
            if ($registro > 0) {
                echo "El Cliente se ha eliminado con exito";
            } else{
                echo "El Cliente no se ha podido eliminar";
            } //
        }
    }
?>