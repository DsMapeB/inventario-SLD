<?php
  class Roles{
    
    private $rol;

    public function __construct($rol)
    {
      
      $this->rol = $rol;
    }

    public function obtenerrol(){
      return $this->rol;
    }
    
  }
?>