<?php
session_start();
$id= $_GET['id'] ?? $_SESSION['id'];
if ($id == null) {
    header('location: user.php?warning=Inicia Sesión o registrate para ingresar');
}
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
        <h1>Perfil de Usuario</h1>
    </header>

    <div class="perfil-contenedor">
        <div class="perfil-card">
            <div class="perfil-header">
                <img src="img/user.png" alt="Avatar del usuario" class="avatar">
                <h2 class="nombre-usuario">Editar perfil</h2>
                <p class="correo-usuario"><?php echo $user['nombre'] . " " . $user['apellido'] ?></p>
            </div>
            <div class="perfil-info">
                <h3>Información Personal</h3>
                <form action="editAcc.php" method="post">
                <ul>
                    <li><strong>Nombre completo:</strong> <input type="text" name="nombre" value="<?php echo $user['nombre']?>" placeholder="Nombre"><input type="text" name="apellido" value="<?php echo $user['apellido'] ?>" placeholder="Apellido"></li>
                    <li><strong>Correo electrónico:</strong> <input type="text" name="correo" value="<?php echo $user['correo'] ?>" placeholder="Email"></li>
                    <li><strong>Teléfono:</strong> <input type="text" name="telefono" value="<?php echo $user['telefono'] ?>" placeholder="Telefono"></li>
                    <li><strong>Dirección:</strong> <?php 
                    if ($user['direccion_envio'] == 'null') {
                        echo '<input type="text" name="direccion" value="" placeholder="Dirección">';
                    } else {
                        echo '<input type="text" name="direccion" value="' . $user['direccion_envio'] . '" placeholder="Dirección">';
                    }
                     ?></li>
                </ul>
            </div>
            <div class="perfil-acciones">
                <input type="submit" class="btn-editar" value="Aceptar Cambios">
            </form>
                <button class="btn-cerrar" onclick="window.location.replace('account.php')">Cancelar</button>
            </div>
        </div>
    </div>

</body>
</html>
