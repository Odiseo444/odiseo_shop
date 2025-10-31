wws<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestra Historia || Odiseo Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
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
            line-height: 1.8;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #000 0%, #333 100%);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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

        /* Hero principal */
        .hero-section {
            position: relative;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
            background: linear-gradient(135deg, #000 0%, #333 100%);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 2rem;
        }

        .hero-title {
            font-family: 'Anton', sans-serif;
            font-size: 4rem;
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
            animation: fadeInUp 1s ease;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            animation: fadeInUp 1.2s ease;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        /* Container principal */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        /* Sección de historia */
        .story-section {
            background: white;
            border-radius: 20px;
            padding: 4rem;
            margin-bottom: 4rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            position: relative;
        }

        .story-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, #000 0%, #333 100%);
            border-radius: 20px 20px 0 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 2rem;
            position: relative;
            padding-left: 25px;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 40px;
            background: linear-gradient(135deg, #000 0%, #333 100%);
        }

        .story-text {
            font-size: 1.1rem;
            color: #555;
            line-height: 2;
            margin-bottom: 1.5rem;
        }

        .story-text strong {
            color: #000;
            font-weight: 700;
        }

        /* Timeline */
        .timeline-section {
            margin-bottom: 4rem;
        }

        .timeline {
            position: relative;
            padding: 2rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #000 0%, #333 100%);
        }

        .timeline-item {
            display: flex;
            margin-bottom: 4rem;
            position: relative;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row;
        }

        .timeline-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            width: 45%;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            border: 2px solid #e9ecef;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-right: auto;
        }

        .timeline-item:nth-child(even) .timeline-content {
            margin-left: auto;
        }

        .timeline-year {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #000 0%, #333 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            z-index: 10;
        }

        .timeline-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 1rem;
        }

        .timeline-description {
            color: #666;
            line-height: 1.8;
        }

        /* Stats section */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .stat-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, #000 0%, #333 100%);
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: #000;
            margin-bottom: 0.5rem;
            font-family: 'Anton', sans-serif;
        }

        .stat-label {
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        /* Valores section */
        .values-section {
            background: white;
            border-radius: 20px;
            padding: 4rem;
            margin-bottom: 4rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .value-card {
            padding: 2rem;
            border-radius: 15px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .value-card:hover {
            transform: translateY(-5px);
            border-color: #000;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .value-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .value-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 1rem;
        }

        .value-description {
            color: #666;
            line-height: 1.8;
        }

        /* Team section */
        .team-section {
            margin-bottom: 4rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .team-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .team-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .team-info {
            padding: 2rem;
            text-align: center;
        }

        .team-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 0.5rem;
        }

        .team-role {
            color: #666;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .team-bio {
            color: #777;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* CTA final */
        .cta-section {
            background: linear-gradient(135deg, #000 0%, #333 100%);
            color: white;
            padding: 4rem 3rem;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,193,7,0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-text {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .cta-button {
            background: linear-gradient(135deg, #ffc107 0%, #ffb700 100%);
            color: #000;
            padding: 15px 40px;
            border-radius: 50px;
            border: none;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255,193,7,0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .main-container {
                padding: 2rem 1rem;
            }

            .story-section,
            .values-section {
                padding: 2rem;
            }

            .timeline::before {
                left: 30px;
            }

            .timeline-item {
                flex-direction: column !important;
                padding-left: 60px;
            }

            .timeline-content {
                width: 100% !important;
                margin: 0 !important;
            }

            .timeline-year {
                left: 30px;
                transform: translateX(-50%);
            }

            .section-title {
                font-size: 2rem;
            }
        }

        /* Animaciones */
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

        @keyframes bounce {
            0%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            50% {
                transform: translateX(-50%) translateY(-10px);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: rotate(0deg) scale(1);
            }
            50% {
                transform: rotate(180deg) scale(1.1);
            }
        }

        .fade-in {
            animation: fadeInUp 0.8s ease;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="header-left">
            <a href="Account/account.php"><span class="material-symbols-outlined">account_circle</span></a>
            <div class="logo">ODISEO SHOP</div>
        </div>
        <nav class="nav-links">
            <a href="index.php">Inicio</a>
      <a href="shop.php">Tienda</a>
      <a href="#">Nosotros</a>
      <a href="#">Contacto</a>
<a href="Cart/cart.php">Carrito</a>
      <?php if (isset($user)) if ($user['rol'] === '0') {
          echo '<a href="Panel/panel.php">Panel de productos</a>';
        } ?>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">NUESTRA HISTORIA</h1>
            <p class="hero-subtitle">Un viaje de pasión, estilo y compromiso con la moda</p>
        </div>
        <div class="scroll-indicator">
            <span style="font-size: 2rem; color: white;">↓</span>
        </div>
    </section>

    <div class="main-container">
        <!-- Historia -->
        <section class="story-section fade-in">
            <h2 class="section-title">¿Quiénes Somos?</h2>
            <p class="story-text">
                <strong>Odiseo Shop</strong> nació en 2020 con una visión clara: revolucionar la forma en que las personas experimentan la moda. Inspirados en el estilo overzice, entendemos que cada persona está en su propio viaje de autodescubrimiento y expresión personal.
            </p>
            <p class="story-text">
                Comenzamos como una pequeña tienda en línea con apenas 20 productos. Hoy, somos una referencia en moda masculina premium, atendiendo a miles de clientes en todo el país. Nuestra misión es simple pero poderosa: <strong>ofrecer estilo, calidad y confianza en cada prenda.</strong>
            </p>
            <p class="story-text">
                 Cada pieza en nuestro catálogo es cuidadosamente seleccionada por nuestro equipo de expertos en moda. Trabajamos directamente con diseñadores y fabricantes que comparten nuestros valores de sostenibilidad, calidad artesanal y diseño innovador.
            </p>
        </section>

        <!-- Estadísticas -->
        <section class="stats-section">
            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-number">4+</div>
                <div class="stat-label">Años de Experiencia</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👔</div>
                <div class="stat-number">500+</div>
                <div class="stat-label">Productos Únicos</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">😊</div>
                <div class="stat-number">10K+</div>
                <div class="stat-label">Clientes Felices</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-number">4.9</div>
                <div class="stat-label">Calificación Promedio</div>
            </div>
        </section>

        <!-- Timeline -->
        <section class="timeline-section">
            <h2 class="section-title">Nuestro Recorrido</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2020</div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">El Comienzo</h3>
                        <p class="timeline-description">
                            Fundamos Odiseo Shop con una inversión inicial modesta pero con grandes sueños. Nuestro primer mes vendimos 12 productos, pero cada cliente se convirtió en una pequeña parte de nuestra marca.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2021</div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Expansión Nacional</h3>
                        <p class="timeline-description">
                            Alcanzamos los 1,000 clientes y expandimos nuestro catálogo a más de 160 productos. Establecimos alianzas con marcas reconocidas y comenzamos a ofrecer envíos a todo el país.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2022</div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Reconocimiento</h3>
                        <p class="timeline-description">
                            Ganamos el premio "Mejor E-commerce de Moda Masculina" y abrimos nuestro primer showroom físico. Nuestro equipo creció a 20 personas apasionadas por la moda.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Línea Propia</h3>
                        <p class="timeline-description">
                            Lanzamos nuestra primera colección de diseño propio "Odiseo Classic", combinando elegancia atemporal con materiales sostenibles. Un éxito rotundo con más de 5,000 prendas vendidas.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2024</div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Presente</h3>
                        <p class="timeline-description">
                            Hoy somos líderes en moda masculina online, con más de 10,000 clientes satisfechos y un catálogo de 500+ productos premium. Nuestra visión: continuar creciendo sin perder nuestra esencia.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Valores -->
        <section class="values-section">
            <h2 class="section-title">Nuestros Valores</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">✨</div>
                    <h3 class="value-title">Calidad Premium</h3>
                    <p class="value-description">
                        Cada prenda pasa por rigurosos controles de calidad. Solo ofrecemos productos que nosotros mismos usaríamos con orgullo.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">🌱</div>
                    <h3 class="value-title">Sostenibilidad</h3>
                    <p class="value-description">
                        Comprometidos con el planeta, trabajamos con materiales eco-friendly y procesos de producción responsables.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3 class="value-title">Transparencia</h3>
                    <p class="value-description">
                        Creemos en la honestidad total con nuestros clientes. Precios justos, origen claro de cada producto, políticas transparentes.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">💡</div>
                    <h3 class="value-title">Innovación</h3>
                    <p class="value-description">
                        Constantemente buscamos nuevas tendencias, tecnologías y formas de mejorar la experiencia de compra de nuestros clientes.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">❤️</div>
                    <h3 class="value-title">Pasión</h3>
                    <p class="value-description">
                        La moda no es solo nuestro negocio, es nuestra pasión. Cada día trabajamos con entusiasmo para ofrecer lo mejor.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">🎯</div>
                    <h3 class="value-title">Excelencia</h3>
                    <p class="value-description">
                        Desde el servicio al cliente hasta el empaque, cada detalle importa. Buscamos la excelencia en todo lo que hacemos.
                    </p>
                </div>
            </div>
        </section>

        <!-- Equipo -->
        <section class="team-section">
            <h2 class="section-title">Nuestro Equipo</h2>
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-image">👨‍💼</div>
                    <div class="team-info">
                        <h3 class="team-name">Roosevelt steven</h3>
                        <p class="team-role">CEO & Fundador</p>
                        <p class="team-bio">
                            Visionario detrás de Odiseo Shop. Con 10 años de experiencia en moda masculina, transformó su pasión en un negocio exitoso.
                        </p>
                    </div>
                </div>

                <div class="team-card">
                    <div class="team-image">👨‍💼</div>
                    <div class="team-info">
                        <h3 class="team-name">Jose manuel</h3>
                        <p class="team-role">CEO & Director Creativo</p>
                        <p class="team-bio">
                            Experto en tendencias globales. jose selecciona personalmente cada pieza de nuestro catálogo con un ojo experto para el estilo.
                        </p>
                    </div>
                </div>

                <div class="team-card">
                    <div class="team-image">👨‍💻</div>
                    <div class="team-info">
                        <h3 class="team-name">Hector masa</h3>
                        <p class="team-role">Director de Operaciones</p>
                        <p class="team-bio">
                            Garantiza que cada pedido llegue a tiempo y en perfectas condiciones. Maestro de la logística y satisfacción del cliente.
                        </p>
                    </div>
                </div>

                <div class="team-card">
                    <div class="team-image">👩‍🎨</div>
                    <div class="team-info">
                        <h3 class="team-name">yeimar garcia</h3>
                        <p class="team-role">Marketing</p>
                        <p class="team-bio">
                            Conecta nuestra marca con miles de clientes. Creativo, estratégico y apasionado por contar historias que inspiran.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Final -->
        <section class="cta-section">
            <div class="cta-content">
                <h2 class="cta-title">¿Listo para tu propia odisea de estilo?</h2>
                <p class="cta-text">
                    Únete a miles de hombres que ya confían en Odiseo Shop para elevar su guardarropa
                </p>
                <button class="cta-button" onclick="window.location.href='shop.php'">
                    Explorar Colección
                </button>
            </div>
        </section>
    </div>

    <script>
        // Animación al scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 0.8s ease';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline-item, .stat-card, .value-card, .team-card').forEach(el => {
            observer.observe(el);
        });

        // Contador animado para estadísticas
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = end > 100 ? value.toLocaleString() + '+' : value + '+';
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Observar stats para animarlas
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    entry.target.classList.add('animated');
                    const number = entry.target.querySelector('.stat-number');
                    const text = number.textContent;
                    const finalValue = parseInt(text.replace(/\D/g, ''));
                    
                    if (text.includes('.')) {
                        // Para decimales como 4.9
                        let current = 0;
                        const increment = 4.9 / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= 4.9) {
                                number.textContent = '4.9';
                                clearInterval(timer);
                            } else {
                                number.textContent = current.toFixed(1);
                            }
                        }, 30);
                    } else {
                        // Para números enteros
                        animateValue(number, 0, finalValue, 2000);
                    }
                    statsObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-card').forEach(card => {
            statsObserver.observe(card);
        });

        // Smooth scroll al hacer click en el indicador
        document.querySelector('.scroll-indicator').addEventListener('click', () => {
            document.querySelector('.story-section').scrollIntoView({
                behavior: 'smooth'
            });
        });

        // Parallax effect en hero
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero-section');
            if (hero && scrolled < hero.offsetHeight) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Efecto hover en timeline items
        document.querySelectorAll('.timeline-content').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
                this.style.transition = 'transform 0.3s ease';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>