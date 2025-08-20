
<?php
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $recordar = isset($_POST['recordar']) ? $_POST['recordar'] : 'false';
    include_once 'inc\database.php';
    $sql = 'SELECT * FROM usuarios';
    $hacerConsulta = mysqli_query($conexion, $sql);
    $user = mysqli_fetch_array($hacerConsulta);
    while ($user) {
        if ($user['correo'] === $correo && $user['contrasena'] === $clave) {
            header("location:index.php?correo='$correo'&&clave='$clave'");
            exit;
        } else {
            header('location:user.php?error=Credenciales incorrectas');
            exit;
        }
    }
?>
