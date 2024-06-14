<?php
    class Producto{
        private $cod_produ;
        private $nombre_produ;
        private $precio_produ;
        private $existencia_produ;
        private $prove_produ;

        public function __construct($codprodu, $nomprodu, $precioprodu, $exisprodu, $proveprodu)
        {
            $this->cod_produ = $codprodu;
            $this->nombre_produ = $nomprodu;
            $this->precio_produ = $precioprodu;
            $this->existencia_produ = $exisprodu;
            $this->prove_produ = $proveprodu;
        }

        public function obtenercodigo(){
            return $this->cod_produ;
        }
        public function obtenernombre(){
            return $this->nombre_produ;
        }
        public function obtenerprecio(){
            return $this->precio_produ;
        }
        public function obtenerexistencia(){
            return $this->existencia_produ;
        }
        public function obtenerproveedor(){
            return $this->prove_produ;
        }
    }
?>