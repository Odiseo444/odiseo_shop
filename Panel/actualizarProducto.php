<?php
$id = $_GET['id'] ?? '';
$name = $_POST['nombre'] ?? '';
$descr = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? '';
$stock = $_POST['stock'] ?? '';
$imagenBaseCode64 = base64_encode(file_get_contents($_FILES['imagen']['tmp_name'])) ?? '';
// $imagenesInput = $_FILES['imagenes'];
// $imagenes = [];
$marca = $_POST['marca'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$subcategoria = $_POST['subcategoria'] ?? '';
$fechaact = date('Y-m-d H:i:s');

/* foreach ($imagenesInput['tmp_name'] as $key => $tmpName) {
    array_push($imagenes, base64_encode(file_get_contents($tmpName)));
} 
$imagenesJson = json_encode($imagenes); */

include_once '../inc\database.php';
if ($name == '' || $descr == '' || $precio == '' || $stock == '' || $marca == '' || $imagenBaseCode64 == '' || $categoria == '' || $subcategoria == '') {
        header('location:updateProducto.php?log=Ocurrio un error.');
    exit();
}

echo $id;

if ($id == '') {
        header('location:updateProducto.php?log=Ocurrio un error.');
        exit();
    }
    $sql = "UPDATE `productos` SET `nombre`='$name',`descripcion`='$descr',`precio`='$precio',`stock`='$stock',`imagen`='$imagenBaseCode64',`marca`='$marca',`id_categoria`='$categoria',`id_subcategoria`='$subcategoria',`ultima_actualizacion`='$fechaact' WHERE id_producto='$id'";
    $hacerConsulta = mysqli_query($conexion, $sql);

    header('location:panel.php');
?>