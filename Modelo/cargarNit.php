<?php
require_once 'conexion.php';
$conexion = new conexion();
$sql = "SELECT * FROM proveedores";
$conexion->buscar_query($sql);
$result = $conexion->obtener_resultado();
?>
<option value="">-- Seleccione el Nit del Proveedor --</option>
<?php
while($filas = $result->fetch()){;
?>

<option value="<?php echo $filas['nitpro'] ?>"><?php echo $filas['nombrePro'] ?></option>
<?php
}
?>