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
$sql1 = "SELECT cantidad FROM carrito WHERE id_usuario = $userId";
$result = $conexion->query($sql1);
$sql2 = "SELECT *  FROM productos WHERE id_producto IN (SELECT id_producto FROM carrito WHERE id_usuario = $userId)";
$res = $conexion->query($sql2);
$cantidad = $result->fetch_assoc();
$res2 = $conexion->query($sql2);

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
    $pedidoArray = [
        'id_producto' => $row['id_producto'],
        'nombre' => $row['nombre'],
        'precio' => $row['precio'],
        'cantidad' => $cantidad['cantidad']
        ];
        array_push($pedido['pedido'], $pedidoArray);
        $pedido['precio_total'] += $row['precio'] * $cantidad['cantidad'];
    }
    $iva = $pedido['precio_total'] * 0.19;
    $pedido['precio_total'] += $iva;
    $insertPedido = "INSERT INTO pedidos (id_usuario, pedido, precio_total, fecha, fecha_entrega) VALUES ('$pedido[id_usuario]', '" . json_encode($pedido['pedido']) . "', '$pedido[precio_total]', '$pedido[fecha]', '$pedido[fecha_entrega]')";
    $conexion->query($insertPedido);
    
    while ($row = $res2->fetch_assoc()) {
        $nuevaCantidad = $row['stock'] - $cantidad['cantidad'];
    $updateStock = "UPDATE productos SET stock = '$nuevaCantidad' WHERE id_producto = '$row[id_producto]'";
    $conexion->query($updateStock);
    $conexion->query($sql);
}

header('Content-Type: application/json');
echo json_encode('Pedido realizado con éxito');
?>