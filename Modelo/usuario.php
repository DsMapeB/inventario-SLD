<?php
  class usuario{
    private $codigoUsu;
    private $nombreUsu;
    private $telefonoUsu;
    private $ciudadUsu;
    private $direccionUsu;
    private $cargoUsu;

    public function __construct($codUsu, $nomUsu, $telUsu, $ciuUsu, $direUsu, $cargo)
    {
        $this->codigoUsu = $codUsu;
        $this->nombreUsu = $nomUsu;
        $this->telefonoUsu = $telUsu;
        $this->ciudadUsu = $ciuUsu;
        $this->direccionUsu = $direUsu;
        $this->cargoUsu = $cargo;
    }

    public function obtenercodigo(){
      return $this->codigoUsu;
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
    public function obtenercargo(){
      return $this->cargoUsu;
    }
  }
?>