<?php
session_start();
if (!isset($_SESSION['id'])) {
    http_response_code(404);
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}
$userId = $_SESSION['id'];
require_once '../inc\database.php';

$id= intval($_GET['id']);
$sql1 = "DELETE FROM carrito WHERE id_producto = $id";
$hacerConsulta1 = mysqli_query($conexion, $sql1);
$sql = "DELETE FROM `productos` WHERE id_producto='$id'";
$hacerConsulta = mysqli_query($conexion, $sql);


header('Content-Type: application/json');
echo json_encode('eliminado');
?>