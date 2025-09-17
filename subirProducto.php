<?php
$name = $_POST['nombre'];
$descr = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagenBaseCode64 = base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
// $imagenesInput = $_FILES['imagenes'];
// $imagenes = [];
$marca = $_POST['marca'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$fecha = date('Y-m-d H:i:s');
$fechaact = date('Y-m-d H:i:s');

/* foreach ($imagenesInput['tmp_name'] as $key => $tmpName) {
    array_push($imagenes, base64_encode(file_get_contents($tmpName)));
} 
$imagenesJson = json_encode($imagenes); */

include_once 'inc\database.php';
    $sql = "INSERT INTO `productos`(`nombre`, `descripcion`, `precio`, `stock`, `imagen`, `imagenes`, `marca`, `id_categoria`, `id_subcategoria`, `fecha_creacion`, `ultima_actualizacion`) VALUES ('$name','$descr','$precio','$stock', '$imagenBaseCode64', '', '$marca','$categoria','$subcategoria','$fecha','$fechaact')";
    $hacerConsulta = mysqli_query($conexion, $sql);

    header('location:createProduct.php');
?>