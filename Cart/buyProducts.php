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
$sql = "DELETE FROM carrito WHERE id_usuario = $userId";
$sql2 = "SELECT p.id_producto,  FROM productos WHERE id_producto IN (SELECT id_producto FROM carrito WHERE id_usuario = $userId)";
$res = $conexion->query($sql2);
$conexion->query($sql);

if ($res->num_rows == 0) {
    http_response_code(404);
    echo json_encode(['error' => 'Producto no encontrado']);
    exit;
}

$pedido = [
    'id_usuario' => $userId,
    'pedido' => [],
    'precio_total' => '0',
    'fecha' => date('Y-m-d H:i:s'),
    'fecha_entrega' => date('Y-m-d H:i:s', strtotime('+7 days'))
];

while ($row = $res->fetch_assoc()) {
    $pedido['pedido'] .= [
        'id_producto' => $row['id_producto'],
        'nombre' => $row['nombre'],
        'precio' => $row['precio'],
        'cantidad' => $row['cantidad']
    ];
    $pedido['precio_total'] += $row['precio'] * $row['cantidad'];
}

$insertPedido = "INSERT INTO pedidos (id_usuario, pedido, precio_total, fecha, fecha_entrega) VALUES ('$pedido[id_usuario]', '$pedido[pedido]', '$pedido[precio_total]', '$pedido[fecha]', '$pedido[fecha_entrega]')";
$conexion->query($insertPedido);

while ($row = $res->fetch_assoc()) {
    $nuevaCantidad = $row['stock'] - $row['cantidad'];
    $updateStock = "UPDATE productos SET stock = '$nuevaCantidad' WHERE id_producto = '$row[id_producto]'";
    $conexion->query($updateStock);
}

header('Content-Type: application/json');
echo json_encode('Pedido realizado con éxito');
?>