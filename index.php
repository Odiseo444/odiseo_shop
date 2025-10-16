<?php session_start();
$id = $_SESSION['id'] ?? '';
include_once 'inc\database.php';
if (!($id == '')) {
  $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
  $doConsult = mysqli_query($conexion, $consult);
  $user = mysqli_fetch_array($doConsult);
}
$sql = 'SELECT * FROM productos';
$hacerConsulta = mysqli_query($conexion, $sql); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Odiseo Shop | Moda Masculina</title>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

  <header class="navbar">
    <div class="header-left">
      <a href="Account/account.php"><span class="material-symbols-outlined">account_circle</span></a>
      <div class="logo">ODISEO SHOP</div>
    </div>
    <nav class="nav-links">
      <a href="#">Inicio</a>
      <a href="shop.php">Tienda</a>
      <a href="nosotros.php">Nosotros</a>
      <a href="#">Contacto</a>
      <?php if (isset($user)) if ($user['rol'] === '0') {
          echo '<a href="Panel/panel.php">Panel de productos</a>';
        } ?>
    </nav>
  </header>

  <div class="main-container">
    <!-- Hero Banner -->
    <div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    <!-- PRODUCTOS DESTACADOS -->
    <section class="productos-section">
      <h3>Productos Destacados</h3>
      <div class="producto-container">
        <!-- Ejemplo de productos (reemplaza con tu código PHP) -->
        <?php 
        $count = 0;
        while ($products = mysqli_fetch_array($hacerConsulta)) { ?>
        <div class="col-md-4">
          <div class="product-card">
            <div class="product-content">
              <img src="data:image/jpeg;base64,<?php echo $products['imagen'] ?>" alt="<?php echo $products['nombre'] ?>" class="product-main-image">
              <div class="product-details">
                <div class="product-info">
                  <h3><?php echo $products['nombre'] ?></h3>
                  <p class="product-description"><?php echo $products['descripcion'] ?></p>
                  <p><strong>Marca:</strong> <?php echo $products['marca'] ?></p>
                </div>
                <div class="product-price">$<?php echo $products['precio'] ?></div>
                <div class="product-actions">
                  <button class="btn btn-success">Agregar al carrito</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php 
      $count += 1;
      if ($count == 3) {
        break;
      }
    } ?>
    </section>

    <!-- CTA -->
    <section class="cta-section">
      <h2>Suscríbete a nuestro boletín</h2>
      <p>Recibe ofertas exclusivas y las últimas tendencias</p>
      <form class="cta-form">
        <input type="email" placeholder="Tu correo electrónico" required>
        <button type="submit" class="cta-btn">Suscribirme</button>
      </form>
    </section>
  </div>

  <!-- FOOTER -->
  <footer class="footer">
    <p>&copy; 2025 Odiseo Shop. Todos los derechos reservados.</p>
    <div>
      <a href="#"<i class="bi bi-instagram"></i></a>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>