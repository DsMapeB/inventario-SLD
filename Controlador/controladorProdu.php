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
}
