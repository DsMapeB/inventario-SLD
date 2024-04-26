<?php
    class controladorproveedor{
        /*=============================================
        REGISTRO DE proveedores
        =============================================*/

        public function agregarproveedores($nompro, $contpro, $telpro,$direpro, $ciupro ){
            $proveedor = new proveedor($nompro, $contpro, $telpro,$direpro, $ciupro );
            $gestorproveedor = new gestorproveedor();
            $result = $gestorproveedor->agregarproveedor($proveedor);
            if ($result=="0"){
                echo "<script>alert('No Se Registro Correctamente');</script>";
			header("Location:index.php?accion=provee");	
		} 
		else{
				echo "<script>alert('Registro Exitoso');</script>";
				header("Location:index.php?accion=provee");		
			}
            }
        }
?>