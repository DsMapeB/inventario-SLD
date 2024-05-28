<?php
    class usu{
        private $usuario;
        private $password;
        private $rol;

        public function __construct($usu, $pass, $rol)
        {
            $this->usuario = $usu;
            $this->password = $pass;
            $this->rol = $rol;
        }

        public function obtenerusuario(){
            return $this->usuario;
        }
        public function obtenerpassword(){
            return $this->password;
        }
        public function obtenerrol(){
            return $this->rol;
        }
    }
?>