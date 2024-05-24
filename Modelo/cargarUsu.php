<?php
require_once 'conexion.php';
$conexion = new conexion();
$sql = "SELECT * FROM usuarios";
$conexion->buscar_query($sql);
$result = $conexion->obtener_resultado();
?>
<option value="">-- Seleccione el Usuario --</option>
<?php
while($filas = $result->fetch()){; 
?>

<option value="<?php echo $filas['docUsu'] ?>"><?php echo $filas['nombreUsu'] ?></option>
<?php
}
?>