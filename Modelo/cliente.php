<?php
    class cliente{
        private $doc_cli;
        private $nombre_cli;
        private $telefono_cli;

        public function __construct($doccli, $nomcli, $telcli)
        {
            $this->doc_cli = $doccli;
            $this->nombre_cli = $nomcli;
            $this->telefono_cli = $telcli;
        }

        public function obtenerdocumento() {
            return $this->doc_cli;
        }
        public function obtenernombre() {
            return $this->nombre_cli;
        }
        public function obtenertelefono() {
            return $this->telefono_cli;
        }
    }
?>