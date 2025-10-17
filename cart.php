<?php
$id = $_SESSION['id'] ?? '';
include_once 'inc\database.php';
if (!($id == '')) {
  $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
  $doConsult = mysqli_query($conexion, $consult);
  $user = mysqli_fetch_array($doConsult);
}
$sql = 'SELECT cr.id_producto, p.nombre, p.precio, cr.cantidad, p.imagen FROM carrito cr JOIN productos p ON cr.id_producto = p.id_producto WHERE cr.id_usuario = ' . intval($id);
$hacerConsulta = mysqli_query($conexion, $sql);
?>
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
      <?php while ($item = mysqli_fetch_array($hacerConsulta)) { ?>
      <div class="carrito-item">
        <img src="data:image/jpg;base,<?php echo $item['imagen'] ?>" alt="Producto">
        <div class="carrito-detalles">
          <h3><?php $item['nombre'] ?></h3>
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
      <?php } ?>
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
