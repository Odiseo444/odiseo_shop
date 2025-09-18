<?php
    session_start();
    $id = $_SESSION['id'];

    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $celular = $_POST['telefono'] ?? '';
    if (ctype_space($_POST['direccion'])) {
        $direcc = 'null';
    } else {
        $direcc = $_POST['direccion'];
    }

    include_once '../inc\database.php';
    if ($nombre == '' || $apellido == '' || $correo == '' || $celular == '') {
        header('location:editAccount.php?log=Rellena todos los campos obligatorios.');
        exit();
    }
    $sql = "UPDATE `usuarios` SET `nombre`='$nombre',`apellido`='$apellido',`correo`='$correo',`direccion_envio`='$direcc',`telefono`='$celular' WHERE id_usuario='$id'";
    $hacerConsulta = mysqli_query($conexion, $sql);

    header('location:account.php?log=Actualizado con exito.');
?>