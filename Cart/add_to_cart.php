<?php
session_start();

if (!isset($_SESSION['id'])) {
    http_response_code(404);
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
} else {
    $userId = $_SESSION['id'];
}

require_once '../inc/database.php';
$info = file_get_contents('php://input');
$id = json_decode($info, true)['productId'];
$cantidad = json_decode($info, true)['cantidad'];
$sql = "SELECT * FROM productos WHERE id_producto = $id";
$res = $conexion->query($sql);
if ($res->num_rows == 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Producto no encontrado']);
    exit;
}
 if ($cantidad < 1) {
    http_response_code(400);
    echo json_encode(['error' => 'Cantidad inválida']);
    exit;
}
$consulta = "SELECT * FROM carrito WHERE id_usuario = $userId AND id_producto = $id";
$resultado = $conexion->query($consulta);
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $nuevaCantidad = $fila['cantidad'] + $cantidad;
    $update = "UPDATE carrito SET cantidad = $nuevaCantidad WHERE id_usuario = $userId AND id_producto = $id";
    $conexion->query($update);
    header('Content-Type: application/json');
    echo json_encode('Cantidad actualizada en el carrito');
    exit;
}
$consult = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES ($userId, $id, $cantidad)";
$conexion->query($consult);

header('Content-Type: application/json');
echo json_encode('Producto agregado al carrito');
?>