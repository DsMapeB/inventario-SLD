<?php
require_once 'conexion.php';
$conexion = new Conexion();
$sql = "SELECT * FROM producto";
$conexion->buscar_query($sql);
$result = $conexion->obtener_resultado();
?>
<option value="">-- Seleccione el Producto --</option>
<?php
while ($filas = $result->fetch()) {;
?>
    <option value="<?php echo $filas['codprodu'] ?>"><?php echo $filas['nombreprodu'] ?></option>
<?php
}
if (!$filas['codprodu']) {
?>
    <option disabled>No hay mas Productos disponibles</option>
<?php
}
?>