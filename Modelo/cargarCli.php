<?php
require_once 'conexion.php';
$conexion = new Conexion();
$sql = "SELECT * FROM cliente";
$conexion->buscar_query($sql);
$result = $conexion->obtener_resultado();
?>
<option value="">-- Seleccione el Cliente --</option>
<?php
while ($filas = $result->fetch()) {;
?>
    <option value="<?php echo $filas['docclie'] ?>"><?php echo $filas['nombreclie'] ?></option>
<?php
}
if (!$filas['docclie']) {
?>
    <option disabled>No hay mas Clientes disponibles</option>
<?php
}
?>