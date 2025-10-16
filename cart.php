<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu Carrito</title>
  <link rel="stylesheet" href="estilos.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="css/shop.css">
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="header-content">
      <a href="index.php" class="btn-volver">
        <span class="material-symbols-outlined">arrow_back</span> Volver
      </a>
      <h1>Tu Carrito</h1>
      <span class="logo-mini">SHOP+</span>
    </div>
  </header>

  <!-- Carrito -->
  <main class="carrito-container">
    <!-- Productos -->
    <div class="carrito-items">

      <div class="carrito-item">
        <img src="https://via.placeholder.com/100" alt="Producto">
        <div class="carrito-detalles">
          <h3>Camiseta Negra Premium</h3>
          <p>Talla M</p>
        </div>
        <div class="carrito-controles">
          <div class="cantidad">
            <button>-</button>
            <input type="text" value="1">
            <button>+</button>
          </div>
          <div class="precio">$60.000</div>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>

      <div class="carrito-item">
        <img src="https://via.placeholder.com/100" alt="Producto">
        <div class="carrito-detalles">
          <h3>Pantalón Cargo</h3>
          <p>Talla 32</p>
        </div>
        <div class="carrito-controles">
          <div class="cantidad">
            <button>-</button>
            <input type="text" value="2">
            <button>+</button>
          </div>
          <div class="precio">$120.000</div>
          <button class="btn-eliminar">Eliminar</button>
        </div>
      </div>

    </div>

    <!-- Resumen -->
    <div class="resumen">
      <h2>Resumen del Pedido</h2>
      <div class="resumen-item">
        <span>Subtotal</span>
        <span>$180.000</span>
      </div>
      <div class="resumen-item">
        <span>Envío</span>
        <span>$10.000</span>
      </div>
      <div class="resumen-item resumen-total">
        <span>Total</span>
        <span>$190.000</span>
      </div>
      <button class="btn-pagar">Finalizar Compra</button>
    </div>
  </main>

</body>
</html>
