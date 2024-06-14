<?php
require_once 'conexion.php';
$conexion = new conexion();

// Consulta para obtener el máximo código de venta
$sql = "SELECT MAX(codventa) AS max_codventa FROM venta";
$conexion->buscar_query($sql);
$result = $conexion->obtener_resultado();

if ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
    // Obtener el máximo código de venta y sumarle 1 para el siguiente
    $siguiente_codigo = intval($fila['max_codventa']) + 1;
} else {
    // Si no hay ventas registradas aún, empezar desde 1
    $siguiente_codigo = 1;
}

// Devolver el código de venta como respuesta
echo $siguiente_codigo;
?>