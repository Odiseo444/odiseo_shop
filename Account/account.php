<?php
session_start();
$id= $_GET['id'] ?? $_SESSION['id'];
if ($id == null) {
    header('location:../User/user.php?log=Inicia Sesión o Registrate para ingresar');
}
include_once '../inc\database.php';
$sql = "SELECT * FROM usuarios WHERE id_usuario=$id";
$hacerConsulta = mysqli_query($conexion, $sql);
$user = mysqli_fetch_array($hacerConsulta);

if (isset($_GET['log'])) {
    $log = $_GET['log'];
    echo "<script>
    window.addEventListener('DOMContentLoaded', () => {
    Swal.fire({
  title: '$log',
  icon: 'success',
  draggable: true
});
});
    </script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil del Usuario || Odiseo Shop</title>
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <header class="header">
        <button class="btn-volver" onclick="window.location.href = '../index.php'">⟵ Volver</button>
        <h1>Perfil de Usuario</h1>
    </header>

    <div class="perfil-contenedor">
        <div class="perfil-card">
            <div class="perfil-header">
                <img src="../img/user.png" alt="Avatar del usuario" class="avatar">
                <h2 class="nombre-usuario"><?php echo $user['nombre'] . " " . $user['apellido'] ?></h2>
                <p class="correo-usuario"><?php echo $user['correo'] ?></p>
            </div>
            <div class="perfil-info">
                <h3>Información Personal</h3>
                <ul>
                    <li><strong>Nombre completo:</strong> <?php echo $user['nombre'] . " " . $user['apellido'] ?></li>
                    <li><strong>Correo electrónico:</strong> <?php echo $user['correo'] ?></li>
                    <li><strong>Teléfono:</strong> <?php echo $user['telefono'] ?></li>
                    <li><strong>Dirección:</strong> <?php 
                    if ($user['direccion_envio'] == 'null') {
                        echo 'Edite su perfil para agregar una dirección de envio.';
                    } else {
                        echo $user['direccion_envio'];
                    }
                     ?></li>
                    <li><strong>Miembro desde:</strong> <?php 
                    $objeto_fecha = $user['fecha_registro'];
                    $fecha0 = explode('-', $objeto_fecha);
                    $fecha = explode(' ', $fecha0[2]);
                    $mes = function($f) {
                        switch ($f[1]) {
                            case '01':
                                return 'enero';
                                break;
                            case '02':
                                return 'febrero';
                                break;
                            case '03':
                                return 'marzo';
                                break;
                            case '04':
                                return 'abril';
                                break;
                            case '05':
                                return 'mayo';
                                break;
                            case '06':
                                return 'junio';
                                break;
                            case '07':
                                return 'julio';
                                break;
                            case '08':
                                return 'agosto';
                                break;
                            case '09':
                                return 'septiembre';
                                break;
                            case '10':
                                return 'octubre';
                                break;
                            case '11':
                                return 'noviembre';
                                break;
                            case '12':
                                return 'dieciembre';
                                break;
                            
                            default:
                                return '?';
                                break;
                        }
                    };
                    echo 'el ' . $fecha[0] . ' de ' . $mes($fecha0[1]) . ' del ' . $fecha0[0] . ' a las ' . $fecha[1] ?></li>
                </ul>
            </div>
            <div class="perfil-acciones">
                <button class="btn-editar" onclick="window.location.replace('editAccount.php')">Editar perfil</button>
                <button class="btn-cerrar" onclick="alert()">Cerrar sesión</button>
            </div>
        </div>
    </div>

</body>
<script>
    function alert() {
        Swal.fire({
      title: "¿Estas seguro de cerrar sesión?",
      text: "Puedes volver a iniciar sesión mas tarde.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, cerrar sesión"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.replace('closeAcc.php');
      }
    });
    }
</script>
</html>
