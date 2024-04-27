<?php
  class usuario{
    private $codigoUsu;
    private $docUsu;
    private $nombreUsu;
    private $telefonoUsu;
    private $ciudadUsu;
    private $direccionUsu;
    private $fotoUsu;
    private $cargoUsu;

    public function __construct($codUsu, $docUsu, $nomUsu, $telUsu, $ciuUsu, $direUsu, $fotoUsu, $cargo)
    {
        $this->codigoUsu = $codUsu;
        $this->docUsu = $docUsu;
        $this->nombreUsu = $nomUsu;
        $this->telefonoUsu = $telUsu;
        $this->ciudadUsu = $ciuUsu;
        $this->direccionUsu = $direUsu;
        $this->fotoUsu = $fotoUsu;
        $this->cargoUsu = $cargo;
    }

    public function obtenercodigo(){
      return $this->codigoUsu;
    }
    public function obtenerdoc(){
      return $this->docUsu;
    }
    public function obtenernombre(){
      return $this->nombreUsu;
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