<?php
session_start();

$correo = $_POST['correo'];
$clave = $_POST['clave'];
include_once 'inc\database.php';
$sql = 'SELECT * FROM usuarios';
$hacerConsulta = mysqli_query($conexion, $sql);
$user = mysqli_fetch_array($hacerConsulta);
if (!($user)) {
    header('location:user.php?error=Credenciales incorrectas');
}
while ($user) {
    $_SESSION['id'] = $user['id_usuario'];
    if ($user['correo'] === $correo && $user['contrasena'] === $clave) {
            header("location:index.php");
            exit;
        } else {
            header('location:user.php?error=Credenciales incorrectas');
            exit;
        }
    }
?>
