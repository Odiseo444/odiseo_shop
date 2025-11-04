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
                        <?php
                        $sqlPedidos = "SELECT * FROM pedidos WHERE id_usuario = $id";
                        $resultPedidos = mysqli_query($conexion, $sqlPedidos);
                        $totalPedidos = mysqli_num_rows($resultPedidos);
                        ?>
                        <span class="stat-number"><?php echo $totalPedidos ?></span>
                        <span class="stat-label">Pedidos</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">★★★★★</span>
                        <span class="stat-label"><?php if ($user['rol'] == 0) { echo 'USUARIO VIP'; } else { echo 'USUARIO'; } ?></span>
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

    <style>
        /* Modal overlay */
        .modal-pedidos {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            padding: 20px;
        }

        .modal-pedidos.open {
            display: flex;
        }

        /* Modal box */
        .modal-content-pedidos {
            width: 100%;
            max-width: 900px;
            max-height: 85vh;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            padding: 22px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 12px;
            border: 1px solid #e9ecef;
        }

        /* Close button */
        .close-btn-pedidos {
            position: absolute;
            right: 26px;
            top: 26px;
            cursor: pointer;
            font-size: 22px;
            color: #666;
            background: transparent;
            border: none;
            line-height: 1;
            transition: color .15s ease;
        }
        .close-btn-pedidos:hover {
            color: #000;
        }

        /* Header */
        .modal-content-pedidos h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #111;
        }

        /* Scrollable list area */
        .pedidos-lista {
            overflow-y: auto;
            padding-right: 6px;
        }

        /* Individual pedido */
        .pedido-item {
            border: 1px solid #f1f3f5;
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 12px;
            box-shadow: 0 3px 8px rgba(12, 16, 20, 0.04);
        }
        .pedido-item h3 {
            margin: 0 0 6px 0;
            font-size: 16px;
            color: #0b5ed7;
        }
        .pedido-item p {
            margin: 4px 0;
            color: #444;
            font-size: 14px;
        }
        .pedido-item ul {
            margin: 8px 0 0 18px;
            padding: 0;
            color: #333;
        }
        .pedido-item li {
            margin-bottom: 6px;
            font-size: 14px;
        }

        /* Empty state */
        .pedidos-lista p {
            color: #6c757d;
            font-size: 15px;
            margin: 12px 0;
        }

        /* "Ver pedidos" floating button */
        .btn-ver-pedidos {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background: #0d6efd;
            color: #fff;
            border: none;
            padding: 12px 16px;
            border-radius: 999px;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(13,110,253,0.18);
            font-weight: 600;
            z-index: 9998;
            transition: transform .12s ease, box-shadow .12s ease;
        }
        .btn-ver-pedidos:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 26px rgba(13,110,253,0.22);
        }

        /* Responsive adjustments */
        @media (max-width: 520px) {
            .modal-content-pedidos {
                padding: 16px;
                max-width: 95%;
            }
            .close-btn-pedidos {
                right: 12px;
                top: 12px;
            }
        }
    </style>

    <button class="btn-ver-pedidos" aria-haspopup="dialog">Ver historial de pedidos</button>

    <div class="modal-pedidos" role="dialog" aria-modal="true" aria-label="Historial de pedidos">
        <div class="modal-content-pedidos">
            <button class="close-btn-pedidos" aria-label="Cerrar">&times;</button>
            <h2>Historial de Pedidos</h2>
            <div class="pedidos-lista">
                <?php
                $sqlPedidos = "SELECT * FROM pedidos WHERE id_usuario = $id ORDER BY fecha DESC";
                $resultPedidos = mysqli_query($conexion, $sqlPedidos);
                if (mysqli_num_rows($resultPedidos) == 0) {
                    echo "<p>No has realizado ningún pedido aún.</p>";
                } else {
                    $count = 0;
                    while ($pedido = mysqli_fetch_array($resultPedidos)) {
                        $count++;
                        $pedidoItems = json_decode($pedido['pedido'], true);
                        echo "<div class='pedido-item'>
                                <h3>Pedido #" . $count . "</h3>
                                <p><strong>Fecha:</strong> " . htmlspecialchars($pedido['fecha'], ENT_QUOTES, 'UTF-8') . "</p>
                                <p><strong>Fecha de entrega:</strong> " . htmlspecialchars($pedido['fecha_entrega'], ENT_QUOTES, 'UTF-8') . "</p>
                                <p><strong>Precio total:</strong> $" . number_format($pedido['precio_total'], 2) . "</p>
                                <h4 style='margin:8px 0 6px 0;'>Productos:</h4>
                                <ul>";
                        if (!is_array($pedidoItems)) {
                            $pedidoItems = [];
                        }
                        foreach ($pedidoItems as $item) {
                            $cantidad = isset($item['cantidad']) ? (int)$item['cantidad'] : 0;
                            $nombre = isset($item['nombre']) ? htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') : 'Producto';
                            $precioNum = isset($item['precio']) ? (float)$item['precio'] : 0;
                            echo "<li>" . $cantidad . " x " . $nombre . " - $" . number_format($precioNum, 2) . "</li>";
                        }
                        echo "</ul>
                              </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const btnOpen = document.querySelector('.btn-ver-pedidos');
            const modal = document.querySelector('.modal-pedidos');
            const btnClose = document.querySelector('.close-btn-pedidos');
            const modalContent = document.querySelector('.modal-content-pedidos');

            function openModal() {
                modal.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
            function closeModal() {
                modal.classList.remove('open');
                document.body.style.overflow = '';
            }

            if (btnOpen) btnOpen.addEventListener('click', openModal);
            if (btnClose) btnClose.addEventListener('click', closeModal);

            // Close when clicking outside content
            modal.addEventListener('click', (e) => {
                if (!modalContent.contains(e.target)) closeModal();
            });

            // Close with Esc
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('open')) closeModal();
            });
        })();
    </script>

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