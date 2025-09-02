<?php
$id= $_GET['id'];
include_once 'inc\database.php';
$sql = "SELECT * FROM usuarios WHERE id_usuario=$id";
$hacerConsulta = mysqli_query($conexion, $sql);
$user = mysqli_fetch_array($hacerConsulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil del Usuario || Odiseo Shop</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <header class="header">
        <button class="btn-volver" onclick="window.history.back()">⟵ Volver</button>
        <h1>Perfil de Usuario</h1>
    </header>

    <div class="perfil-contenedor">
        <div class="perfil-card">
            <div class="perfil-header">
                <img src="img/user.png" alt="Avatar del usuario" class="avatar">
                <h2 class="nombre-usuario"><?php echo $user['nombre']?></h2>
                <p class="correo-usuario">juan.perez@email.com</p>
            </div>
            <div class="perfil-info">
                <h3>Información Personal</h3>
                <ul>
                    <li><strong>Nombre completo:</strong> Juan Pérez</li>
                    <li><strong>Correo electrónico:</strong> juan.perez@email.com</li>
                    <li><strong>Teléfono:</strong> +34 600 123 456</li>
                    <li><strong>Dirección:</strong> Calle Falsa 123, Ciudad, País</li>
                    <li><strong>Miembro desde:</strong> 12 de enero de 2021</li>
                </ul>
            </div>
            <div class="perfil-acciones">
                <button class="btn-editar">Editar perfil</button>
                <button class="btn-cerrar">Cerrar sesión</button>
            </div>
        </div>
    </div>

</body>
</html>
