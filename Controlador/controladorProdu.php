<?php
class controladorProdu
{
    public function agregarproductos($codprodu, $nomprodu, $precioprodu, $exisprodu, $proveprodu)
    {
        $producto = new producto($codprodu, $nomprodu, $precioprodu, $exisprodu, $proveprodu);
        $gestorprodu = new gestorprodu();
        $result = $gestorprodu->agregarproducto($producto);
        if ($result == "0") {
            echo "<script>alert('No Se Registro Correctamente');</script>";
            header("Location:index.php?accion=produ");
        } else {
            echo "<script>alert('Registro Exitoso');</script>";
            header("Location:index.php?accion=produ");
        }
    }

    public function consultarProdu(){
        $gestorprodu = new gestorprodu();
        $result = $gestorprodu->consultarProdu();
        require_once 'Vista/html/consultarProdu.php';
    }

    public function eliminarProdu($producto){
        $gestorprodu = new gestorprodu();
        $registro = $gestorprodu->eliminarProdu($producto);
        if ($registro > 0) {
            echo "El Producto se ha eliminado con exito";
        } else{
            echo "El Producto no se ha podido eliminar";
        }
    }
}
