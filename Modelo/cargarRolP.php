<?php
  require_once 'conexion.php';
  $conexion = new conexion();
  $sql = "SELECT * FROM rol";
  $conexion->buscar_query($sql);
  $result = $conexion->obtener_resultado();
?>
<?php
while($filas = $result->fetch()){;
?>

<option value="<?php echo $filas['cargoUsu']?>"><?php echo $filas['nombrerol']?></option>
<?php
}
?>