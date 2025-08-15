<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .auth-container {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <!-- Botones para alternar entre login y registro -->
            <div class="text-center mb-4">
                <button id="showLogin" class="btn btn-primary">Iniciar Sesión</button>
                <button id="showRegister" class="btn btn-outline-primary">Registrarse</button>
            </div>
            
            <!-- Formulario de Login -->
            <div id="loginForm">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>
                <form id="loginFormData">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="loginEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="loginPassword" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Recordarme</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    <div class="text-center mt-3">
                        <a href="#" id="forgotPassword">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>
            </div>
            
            <!-- Formulario de Registro -->
            <div id="registerForm" class="hidden">
                <h2 class="text-center mb-4">Registro de Usuario</h2>
                <form id="registerFormData">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="firstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="lastName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="registerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="registerPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="phone">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Acepto los términos y condiciones</label>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Registrarse</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript para funcionalidad -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const showLoginBtn = document.getElementById('showLogin');
            const showRegisterBtn = document.getElementById('showRegister');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginFormData = document.getElementById('loginFormData');
            const registerFormData = document.getElementById('registerFormData');
            
            // Mostrar formulario de login
            showLoginBtn.addEventListener('click', function() {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                showLoginBtn.classList.remove('btn-outline-primary');
                showLoginBtn.classList.add('btn-primary');
                showRegisterBtn.classList.remove('btn-primary');
                showRegisterBtn.classList.add('btn-outline-primary');
            });
            
            // Mostrar formulario de registro
            showRegisterBtn.addEventListener('click', function() {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                showLoginBtn.classList.remove('btn-primary');
                showLoginBtn.classList.add('btn-outline-primary');
                showRegisterBtn.classList.remove('btn-outline-primary');
                showRegisterBtn.classList.add('btn-primary');
            });
            
            // Manejar envío del formulario de login
            loginFormData.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = document.getElementById('loginEmail').value;
                const password = document.getElementById('loginPassword').value;
                
                // Aquí iría la lógica para validar el login
                console.log('Login attempt with:', email, password);
                alert('Inicio de sesión exitoso (simulado)');
            });
            
            // Manejar envío del formulario de registro
            registerFormData.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const firstName = document.getElementById('firstName').value;
                const lastName = document.getElementById('lastName').value;
                const email = document.getElementById('registerEmail').value;
                const password = document.getElementById('registerPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                const phone = document.getElementById('phone').value;
                
                // Validar que las contraseñas coincidan
                if (password !== confirmPassword) {
                    alert('Las contraseñas no coinciden');
                    return;
                }
                
                // Aquí iría la lógica para registrar el usuario
                console.log('Registering user:', {
                    firstName,
                    lastName,
                    email,
                    password,
                    phone
                });
                
                alert('Registro exitoso (simulado)\nNombre: ' + firstName + ' ' + lastName + 
                      '\nEmail: ' + email + '\nTeléfono: ' + phone);
                
                // Mostrar el formulario de login después del registro
                showLoginBtn.click();
            });
            
            // Mostrar formulario de login por defecto
            showLoginBtn.click();
        });
    </script>
</body>
</html>