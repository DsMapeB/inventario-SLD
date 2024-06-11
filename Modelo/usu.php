<?php
    class usu{
        private $usuarioDoc;
        private $usuario;
        private $telefono;
        private $password;
        private $foto;
        private $rol;

        public function __construct($doc,$usu,$tel, $pass, $foto, $rol)
        {
            $this->usuarioDoc = $doc;
            $this->usuario = $usu;
            $this->telefono = $tel;
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
        public function obtenertelefono(){
            return $this->telefono;
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