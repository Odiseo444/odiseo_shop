<?php
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $celular = $_POST['celular'];

    include_once 'inc\database.php';
    $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `correo`, `contrasena`, `direccion_envio`, `telefono`, `fecha_registro`) VALUES ('$nombre','$apellido','$correo','$clave','null','$celular',)";
    $hacerConsulta = mysqli_query($conexion, $sql);

    header('location:index.php');
?>