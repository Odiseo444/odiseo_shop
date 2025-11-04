<?php session_start();
$id = $_SESSION['id'] ?? '';
include_once 'inc\database.php';
if (!($id == '')) {
  $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
  $doConsult = mysqli_query($conexion, $consult);
  $user = mysqli_fetch_array($doConsult);
}
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto y Soporte || Odiseo Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
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
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #000 0%, #333 100%);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-left a {
            color: white;
            text-decoration: none;
        }

        .logo {
            font-family: 'Anton', sans-serif;
            font-size: 1.8rem;
            color: white;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #ffc107;
        }

        /* Hero section */
        .contact-hero {
            background: linear-gradient(135deg, #000 0%, #333 100%);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 193, 7, 0.1) 0%, transparent 70%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .contact-hero p {
            font-size: 1.3rem;
            opacity: 0.9;
        }

        /* Main container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        /* Quick contact cards */
        .quick-contact {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .contact-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .contact-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, #000 0%, #333 100%);
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .contact-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .contact-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 1rem;
        }

        .contact-info {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .contact-link {
            color: #000;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-link:hover {
            color: #ffc107;
        }

        .contact-hours {
            font-size: 0.9rem;
            color: #999;
            margin-top: 1rem;
        }

        /* Main content grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 4rem;
        }

        /* Form section */
        .form-section {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 1.5rem;
            position: relative;
            padding-left: 20px;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 35px;
            background: linear-gradient(135deg, #000 0%, #333 100%);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.7rem;
            font-size: 0.95rem;
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
            background: white;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 150px;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #000 0%, #333 100%);
            color: white;
            border: none;
            padding: 18px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* FAQ section */
        .faq-section {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .faq-item {
            margin-bottom: 1.5rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            border-color: #000;
        }

        .faq-question {
            width: 100%;
            background: #f8f9fa;
            border: none;
            padding: 1.5rem;
            text-align: left;
            font-weight: 600;
            font-size: 1.05rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: #e9ecef;
        }

        .faq-question.active {
            background: #000;
            color: white;
        }

        .faq-icon {
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .faq-question.active .faq-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding: 0 1.5rem;
            color: #666;
            line-height: 1.8;
        }

        .faq-answer.active {
            max-height: 500px;
            padding: 1.5rem;
        }

        /* Map section */
        .map-section {
            grid-column: 1 / -1;
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .map-container {
            width: 100%;
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #999;
            margin-top: 2rem;
        }

        /* Social section */
        .social-section {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 4rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .social-btn {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            background: white;
        }

        .social-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .social-btn.facebook {
            color: #3b5998;
        }

        .social-btn.facebook:hover {
            background: #3b5998;
            color: white;
            border-color: #3b5998;
        }

        .social-btn.instagram {
            color: #E4405F;
        }

        .social-btn.instagram:hover {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: white;
            border-color: #E4405F;
        }

        .social-btn.twitter {
            color: #1DA1F2;
        }

        .social-btn.twitter:hover {
            background: #1DA1F2;
            color: white;
            border-color: #1DA1F2;
        }

        .social-btn.whatsapp {
            color: #25D366;
        }

        .social-btn.whatsapp:hover {
            background: #25D366;
            color: white;
            border-color: #25D366;
        }

        /* Live chat button */
        .chat-widget {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
        }

        .chat-button {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            box-shadow: 0 5px 25px rgba(40, 167, 69, 0.4);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        .chat-button:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 30px rgba(40, 167, 69, 0.6);
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 5px 25px rgba(40, 167, 69, 0.4);
            }

            50% {
                box-shadow: 0 5px 35px rgba(40, 167, 69, 0.7);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .contact-hero h1 {
                font-size: 2rem;
            }

            .contact-hero p {
                font-size: 1.1rem;
            }

            .main-container {
                padding: 2rem 1rem;
            }

            .content-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .form-section,
            .faq-section {
                padding: 2rem;
            }

            .social-links {
                flex-wrap: wrap;
            }

            .chat-widget {
                bottom: 20px;
                right: 20px;
            }

            .chat-button {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.8s ease;
        }
    </style>
</head>

<body> <!-- Navbar -->
    <header class="navbar">
        <div class="header-left"> <a href="Account/account.php"><span class="material-symbols-outlined">account_circle</span></a>
            <div class="logo">ODISEO SHOP</div>
        </div>
<nav class="nav-links">
      <a href="index.php">Inicio</a>
      <a href="shop.php">Tienda</a>
      <a href="nosotros.php">Nosotros</a>
      <a href="#">Contacto</a>
      <a href="Cart/cart.php">Carrito</a>
      <?php if (isset($user)) if ($user['rol'] === '0') {
          echo '<a href="Panel/panel.php">Panel de productos</a>';
        } ?>
    </nav>
    </header> <!-- Hero -->
    <section class="contact-hero">
        <div class="hero-content">
            <h1>¿Necesitas Ayuda?</h1>
            <p>Estamos aquí para asistirte. Contáctanos y resolveremos tus dudas</p>
        </div>
    </section>
    <div class="main-container"> <!-- Quick Contact Cards -->
        <section class="quick-contact fade-in">
            <div class="contact-card"> <span class="contact-icon">📞</span>
                <h3>Teléfono</h3>
                <p class="contact-info"> <a href="tel:+573001234567" class="contact-link">+57 300 123 4567</a> </p>
                <p class="contact-hours">Lun - Sáb: 9:00 AM - 7:00 PM</p>
            </div>
            <div class="contact-card"> <span class="contact-icon">📧</span>
                <h3>Email</h3>
                <p class="contact-info"> <a href="mailto:soporte@odiseoshop.com" class="contact-link">soporte@odiseoshop.com</a> </p>
                <p class="contact-hours">Respuesta en menos de 24 horas</p>
            </div>
            <div class="contact-card"> <span class="contact-icon">💬</span>
                <h3>WhatsApp</h3>
                <p class="contact-info"> <a href="https://wa.me/573001234567" class="contact-link" target="_blank">+57 300 123 4567</a> </p>
                <p class="contact-hours">Atención inmediata</p>
            </div>
            <div class="contact-card"> <span class="contact-icon">📍</span>
                <h3>Ubicación</h3>
                <p class="contact-info"> <span class="contact-link">Calle 123 #45-67<br>Cali, Valle del Cauca</span> </p>
                <p class="contact-hours">Showroom disponible</p>
            </div>
        </section> <!-- Main Content Grid -->
        <div class="content-grid"> <!-- Contact Form -->
            <section class="form-section fade-in">
                <h2 class="section-title">Envíanos un Mensaje</h2>
                <form id="contactForm">
                    <div class="form-group"> <label class="form-label">Nombre Completo *</label> <input type="text" class="form-control" name="name" required placeholder="Juan Pérez"> </div>
                    <div class="form-group"> <label class="form-label">Email *</label> <input type="email" class="form-control" name="email" required placeholder="ejemplo@email.com"> </div>
                    <div class="form-group"> <label class="form-label">Teléfono</label> <input type="tel" class="form-control" name="phone" placeholder="+57 300 123 4567"> </div>
                    <div class="form-group"> <label class="form-label">Asunto *</label> <select class="form-control form-select" name="subject" required>
                            <option value="">Selecciona un asunto</option>
                            <option value="pedido">Consulta sobre un pedido</option>
                            <option value="producto">Información de producto</option>
                            <option value="devolucion">Devolución o cambio</option>
                            <option value="tecnico">Soporte técnico</option>
                            <option value="otro">Otro</option>
                        </select> </div>
                    <div class="form-group"> <label class="form-label">Mensaje *</label> <textarea class="form-control" name="message" required placeholder="Escribe tu mensaje aquí..."></textarea> </div> <button type="submit" class="btn-submit">Enviar Mensaje</button>
                </form>
            </section> <!-- FAQ Section -->
            <section class="faq-section fade-in">
                <h2 class="section-title">Preguntas Frecuentes</h2>
                <div class="faq-item"> <button class="faq-question" onclick="toggleFaq(this)"> ¿Cuál es el tiempo de entrega? <span class="faq-icon">▼</span> </button>
                    <div class="faq-answer"> El tiempo de entrega estándar es de 3-5 días hábiles. Para envío express, la entrega es en 1-2 días hábiles. Los tiempos pueden variar según tu ubicación. </div>
                </div>
                <div class="faq-item"> <button class="faq-question" onclick="toggleFaq(this)"> ¿Cómo puedo rastrear mi pedido? <span class="faq-icon">▼</span> </button>
                    <div class="faq-answer"> Una vez que tu pedido sea enviado, recibirás un correo electrónico con el número de rastreo. Puedes usar este número en nuestra página de "Rastreo de Pedidos" o directamente en el sitio web de la empresa de mensajería. </div>
                </div>
                <div class="faq-item"> <button class="faq-question" onclick="toggleFaq(this)"> ¿Cuál es la política de devoluciones? <span class="faq-icon">▼</span> </button>
                    <div class="faq-answer"> Aceptamos devoluciones dentro de los 30 días posteriores a la recepción del producto. El artículo debe estar sin usar, con etiquetas originales y en su empaque original. El envío de devolución es gratuito. </div>
                </div>
                <div class="faq-item"> <button class="faq-question" onclick="toggleFaq(this)"> ¿Qué métodos de pago aceptan? <span class="faq-icon">▼</span> </button>
                    <div class="faq-answer"> Aceptamos tarjetas de crédito y débito (Visa, Mastercard, American Express), PSE, efectivo en puntos autorizados, y pagos contra entrega en ciudades seleccionadas. </div>
                </div>
                <div class="faq-item"> <button class="faq-question" onclick="toggleFaq(this)"> ¿Los productos son originales? <span class="faq-icon">▼</span> </button>
                    <div class="faq-answer"> Sí, todos nuestros productos son 100% originales. Trabajamos directamente con marcas reconocidas y garantizamos la autenticidad de cada artículo. Todos los productos incluyen certificado de autenticidad. </div>
                </div>
                <div class="faq-item"> <button class="faq-question" onclick="toggleFaq(this)"> ¿Puedo cambiar la talla de mi pedido? <span class="faq-icon">▼</span> </button>
                    <div class="faq-answer"> Sí, ofrecemos cambios de talla sin costo adicional. Contáctanos dentro de las primeras 24 horas después de recibir tu pedido para iniciar el proceso de cambio. </div>
                </div>
            </section> <!-- Map Section -->
            <section class="map-section fade-in">
                <h2 class="section-title">Nuestra Ubicación</h2>
                <p style="color: #666; margin-bottom: 1rem;"> Visítanos en nuestro showroom en Cali. Aquí podrás ver y probar nuestros productos antes de comprar. </p>
                <div class="map-container"> 🗺️ <!-- Aquí iría un iframe de Google Maps --> <!-- <iframe src="..." width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe> --> </div>
            </section>
        </div> <!-- Social Media Section -->
        <section class="social-section fade-in">
            <h2 class="section-title" style="text-align: center; padding-left: 0;">Síguenos en Redes Sociales</h2>
            <p style="color: #666; font-size: 1.1rem; margin-bottom: 2rem;"> Mantente al día con nuestras últimas colecciones, ofertas exclusivas y tendencias </p>
            <div class="social-links"> <a href="#" class="social-btn facebook" title="Facebook">f</a> <a href="#" class="social-btn instagram" title="Instagram">📷</a> <a href="#" class="social-btn twitter" title="Twitter">🐦</a> <a href="https://wa.me/573001234567" class="social-btn whatsapp" target="_blank" title="WhatsApp">💬</a> </div>
        </section>
    </div> <!-- Live Chat Widget -->
    <div class="chat-widget"> <button class="chat-button" onclick="openChat()" title="Chat en vivo"> 💬 </button> </div>

    <script>
        // Toggle FAQ
        function toggleFaq(button) {
            const answer = button.nextElementSibling;
            const allQuestions = document.querySelectorAll('.faq-question');
            const allAnswers = document.querySelectorAll('.faq-answer');

            allQuestions.forEach(q => {
                if (q !== button) q.classList.remove('active');
            });
            allAnswers.forEach(a => {
                if (a !== answer) a.classList.remove('active');
            });

            button.classList.toggle('active');
            answer.classList.toggle('active');
        }

        // Form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            Swal.fire({
                title: 'Enviando mensaje...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => Swal.showLoading()
            });

            // Simulación de envío
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Mensaje Enviado!',
                    html: `
                        <p>Gracias <strong>${data.name}</strong>, hemos recibido tu mensaje.</p>
                        <p>Te responderemos a <strong>${data.email}</strong> en menos de 24 horas.</p>
                    `,
                    confirmButtonColor: '#000',
                    confirmButtonText: 'Entendido'
                }).then(() => this.reset());
            }, 2000);
        });

        // Chat en vivo
        function openChat() {
            Swal.fire({
                title: 'Chat en Vivo',
                html: `
                    <div style="text-align: left; padding: 1rem;">
                        <p style="margin-bottom: 1rem;">¡Hola! 👋 Soy el asistente virtual de Odiseo Shop.</p>
                        <p style="margin-bottom: 1rem;">¿En qué puedo ayudarte hoy?</p>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <button onclick="chatOption('pedido')" style="padding: 0.8rem; background: #f8f9fa; border: 2px solid #e9ecef; border-radius: 8px; cursor: pointer; font-weight: 600;">📦 Consultar mi pedido</button>
                            <button onclick="chatOption('producto')" style="padding: 0.8rem; background: #f8f9fa; border: 2px solid #e9ecef; border-radius: 8px; cursor: pointer; font-weight: 600;">👔 Información de producto</button>
                            <button onclick="chatOption('devolucion')" style="padding: 0.8rem; background: #f8f9fa; border: 2px solid #e9ecef; border-radius: 8px; cursor: pointer; font-weight: 600;">🔄 Devolución o cambio</button>
                            <button onclick="chatOption('whatsapp')" style="padding: 0.8rem; background: #25D366; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">💬 Chat por WhatsApp</button>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                showCloseButton: true,
                width: 400
            });
        }

        // Opciones del chat
        function chatOption(type) {
            switch (type) {
                case 'pedido':
                    Swal.fire({
                        title: 'Consulta de Pedido',
                        html: `
                            <p>Por favor ingresa tu número de pedido:</p>
                            <input type="text" id="pedido" class="swal2-input" placeholder="#12345">
                        `,
                        confirmButtonText: 'Consultar',
                        confirmButtonColor: '#000',
                        preConfirm: () => {
                            const id = document.getElementById('pedido').value.trim();
                            if (!id) return Swal.showValidationMessage('Por favor, ingresa tu número de pedido');
                            Swal.fire('Consulta enviada', `Tu pedido <strong>${id}</strong> está en proceso.`, 'info');
                        }
                    });
                    break;

                case 'producto':
                    Swal.fire({
                        icon: 'info',
                        title: 'Información de Producto',
                        text: 'Por favor revisa la sección de tienda para ver disponibilidad y detalles actualizados de los productos.',
                        confirmButtonColor: '#000'
                    });
                    break;

                case 'devolucion':
                    Swal.fire({
                        icon: 'question',
                        title: 'Devolución o Cambio',
                        html: `
                        <p>¿Deseas iniciar una solicitud de devolución o cambio?</p>
                        <a href="mailto:soporte@odiseoshop.com" style="color:#000;font-weight:600;">soporte@odiseoshop.com</a>
                    `,
                        confirmButtonColor: '#000',
                        confirmButtonText: 'Entendido'
                    });
                    break;

                case 'whatsapp':
                    window.open('https://wa.me/573001234567', '_blank');
                    break;
            }
        }
    </script>
</body>

</html>