<?php
    class controladorcli {
        public function agregarclientes ($doccli, $nomcli, $telcli){
            $cliente = new cliente($doccli, $nomcli, $telcli);
            $gestorcliente = new gestorcliente();
            $result = $gestorcliente->agregarcliente($cliente);
            if ($result == 1) {
                /***   Registro satisfactorio    ***/
                header("Location:index.php?accion=cliente&error=1");
            }
            if ($result == 2) {
                /***   Usuario Repetido    ***/
                header("Location:index.php?accion=cliente&error=2");
            }
            if ($result == 3) {
                /***   Error en registro    ***/
                header("Location:index.php?accion=cliente&error=3");
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
            if ($result == 1) {
                header("Location:index.php?accion=cliente&error2=1");
            }
            if ($result == 2) {
                header("Location:index.php?accion=cliente&error2=2");
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