<?php
require_once '../inc\database.php';

$id= intval($_GET['id']);



header('Content-Type: application/json');
echo json_encode('hola');
?>