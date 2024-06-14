<?php
require_once 'conexion.php';
$conexion = new Conexion();
$sql = "SELECT * FROM usuario";
$conexion->buscar_query($sql);
$result = $conexion->obtener_resultado();
?>
<option value="">-- Seleccione el Trabajador --</option>
<?php
while($filas = $result->fetch()){; 
?>

<option value="<?php echo $filas['Usudoc'] ?>"><?php echo $filas['usuario'] ?></option>
<?php
}
?>