<?php
session_start();
$id = $_SESSION['id'] ?? 'error';
include_once 'inc\database.php';
if (!($id == '')) {
  $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
  $doConsult = mysqli_query($conexion, $consult);
  $user = mysqli_fetch_array($doConsult);
}
$sql = 'SELECT cr.id_producto, p.nombre, p.id_categoria, ca.nombre AS categoria, p.precio, cr.cantidad, p.imagen FROM carrito cr JOIN productos p ON cr.id_producto = p.id_producto JOIN categorias ca ON p.id_categoria = ca.id_categoria WHERE cr.id_usuario = ' . intval($id);
$hacerConsulta = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu Carrito</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="css/shop.css">
</head>

<body>

  <!-- Header -->
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
  <a href="index.php" class="btn-volver">
    <span class="material-symbols-outlined">arrow_back</span> Volver
  </a>
  <!-- Carrito -->
  <main class="carrito-container">
    <!-- Productos -->
    <div class="carrito-items">
      <?php
      $precio = 0;
      if (mysqli_num_rows($hacerConsulta) == 0) {
        echo "<p>Tu carrito está vacío.</p>";
        echo "<script>console.log('$id')</script>";
      } else {
        while ($item = mysqli_fetch_array($hacerConsulta)) { ?>
          <div class="carrito-item">
            <img src="data:image/jpeg;base64,<?php echo $item['imagen'] ?>" alt="Producto">
            <div class="carrito-detalles">
              <h3><?php echo $item['nombre'] ?></h3>
              <p><?php echo $item['categoria'] ?></p>
            </div>
            <div class="carrito-controles">
              <div class="cantidad">
                <button>-</button>
                <input type="text" value="<?php echo $item['cantidad'] ?>" readonly>
                <button>+</button>
              </div>
              <div class="precio"><?php echo '$' . number_format($item['precio'], 0, ',', '.')  ?></div>
              <button class="btn-eliminar">Eliminar</button>
            </div>
          </div>
          <script>
            console.log("<?php echo $item['nombre'] ?>")
          </script>
      <?php
          $precio += $item['precio'] * $item['cantidad'];
        }
      } ?>
    </div>


    <!-- Resumen -->
    <div class="resumen">
      <div class="up">
      <h2>Resumen del Pedido</h2>
        <div class="resumen-item">
          <span>Subtotal</span>
          <span><?php echo '$' . number_format($precio, 0, ',', '.'); ?></span>
        </div>
        <div class="resumen-item">
          <span>IVA</span>
          <span>$<?php
                  $iva = $precio * 0.19;
                  echo number_format($iva, 0, ',', '.') ?></span>
        </div>
      </div>
      <div class="down">
        <div class="resumen-item resumen-total">
          <span>Total</span>
          <span>$<?php echo number_format($precio + $iva, 0, ',', '.') ?></span>
        </div>
        <button class="btn-pagar">Finalizar Compra</button>
      </div>
    </div>
  </main>

</body>

</html>