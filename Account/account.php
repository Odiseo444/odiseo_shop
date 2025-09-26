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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <button class="btn-volver" onclick="window.location.href = '../index.php'">
                ⟵ Volver
            </button>
            <h1>Perfil de Usuario</h1>
            <div class="logo-mini">ODISEO SHOP</div>
        </div>
    </header>

    <div class="perfil-contenedor">
        <div class="perfil-card">
            <div class="perfil-header">
                <img src="../img/user.png" alt="Avatar del usuario" class="avatar">
                <h2 class="nombre-usuario"><?php echo $user['nombre'] . " " . $user['apellido'] ?></h2>
                <p class="correo-usuario"><?php echo $user['correo'] ?></p>
                
                <!-- Stats rápidas -->
                <div class="quick-stats">
                    <div class="stat-item">
                        <span class="stat-number">0</span>
                        <span class="stat-label">Pedidos</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">★★★★★</span>
                        <span class="stat-label">Usuario VIP</span>
                    </div>
                </div>
            </div>

            <div class="perfil-info">
                <h3>Información Personal</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">
                            <div class="info-icon">👤</div>
                            Nombre completo
                        </div>
                        <div class="info-value"><?php echo $user['nombre'] . " " . $user['apellido'] ?></div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <div class="info-icon">📧</div>
                            Correo electrónico
                        </div>
                        <div class="info-value"><?php echo $user['correo'] ?></div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <div class="info-icon">📱</div>
                            Teléfono
                        </div>
                        <div class="info-value"><?php echo $user['telefono'] ?></div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <div class="info-icon">🏠</div>
                            Dirección de envío
                        </div>
                        <div class="info-value"><?php 
                        if ($user['direccion_envio'] == 'null') {
                            echo 'Edite su perfil para agregar una dirección de envío.';
                        } else {
                            echo $user['direccion_envio'];
                        }
                         ?></div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <div class="info-icon">📅</div>
                            Miembro desde
                        </div>
                        <div class="info-value"><?php 
                        $objeto_fecha = $user['fecha_registro'];
                        $fecha0 = explode('-', $objeto_fecha);
                        $fecha = explode(' ', $fecha0[2]);
                        $mes = function($f) {
                            switch ($f) {
                                case '01': return 'enero';
                                case '02': return 'febrero';
                                case '03': return 'marzo';
                                case '04': return 'abril';
                                case '05': return 'mayo';
                                case '06': return 'junio';
                                case '07': return 'julio';
                                case '08': return 'agosto';
                                case '09': return 'septiembre';
                                case '10': return 'octubre';
                                case '11': return 'noviembre';
                                case '12': return 'diciembre';
                                default: return '?';
                            }
                        };
                        echo 'el ' . $fecha[0] . ' de ' . $mes($fecha0[1]) . ' del ' . $fecha0[0] . ' a las ' . $fecha[1] ?></div>
                    </div>
                </div>
            </div>

            <div class="perfil-acciones">
                <button class="btn-action btn-editar" onclick="window.location.replace('editAccount.php')">
                    ✏️ Editar perfil
                </button>
                <button class="btn-action btn-cerrar" onclick="showLogoutAlert()">
                    🚪 Cerrar sesión
                </button>
            </div>
        </div>
    </div>

    <script>
        function showLogoutAlert() {
            Swal.fire({
                title: "¿Estás seguro de cerrar sesión?",
                text: "Puedes volver a iniciar sesión más tarde.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sí, cerrar sesión",
                backdrop: true,
                allowOutsideClick: false,
                customClass: {
                    popup: 'swal-modern',
                    title: 'swal-title',
                    content: 'swal-content'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar loading
                    Swal.fire({
                        title: 'Cerrando sesión...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    setTimeout(() => {
                        window.location.replace('closeAcc.php');
                    }, 1500);
                }
            });
        }

        // Agregar estilos personalizados para SweetAlert
        const style = document.createElement('style');
        style.textContent = `
            .swal-modern {
                border-radius: 20px !important;
                border: 2px solid #e9ecef !important;
            }
            .swal-title {
                color: #000 !important;
                font-weight: 700 !important;
            }
            .swal-content {
                color: #666 !important;
            }
        `;
        document.head.appendChild(style);

        // Efectos adicionales al cargar
        document.addEventListener('DOMContentLoaded', function() {
            // Efecto de typing en el nombre
            const nombreElement = document.querySelector('.nombre-usuario');
            if (nombreElement) {
                const nombre = nombreElement.textContent;
                nombreElement.textContent = '';
                let i = 0;
                const typeEffect = setInterval(() => {
                    nombreElement.textContent += nombre.charAt(i);
                    i++;
                    if (i >= nombre.length) {
                        clearInterval(typeEffect);
                    }
                }, 50);
            }

            // Contador animado para stats
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                if (!isNaN(stat.textContent)) {
                    const finalNumber = parseInt(stat.textContent);
                    let currentNumber = 0;
                    const increment = finalNumber / 20;
                    const timer = setInterval(() => {
                        currentNumber += increment;
                        stat.textContent = Math.floor(currentNumber);
                        if (currentNumber >= finalNumber) {
                            stat.textContent = finalNumber;
                            clearInterval(timer);
                        }
                    }, 100);
                }
            });
        });
    </script>
</body>
</html>