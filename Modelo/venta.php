<?php
class venta{
    private $cod_venta;
    private $fecha_venta;
    private $hora_venta;
    private $id_usu;
    private $doc_clie;
    private $cod_produ;
    private $observacion_venta;
    private $total_venta;


    public function __construct($codventa,$fechaventa,$horaventa,$idusu,$docclie,$codprodu,$obs,$total){
        $this->cod_venta = $codventa;
        $this->fecha_venta = $fechaventa;
        $this->hora_venta = $horaventa;
        $this->id_usu = $idusu;
        $this->doc_clie = $docclie;
        $this->cod_produ = $codprodu;
        $this->observacion_venta = $obs;
        $this->total_venta = $total;
    }
    

    public function obtenercodigo(){
        return $this->cod_venta;
    }
    public function obtenerfecha(){
        return $this->fecha_venta;
    }
    public function obtenerhora(){
        return $this->hora_venta;
    }
    public function obteneridusu(){
        return $this->id_usu;
    }
    public function obtenerdocclie(){
        return $this->doc_clie;
    }
    public function obtenercodprodu(){
        return $this->cod_produ;
    }
    public function obtenerobs(){
        return $this->observacion_venta;
    }
    public function obtenertotal(){
        return $this->total_venta;
    }

}
?>