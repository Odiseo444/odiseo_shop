<?php
session_start();

$id = $_SESSION['id'] ?? '';
include_once 'inc\database.php';
if (!($id == '')) {
  $consult = 'SELECT * FROM usuarios WHERE id_usuario="$id"';
  $doConsult = mysqli_query($conexion, $consult);
}
$sql = 'SELECT * FROM productos';
$hacerConsulta = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Odiseo Shop | Moda Masculina</title>
    <link href="css/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="css\style.css">
    <script src="css/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&amp;display=swap">
  </head>
  <body>

<header class="navbar">
  <div class="header-left">
    <a href="account.php?id=<?php echo $id ?>"><span class="material-symbols-outlined">account_circle</span></a>
    <div class="logo">ODISEO SHOP</div>
  </div>
    <nav class="nav-links">
      <a href="#">Inicio</a>
      <a href="#">Tienda</a>
      <a href="#">Ofertas</a>
      <a href="#">Contacto</a>
    </nav>
  </header>

  <!-- Hero Banner -->
    <div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img\plantilla-banner-moda-urbana_23-2148652497.jpg" class="d-block w-100" alt="...">
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

<!-- CARRUSEL -->

<!-- PRODUCTOS DESTACADOS -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h3 class="mb-4">Productos Destacados</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      
      <div class="producto-container">
      <?php 
      while ($products = mysqli_fetch_array($hacerConsulta)) {
        ?>
        <div class="producto-card">
        <img src="data:image/jpeg;base64,<?php echo $products['imagenes'] ?>" alt="Nombre del Producto" class="producto-imagen">
        <div class="producto-detalles">
            <h2 class="producto-nombre"><?php echo $products['nombre'] ?></h2>
            <p class="producto-descripcion"><?php echo $products['descripcion'] ?></p>
            <p class="producto-marca">Marca: <strong><?php echo $products['marca'] ?></strong></p>
            <p class="producto-precio"><?php echo $products['precio'] ?></p>
            <button class="btn-agregar">Agregar al carrito</button>
          </div>
          </div>
          <?php
      }
      ?>
      </div>
      </div>
      </div>
</section>

<!-- CTA -->
<section class="py-5 text-white text-center" style="background-color: #333;">
  <div class="container">
    <h2>Suscríbete a nuestro boletín</h2>
    <p class="mb-4">Recibe ofertas exclusivas y las últimas tendencias</p>
    <form class="row justify-content-center">
      <div class="col-md-4">
        <input type="email" class="form-control" placeholder="Tu correo electrónico">
      </div>
      <div class="col-auto">
        <button class="btn btn-primary">Suscribirme</button>
      </div>
    </form>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white py-4">
  <div class="container text-center">
    <p>&copy; 2025 RopaHombre. Todos los derechos reservados.</p>
    <div>
      <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
    </div>
  </div>
</footer>
</body>
</html>

