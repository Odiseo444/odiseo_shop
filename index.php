<?php
$correo = $_GET['correo'] ?? '';
$clave = $_GET['clave'] ?? '';
include_once 'inc\database.php';
$sql = 'SELECT * FROM productos';
$hacerConsulta = mysqli_query($conexion, $sql);
$products = mysqli_fetch_array($hacerConsulta);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Odiseo Shop | Moda Masculina</title>
    <link href="css/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="css/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Odiseo Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="shop.php">Tienda</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Ofertas</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- CARRUSEL -->
<div id="carouselHero" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/1600x600/?men,fashion" class="d-block w-100" alt="Moda masculina">
      <div class="carousel-caption d-none d-md-block">
        <h2>Moda que define tu estilo</h2>
        <p>Descubre nuestra colección de temporada</p>
        <a href="#" class="btn btn-primary">Ver productos</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/1600x600/?menswear,clothing" class="d-block w-100" alt="Ropa elegante">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- PRODUCTOS DESTACADOS -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h3 class="mb-4">Productos Destacados</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      
      <?php 
      while ($products) {
        ?>
        <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
      <?php
      }
      ?>
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
<script>
    document.addEventListener( 'DOMContentLoaded', () => {

    if (!(<?php echo $clave  ?> === '' || <?php echo $correo ?> === '')) {
        localStorage.setItem('user', JSON.stringify({
            correo: <?php echo $correo; ?>,
            clave: <?php echo $clave; ?>
        }))
}
    }
    ) 
</script>
</html>

