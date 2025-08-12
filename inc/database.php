<?php
$conexion = mysqli_connect('localhost', 'root', '') or die ("Error al conectarse al servidor ".mysqli_connect_error());
mysqli_select_db($conexion, 'odiseoShop') or die ("Error no se conecto a la DB ".mysqli_connect_error());
?>