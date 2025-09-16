<?php
$name = $_POST['nombre'];
$descr = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$imagenBaseCode64 = base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
$imagenesInput = $_FILES['imagenes']['name'];
$imagenes = [];
$marca = $_POST['marca'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$fecha = date('Y-m-d H:i:s');
$fechaact = date('Y-m-d H:i:s');

for ($i=0; $i < count($imagenesInput); $i++) { 
    array_push($imagenes, base64_encode(file_get_contents($imagenesInput[$i])));
}
$imagenesJson = json_encode($imagenes);
include_once 'inc\database.php';
    $sql = "INSERT INTO `productos`(`nombre`, `descripcion`, `precio`, `stock`, `imagen`, `imagenes`, `marca`, `id_categoria`, `id_subcategoria`, `fecha_creacion`, `ultima_actualizacion`) VALUES ('$name','$descr','$precio','$stock', '$imagenBaseCode64', '$imagenesJson', '$marca','$categoria','$subcategoria','$fecha','$fechaact')";
    $hacerConsulta = mysqli_query($conexion, $sql);

    header('location:createProduct.php');
?>