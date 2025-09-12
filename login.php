<?php
session_start();

$correo = $_POST['correo'];
$clave = $_POST['clave'];
include_once 'inc\database.php';
$sql = 'SELECT * FROM usuarios';
$hacerConsulta = mysqli_query($conexion, $sql);
if (!($user)) {
    header('location:user.php?error=Credenciales incorrectas');
}
while ($user = mysqli_fetch_array($hacerConsulta)) {
    if ($user['correo'] === $correo && $user['clave'] === $clave) {
        $_SESSION['id'] = $user['id_usuario'];
            header("location:index.php");
        } else {
            header('location:user.php?error=Credenciales incorrectas');
        }
    }
?>
