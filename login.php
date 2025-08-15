<?php 
    $id = $_POST['id'];
    $servicio = $_POST['servicio'];
    $estado = $_POST['estado'];

    include_once 'inc\database.php';
    $sql = 'SELECT * FROM usuarios';
    $hacerConsulta = mysqli_query($conexion, $sql);
    $user = mysqli_fetch_array($hacerConsulta);

    
    header('location:servicios.php');
?>

?>