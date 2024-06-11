<?php
  require_once 'conexion.php';
  $conexion2 = new conexion();
  $sql2 = "SELECT * FROM rol";
  $conexion2->buscar_query($sql2);
  $result2 = $conexion2->obtener_resultado();
?>
<option value="">-- Seleccione el Rol asignado --</option>
<?php
while($filas2 = $result2->fetch()){;
?>

<option value="<?php echo $filas2['cargoUsu']?>"><?php echo $filas2['nombrerol']?></option>
<?php
}
?>