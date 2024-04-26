<?php
    class proveedor{
        private $nombre_pro;
        private $contacto_pro;
        private $telefono_pro;
        private $direccion_pro;
        private $ciudad_pro;

        public function __construct($nompro, $contpro, $telpro,$direpro, $ciupro ){
            $this->nombre_pro = $nompro;
            $this->contacto_pro = $contpro;
            $this->telefono_pro = $telpro;
            $this->direccion_pro = $direpro;
            $this->ciudad_pro = $ciupro;
        }

        public function obtenernombre(){
            return $this->nombre_pro;
        }
        public function obtenercontacto(){
            return $this->contacto_pro;
        }
        public function obtenertelefono(){
            return $this->telefono_pro;
        }
        public function obtenerdireccion(){
            return $this->direccion_pro;
        }
        public function obtenerciudad(){
            return $this->ciudad_pro;
        }

    }
?>