<?php
session_start();
require_once '../inc\database.php';

$id= intval($_GET['id']);
$cant = $_GET['cant'] ?? 1;
if ($cant) {
    $consult = 'SELECT * FROM carrito WHERE id_producto=' . $id ;
    $doConsult = mysqli_query($conexion, $consult);
    $row = mysqli_fetch_array($doConsult);
    
    if ($cant <= $row['cantidad'] && $row['cantidad'] >= 0) {
        if ($row['cantidad'] == 1 && $cant == 0) {
        $sql2 = "DELETE FROM `carrito` WHERE id_producto='$id'";
        $hacerConsulta2 = mysqli_query($conexion, $sql2);
        header('Content-Type: application/json');
        echo json_encode('producto eliminado');
        exit;
        $resta = $row['cantidad'] - $cant;
        $sql = "UPDATE `carrito` SET cantidad='$cant' WHERE id_producto='$id'";
        $hacerConsulta = mysqli_query($conexion, $sql);
        header('Content-Type: application/json');
        echo json_encode('cantidad reducida' && $resta);
        exit;
    } elseif ($cant > $row['cantidad']) {
    }
        $suma = $cant - $row['cantidad'];
        $sql = "UPDATE `carrito` SET cantidad='$cant' WHERE id_producto='$id' AND id_usuario='" . $_SESSION['id'] . "'";
        $hacerConsulta = mysqli_query($conexion, $sql);
        header('Content-Type: application/json');
        echo json_encode('cantidad aumentada' && $suma);
        exit;
    }
}
?>