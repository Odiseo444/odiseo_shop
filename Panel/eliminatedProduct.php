<?php
require_once '../inc\database.php';

$id= intval($_GET['id']);
$sql = "DELETE FROM `productos` WHERE id_producto='$id'";
$hacerConsulta = mysqli_query($conexion, $sql);


header('Content-Type: application/json');
echo json_encode('eliminado');
?>