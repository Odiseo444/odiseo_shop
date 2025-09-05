<?php
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $celular = $_POST['celular'];
    $fecha_registro = date('Y-m-d H:i:s');

    include_once 'inc\database.php';
    $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `correo`, `contrasena`, `direccion_envio`, `telefono`, `fecha_registro`) VALUES ('$nombre','$apellido','$correo','$clave','null','$celular','$fecha_registro')";
    $hacerConsulta = mysqli_query($conexion, $sql);

    header('location:login.php?log=Ahora inicia Sesion');
?>