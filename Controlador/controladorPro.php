<?php
class controladorproveedor
{
    /*=============================================
        REGISTRO DE proveedores
        =============================================*/

    public function agregarproveedores($nitpro, $nompro, $contpro, $telpro, $direpro, $ciupro)
    {
        $proveedor = new proveedor($nitpro, $nompro, $contpro, $telpro, $direpro, $ciupro);
        $gestorproveedor = new gestorproveedor();
        $result = $gestorproveedor->agregarproveedor($proveedor);
        if ($result == "0") {
            echo "<script>alert('No Se Registro Correctamente');</script>";
            header("Location:index.php?accion=provee");
        } else {
            echo "<script>alert('Registro Exitoso');</script>";
            header("Location:index.php?accion=provee");
        }
    }

    public function consultarPro()
    {
        $gestorproveedor = new gestorproveedor();
        $result = $gestorproveedor->consultarPro();
        require_once 'Vista/html/consultarPro.php';
    }

    public function editarprove($nitpro){
        $gestorproveedor = new gestorproveedor();
        $result = $gestorproveedor->editarPro($nitpro);
        require_once 'Vista/html/modalEditprove.php';
    }

    public function actualizarprove($nitpro,$nombrepro,$contactopro,$telpro,$direcpro,$ciupro){
        $proveedor = new proveedor($nitpro,$nombrepro,$contactopro,$telpro,$direcpro,$ciupro);
        $gestorproveedor = new gestorproveedor();
        $result = $gestorproveedor->actualizarprovee($proveedor);
        if ($result > 0) {
            header("Location:index.php?accion=provee");
        } else{
            header("Location:index.php?accion=provee");
        }
         //($cliente); //
    }

    public function eliminarPro($proveedor)
    {
        $gestorproveedor = new gestorproveedor();
        $registro = $gestorproveedor->eliminarPro($proveedor);
        if ($registro > 0) {
            echo "El Proveedor se ha eliminado con exito";
        } else{
            echo "El Proveedor no se ha podido eliminar";
        }
    }
}
