<?php
    class usu{
        private $usuarioDoc;
        private $usuario;
        private $password;
        private $foto;
        private $rol;

        public function __construct($doc,$usu, $pass, $foto, $rol)
        {
            $this->usuarioDoc = $doc;
            $this->usuario = $usu;
            $this->password = $pass;
            $this->foto = $foto;
            $this->rol = $rol;
        }

        public function obtenerdocumento(){
            return $this->usuarioDoc;
        }
        public function obtenerusuario(){
            return $this->usuario;
        }
        public function obtenerpassword(){
            return $this->password;
        }
        public function obtenerfoto(){
            return $this->foto;
        }
        public function obtenerrol(){
            return $this->rol;
        }
    }
?>