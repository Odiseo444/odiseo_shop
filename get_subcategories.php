<?php
require_once 'inc\database.php';

$categoria_id = intval($_GET['categoria_id']);
$sql = "SELECT id_subcategoria, nombre FROM subcategorias WHERE id_categoria = $categoria_id";
$res = $conexion->query($sql);

$subcategorias = [];
while($row = $res->fetch_assoc()){
    $subcategorias[] = [
        "id_subcategoria" => $row['id_subcategoria'],
        "nombre" => $row['nombre']
    ];
}

header('Content-Type: application/json');
echo json_encode($subcategorias);
?>