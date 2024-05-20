<?php
  class usuario{
    private $docUsu;
    private $nombreUsu;
    private $passwordUsu;
    private $telefonoUsu;
    private $ciudadUsu;
    private $direccionUsu;
    private $fotoUsu;
    private $cargoUsu;

    public function __construct($docUsu, $nomUsu, $passUsu, $telUsu, $ciuUsu, $direUsu, $fotoUsu, $cargo)
    {
        $this->docUsu = $docUsu;
        $this->nombreUsu = $nomUsu;
        $this->passwordUsu = $passUsu;
        $this->telefonoUsu = $telUsu;
        $this->ciudadUsu = $ciuUsu;
        $this->direccionUsu = $direUsu;
        $this->fotoUsu = $fotoUsu;
        $this->cargoUsu = $cargo;
    }
    
    public function obtenerdoc(){
      return $this->docUsu;
    }
    public function obtenernombre(){
      return $this->nombreUsu;
    }
    public function obtenerpassword(){
      return $this->passwordUsu;
    }
    public function obtenertelefono(){
      return $this->telefonoUsu;
    }
    public function obtenerciudad(){
      return $this->ciudadUsu;
    }
    public function obtenerdireccion(){
      return $this->direccionUsu;
    }
    public function obtenerfoto(){
      return $this->fotoUsu;
    }
    public function obtenercargo(){
      return $this->cargoUsu;
    }
  }
?>