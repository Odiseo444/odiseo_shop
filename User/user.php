<?php
session_start();

if (isset($_SESSION['id'])) {
  header('location: ../Account/account.php');
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
if (isset($_GET['err'])) {
  $log = $_GET['err'];
  echo "<script>
  window.addEventListener('DOMContentLoaded', () => {
  Swal.fire({
title: '$log',
icon: 'error',
confirmButtonColor: '#3085d6',
confirmButtonText: 'Aceptar'
});
});
  </script>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Odiseo Shop | Login y Registro</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Reset y base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      color: #212529;
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Container principal */
    .auth-container {
      max-width: 500px;
      width: 90%;
      margin: 2rem auto;
      padding: 3rem 2.5rem;
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 50px rgba(0,0,0,0.15);
      border: 1px solid #e9ecef;
      position: relative;
      overflow: hidden;
    }

    .auth-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(135deg, #000 0%, #333 100%);
    }

    /* Header con logo */
    .auth-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .logo {
      font-family: 'Anton', sans-serif;
      font-size: 2.5rem;
      font-weight: 700;
      color: #000;
      letter-spacing: 1px;
      margin-bottom: 0.5rem;
    }

    .logo-subtitle {
      color: #666;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 2px;
      opacity: 0.8;
    }

    /* Botones de navegación */
    .nav-buttons {
      display: flex;
      gap: 0.5rem;
      margin-bottom: 3rem;
      background: #f8f9fa;
      border-radius: 12px;
      padding: 0.5rem;
      position: relative;
    }

    .nav-btn {
      flex: 1;
      padding: 12px 20px;
      border: none;
      background: transparent;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
      z-index: 2;
      color: #666;
    }

    .nav-btn.active {
      background: linear-gradient(135deg, #000 0%, #333 100%);
      color: white;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .nav-btn:not(.active):hover {
      background: rgba(0,0,0,0.05);
      color: #000;
    }

    /* Formularios */
    .form-section {
      animation: fadeIn 0.4s ease;
    }

    .form-section.hidden {
      display: none;
    }

    .section-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: #000;
      text-align: center;
      margin-bottom: 2rem;
      position: relative;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background: linear-gradient(135deg, #000 0%, #333 100%);
      border-radius: 2px;
    }

    /* Form groups */
    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      margin-bottom: 0.7rem;
      font-weight: 600;
      color: #333;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-control {
      width: 100%;
      padding: 15px 18px;
      border: 2px solid #e9ecef;
      border-radius: 10px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: #fff;
      color: #333;
    }

    .form-control:focus {
      outline: none;
      border-color: #000;
      box-shadow: 0 0 0 3px rgba(0,0,0,0.1);
      background: #fff;
    }

    .form-control::placeholder {
      color: #aaa;
    }

    /* Botones principales */
    .btn-primary-custom {
      background: linear-gradient(135deg, #000 0%, #333 100%);
      color: white;
      border: none;
      padding: 15px 30px;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
      width: 100%;
      margin-top: 1rem;
    }

    .btn-primary-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .btn-success-custom {
      background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
      color: white;
      border: none;
      padding: 15px 30px;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
      width: 100%;
      margin-top: 1rem;
    }

    .btn-success-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(40,167,69,0.3);
    }

    /* Enlaces */
    .forgot-password {
      display: block;
      text-align: center;
      margin-top: 2rem;
      color: #666;
      text-decoration: none;
      font-size: 0.9rem;
      transition: all 0.3s ease;
      padding: 10px;
      border-radius: 8px;
    }

    .forgot-password:hover {
      color: #000;
      background: rgba(0,0,0,0.05);
    }

    /* Input con icono */
    .input-group {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      font-size: 1.2rem;
      z-index: 3;
    }

    .form-control.with-icon {
      padding-left: 50px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .auth-container {
        margin: 1rem;
        padding: 2rem 1.5rem;
      }

      .logo {
        font-size: 2rem;
      }

      .section-title {
        font-size: 1.5rem;
      }

      .nav-btn {
        padding: 10px 15px;
        font-size: 0.9rem;
      }
    }

    /* Animaciones */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .form-group {
      animation: slideIn 0.4s ease forwards;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-group:nth-child(5) { animation-delay: 0.5s; }

    /* Efectos visuales adicionales */
    .auth-container:hover {
      box-shadow: 0 25px 60px rgba(0,0,0,0.2);
    }

    /* Loading state */
    .btn-loading {
      position: relative;
      color: transparent !important;
    }

    .btn-loading::after {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      top: 50%;
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      border: 2px solid transparent;
      border-top-color: #ffffff;
      border-radius: 50%;
      animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</head>

<body>
  <div class="auth-container">
    <!-- Header con logo -->
    <div class="auth-header">
      <div class="logo">ODISEO SHOP</div>
      <div class="logo-subtitle">Moda Masculina Premium</div>
    </div>

    <!-- Botones de navegación -->
    <div class="nav-buttons">
      <button id="showLogin" class="nav-btn active">Iniciar Sesión</button>
      <button id="showRegister" class="nav-btn">Registrarse</button>
    </div>

    <!-- Formulario de Login -->
    <div id="loginForm" class="form-section">
      <h2 class="section-title">Bienvenido de nuevo</h2>
      <form action="login.php" id="loginFormData" method="POST">
        <div class="form-group">
          <label for="loginEmail" class="form-label">Correo electrónico</label>
          <div class="input-group">
            <span class="input-icon">📧</span>
            <input type="email" class="form-control with-icon" name='correo' id="loginEmail" placeholder="tu@email.com" required>
          </div>
        </div>
        <div class="form-group">
          <label for="loginPassword" class="form-label">Contraseña</label>
          <div class="input-group">
            <span class="input-icon">🔒</span>
            <input type="password" class="form-control with-icon" name='clave' id="loginPassword" placeholder="••••••••" required>
          </div>
        </div>
        <button type="submit" class="btn-primary-custom">Iniciar Sesión</button>
        <a href="#" id="forgotPassword" class="forgot-password">¿Olvidaste tu contraseña?</a>
      </form>
    </div>

    <!-- Formulario de Registro -->
    <div id="registerForm" class="form-section hidden">
      <h2 class="section-title">Crear cuenta nueva</h2>
      <form action="register.php" id="registerFormData" method="POST">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstName" class="form-label">Nombre</label>
              <div class="input-group">
                <span class="input-icon">👤</span>
                <input type="text" name="nombre" class="form-control with-icon" id="firstName" placeholder="Juan" required>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lastName" class="form-label">Apellido</label>
              <div class="input-group">
                <span class="input-icon">👤</span>
                <input type="text" name="apellido" class="form-control with-icon" id="lastName" placeholder="Pérez" required>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="registerEmail" class="form-label">Correo electrónico</label>
          <div class="input-group">
            <span class="input-icon">📧</span>
            <input type="email" name="correo" class="form-control with-icon" id="registerEmail" placeholder="tu@email.com" required>
          </div>
        </div>
        <div class="form-group">
          <label for="registerPassword" class="form-label">Contraseña</label>
          <div class="input-group">
            <span class="input-icon">🔒</span>
            <input type="password" name="clave" class="form-control with-icon" id="registerPassword" placeholder="••••••••" required>
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="form-label">Teléfono</label>
          <div class="input-group">
            <span class="input-icon">📱</span>
            <input type="tel" name="celular" class="form-control with-icon" id="phone" placeholder="+57 300 123 4567">
          </div>
        </div>
        <button type="submit" class="btn-success-custom">Crear cuenta</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Alternancia entre formularios
    const loginBtn = document.getElementById('showLogin');
    const registerBtn = document.getElementById('showRegister');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    loginBtn.addEventListener('click', () => {
      loginBtn.classList.add('active');
      registerBtn.classList.remove('active');
      loginForm.classList.remove('hidden');
      registerForm.classList.add('hidden');
    });

    registerBtn.addEventListener('click', () => {
      registerBtn.classList.add('active');
      loginBtn.classList.remove('active');
      registerForm.classList.remove('hidden');
      loginForm.classList.add('hidden');
    });

    // Efecto de loading en botones
    document.getElementById('loginFormData').addEventListener('submit', function(e) {
      const btn = this.querySelector('button[type="submit"]');
      btn.classList.add('btn-loading');
      btn.disabled = true;
    });

    document.getElementById('registerFormData').addEventListener('submit', function(e) {
      const btn = this.querySelector('button[type="submit"]');
      btn.classList.add('btn-loading');
      btn.disabled = true;
    });

    // Forgot password
    document.getElementById('forgotPassword').addEventListener('click', function(e) {
      e.preventDefault();
      Swal.fire({
        icon: 'info',
        title: 'Recuperar contraseña',
        text: 'Esta funcionalidad estará disponible próximamente.',
        confirmButtonColor: '#000'
      });
    });

    // Validación visual en tiempo real
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
      input.addEventListener('blur', function() {
        if (this.value.trim() === '' && this.hasAttribute('required')) {
          this.style.borderColor = '#dc3545';
        } else {
          this.style.borderColor = '#28a745';
        }
      });

      input.addEventListener('focus', function() {
        this.style.borderColor = '#000';
      });
    });
  </script>
</body>
</html>