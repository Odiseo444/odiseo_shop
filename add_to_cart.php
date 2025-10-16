<?php
require_once '../inc\database.php';
$id = file_get_contents('php://input');
$sql = "SELECT * FROM productos WHERE id_productos = $id";
$res = $conexion->query($sql);
$consult = "INSERT INTO carrito (id_usuario, id_productoS, cantidad) VALUES (1, $id, 1)";
$productos = [];
while ($row = $res->fetch_assoc()) {
    $productos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($productos);
?>