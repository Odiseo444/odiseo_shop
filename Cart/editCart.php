<?php
session_start();
require_once '../inc\database.php';

$id= intval($_GET['id']);
$cant = $_GET['cant'] ?? 1;
if ($cant) {
    $consult = 'SELECT * FROM carrito WHERE id_producto=' . $id . ' AND id_usuario=' . intval($_SESSION['id']);
    $sql2 = "SELECT * FROM productos WHERE id_producto='$id'";
    $hacerConsulta2 = mysqli_query($conexion, $sql2);
    $doConsult = mysqli_query($conexion, $consult);
    $row = mysqli_fetch_array($doConsult);
    $row2 = mysqli_fetch_array($hacerConsulta2);
    
    if ($cant <= $row['cantidad'] && $cant > 0) {
        $resta = $row2['precio'] * ($row['cantidad'] - $cant);
        $sql = "UPDATE `carrito` SET cantidad='$cant' WHERE id_producto='$id'";
        $hacerConsulta = mysqli_query($conexion, $sql);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'cantidad reducida',
         'price' => $resta]);
        exit;
    } elseif ($cant > $row['cantidad']) {
        $suma = $row2['precio'] * ($cant - $row['cantidad']);
        $sql = "UPDATE `carrito` SET cantidad='$cant' WHERE id_producto='$id' AND id_usuario='" . $_SESSION['id'] . "'";
        $hacerConsulta = mysqli_query($conexion, $sql);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'cantidad aumentada',
         'price' => $suma
         ]
        );
        exit;
    }
}
?>