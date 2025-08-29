<?php
$name = $_POST['nombre'];
$descr = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$marca = $_POST['marca'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$fecha = $_POST['fecha_creacion'];
$fechaact = $_POST['ultima_actualizacion'];

include_once 'inc\database.php';
    $sql = "INSERT INTO `productos`(`nombre`, `descripcion`, `precio`, `stock`, `marca`, `id_categoria`, `id_subcategoria`, `fecha_creacion`, `ultima_actualizacion`) VALUES ('$name','$descr','$precio','$stock','$marca','$categoria','$subcategoria','$fecha','$fechaact')";
    $hacerConsulta = mysqli_query($conexion, $sql);

    header('location:createProduct.php');
?>