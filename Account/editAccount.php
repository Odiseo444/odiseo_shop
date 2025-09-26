<?php
session_start();
$id= $_GET['id'] ?? $_SESSION['id'];
if ($id == null) {
    header('location: ../user.php?warning=Inicia Sesión o registrate para ingresar');
}
if (isset($_GET['log'])) {
  $log = $_GET['log'];
  echo "<script>
  window.addEventListener('DOMContentLoaded', () => {
  Swal.fire({
title: '$log',
icon: 'warning',
confirmButtonColor: '#3085d6',
confirmButtonText: 'Aceptar'
});
});
  </script>";
}
include_once '../inc\database.php';
$sql = "SELECT * FROM usuarios WHERE id_usuario=$id";
$hacerConsulta = mysqli_query($conexion, $sql);
$user = mysqli_fetch_array($hacerConsulta);
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
        <div class="header-content">
            <button class="btn-volver" onclick="confirmCancel()">
                ⟵ Volver
            </button>
            <h1>Editar Perfil</h1>
            <div class="edit-badge">✏️ Modo Edición</div>
        </div>
    </header>

    <div class="perfil-contenedor">
        <div class="perfil-card">
            <div class="perfil-header">
                <div class="avatar-container">
                    <img src="../img/user.png" alt="Avatar del usuario" class="avatar">
                    <div class="avatar-overlay">📷</div>
                </div>
                <h2 class="nombre-usuario">Editar Perfil</h2>
                <p class="correo-usuario"><?php echo $user['nombre'] . " " . $user['apellido'] ?></p>
            </div>

            <div class="perfil-info">
                <h3>Actualizar Información</h3>
                <form action="editAcc.php" method="post" id="editForm">
                    <div class="form-grid">
                        <div class="form-group">
                            <div class="form-label">
                                <div class="form-icon">👤</div>
                                Nombre completo
                            </div>
                            <div class="form-input-container">
                                <input type="text" name="nombre" class="form-control" value="<?php echo $user['nombre']?>" placeholder="Nombre" required>
                                <input type="text" name="apellido" class="form-control" value="<?php echo $user['apellido'] ?>" placeholder="Apellido" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <div class="form-icon">📧</div>
                                Correo electrónico
                            </div>
                            <div class="form-input-container">
                                <input type="email" name="correo" class="form-control" value="<?php echo $user['correo'] ?>" placeholder="ejemplo@email.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <div class="form-icon">📱</div>
                                Teléfono
                            </div>
                            <div class="form-input-container">
                                <input type="tel" name="telefono" class="form-control" value="<?php echo $user['telefono'] ?>" placeholder="+57 300 123 4567">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <div class="form-icon">🏠</div>
                                Dirección de envío
                            </div>
                            <div class="form-input-container">
                                <?php 
                                if ($user['direccion_envio'] == 'null') {
                                    echo '<input type="text" name="direccion" class="form-control" value="" placeholder="Calle 123 #45-67, Ciudad, País">';
                                } else {
                                    echo '<input type="text" name="direccion" class="form-control" value="' . $user['direccion_envio'] . '" placeholder="Calle 123 #45-67, Ciudad, País">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="perfil-acciones">
                <input type="submit" form="editForm" class="btn-action btn-editar" value="💾 Guardar Cambios">
                <button class="btn-action btn-cancelar" onclick="confirmCancel()">❌ Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Indicador de cambios no guardados -->
    <div class="unsaved-changes" id="unsavedWarning">
        ⚠️ Tienes cambios sin guardar
    </div>

    <script>
        let hasChanges = false;
        const originalValues = {};

        // Guardar valores originales
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                originalValues[input.name] = input.value;
                
                // Detectar cambios
                input.addEventListener('input', function() {
                    checkForChanges();
                    validateInput(this);
                });

                // Validación al perder foco
                input.addEventListener('blur', function() {
                    validateInput(this);
                });
            });
        });

        function checkForChanges() {
            const inputs = document.querySelectorAll('.form-control');
            hasChanges = false;
            
            inputs.forEach(input => {
                if (input.value !== originalValues[input.name]) {
                    hasChanges = true;
                }
            });

            // Mostrar/ocultar indicador
            const warning = document.getElementById('unsavedWarning');
            if (hasChanges) {
                warning.classList.add('show');
            } else {
                warning.classList.remove('show');
            }
        }

        function validateInput(input) {
            // Remover clases anteriores
            input.classList.remove('valid', 'invalid');
            
            if (input.hasAttribute('required') && input.value.trim() === '') {
                input.classList.add('invalid');
                return false;
            }

            if (input.type === 'email' && input.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(input.value)) {
                    input.classList.add('invalid');
                    return false;
                }
            }

            if (input.type === 'tel' && input.value) {
                const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
                if (!phoneRegex.test(input.value.replace(/[\s\-\(\)]/g, ''))) {
                    input.classList.add('invalid');
                    return false;
                }
            }

            input.classList.add('valid');
            return true;
        }

        function confirmCancel() {
            if (hasChanges) {
                Swal.fire({
                    title: "¿Descartar cambios?",
                    text: "Tienes modificaciones sin guardar. ¿Estás seguro de que quieres salir?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#dc3545",
                    cancelButtonColor: "#6c757d",
                    cancelButtonText: "Seguir editando",
                    confirmButtonText: "Sí, descartar",
                    backdrop: true,
                    allowOutsideClick: false,
                    customClass: {
                        popup: 'swal-modern'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace('account.php');
                    }
                });
            } else {
                window.location.replace('account.php');
            }
        }

        // Validación del formulario antes del envío
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const inputs = document.querySelectorAll('.form-control');
            let isValid = true;

            inputs.forEach(input => {
                if (!validateInput(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    title: "Error de validación",
                    text: "Por favor, corrige los campos marcados en rojo.",
                    icon: "error",
                    confirmButtonColor: "#dc3545",
                    customClass: {
                        popup: 'swal-modern'
                    }
                });
                return;
            }

            // Mostrar loading
            const submitBtn = this.querySelector('input[type="submit"]');
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;

            // Mostrar confirmación
            Swal.fire({
                title: 'Guardando cambios...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });



        // Estilos personalizados para SweetAlert
        const style = document.createElement('style');
        style.textContent = `
            .swal-modern {
                border-radius: 20px !important;
                border: 2px solid #e9ecef !important;
            }
        `;
        document.head.appendChild(style);

        // Efecto en el avatar
        document.querySelector('.avatar-container').addEventListener('click', function() {
            Swal.fire({
                title: "Cambiar avatar",
                text: "Esta funcionalidad estará disponible próximamente.",
                icon: "info",
                confirmButtonColor: "#28a745",
                customClass: {
                    popup: 'swal-modern'
                }
            });
        });
    </script>
</body>
</html>
