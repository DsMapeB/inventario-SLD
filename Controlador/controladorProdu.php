<?php
class ControladorProdu
{
    public function agregarproductos($codprodu, $nomprodu, $precioprodu, $exisprodu, $proveprodu)
    {
        $producto = new Producto($codprodu, $nomprodu, $precioprodu, $exisprodu, $proveprodu);
        $gestorprodu = new GestorProdu();
        $result = $gestorprodu->agregarproducto($producto);
        if ($result == 1) {
            /***   Registro satisfactorio    ***/
            header("Location:index.php?accion=produ&error=1");
        }
        if ($result == 2) {
            /***   Usuario Repetido    ***/
            header("Location:index.php?accion=produ&error=2");
        }
        if ($result == 3) {
            /***   Error en registro    ***/
            header("Location:index.php?accion=produ&error=3");
        }
    }

    public function consultarProdu()
    {
        $gestorprodu = new GestorProdu();
        $result = $gestorprodu->consultarProdu();
        require_once 'Vista/html/consultarProdu.php';
    }

    public function editarProdu($codprodu)
    {
        $gestorprodu = new GestorProdu();
        $result = $gestorprodu->editarProdu($codprodu);
        $result2 = $gestorprodu->consultarProve();
        require_once 'Vista/html/modalEditprodu.php';
    }

    public function actualizarProdu($codprodu, $nomprodu, $precioprodu, $exisprodu, $proveprodu)
    {
        $producto = new Producto($codprodu, $nomprodu, $precioprodu, $exisprodu, $proveprodu);
        $gestorprodu = new GestorProdu();
        $result = $gestorprodu->actualizarProdu($producto);
        if ($result == 1) {
            /***   Registro satisfactorio    ***/
            header("Location:index.php?accion=produ&error2=1");
        }
        if ($result == 2) {
            /***   Usuario Repetido    ***/
            header("Location:index.php?accion=produ&error2=2");
        }
    }

    public function eliminarProdu($producto)
    {
        $gestorprodu = new GestorProdu();
        $registro = $gestorprodu->eliminarProdu($producto);
        if ($registro > 0) {
            echo "El Producto se ha eliminado con exito";
        } else {
            echo "El Producto no se ha podido eliminar";
        }
    }
}
