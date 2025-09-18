<?php
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $celular = $_POST['celular'] ?? '';
    $fecha_registro = date('Y-m-d H:i:s');

    include_once '../inc\database.php';
    $consult = "SELECT * FROM usuarios";
    $doConsult = mysqli_query($conexion, $consult);
    while ($user = mysqli_fetch_array($doConsult)) {
        if ($user['correo'] === $correo) {
            header('location:user.php?warning=Ya existe una cuenta con ese correo, inicia sesion o intenta con otro');
        } else if ($user['telefono'] === $celular) {
            header('location:user.php?warning=Ya existe una cuenta con ese numero telefonico, inicia sesion o intenta con otro');
        }
    }
    
    if ($nombre == '' || $apellido == '' || $correo == '' || $clave == '' || $celular == '') {
        header('location:user.php?log=Rellena todos los campos obligatorios.');
        exit();
    }
    
    $sql = "INSERT INTO `usuarios`(`nombre`, `apellido`, `correo`, `clave`, `direccion_envio`, `telefono`, `fecha_registro`, `rol`) VALUES ('$nombre','$apellido','$correo','$clave','null','$celular','$fecha_registro', '1')";
    $hacerConsulta = mysqli_query($conexion, $sql);
    header('location:user.php?log=Ahora inicia Sesion');
?>