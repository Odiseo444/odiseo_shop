<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Odiseo Shop | RopaHombre</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Odioseo Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.html">Inicio</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Tienda</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Ofertas</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HEADER -->
<header class="bg-light py-5 text-center">
  <div class="container">
    <h1 class="display-5 fw-bold">Nuestra Tienda</h1>
    <p class="lead">Explora nuestra variedad de camisetas</p>
  </div>
</header>

<!-- PRODUCTOS -->
<section class="py-5">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
      
      <!-- Producto 1 -->
      <div class="col">
        <div class="card h-100">
          <img src="https://source.unsplash.com/400x400/?mens,tshirt" class="card-img-top" alt="Producto">
          <div class="card-body">
            <h5 class="card-title">Camiseta Básica</h5>
            <p class="card-text">$20.00</p>
            <a href="#" class="btn btn-dark w-100">Añadir al carrito</a>
          </div>
        </div>
      </div>

      <!-- Producto 2 -->
      <div class="col">
        <div class="card h-100">
          <img src="https://source.unsplash.com/400x400/?jacket,man" class="card-img-top" alt="Producto">
          <div class="card-body">
            <h5 class="card-title">Camisa overzise</h5>
            <p class="card-text">$89.00</p>
            <a href="#" class="btn btn-dark w-100">Añadir al carrito</a>
          </div>
        </div>
      </div>

      <!-- Producto 3 -->
      <div class="col">
        <div class="card h-100">
          <img src="https://source.unsplash.com/400x400/?pants,men" class="card-img-top" alt="Producto">
          <div class="card-body">
            <h5 class="card-title">Camisa overzise</h5>
            <p class="card-text">$55.00</p>
            <a href="#" class="btn btn-dark w-100">Añadir al carrito</a>
          </div>
        </div>
      </div>

      <!-- Producto 4 -->
      <div class="col">
        <div class="card h-100">
          <img src="https://source.unsplash.com/400x400/?suit,men" class="card-img-top" alt="Producto">
          <div class="card-body">
            <h5 class="card-title">Camisa overzise</h5>
            <p class="card-text">$140.00</p>
            <a href="#" class="btn btn-dark w-100">Añadir al carrito</a>
          </div>
        </div>
      </div>

      <!-- Puedes copiar y pegar más productos con el mismo formato -->

    </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
