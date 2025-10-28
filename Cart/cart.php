<?php
session_start();
$id = $_SESSION['id'] ?? 'error';
include_once '../inc\database.php';
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
  
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="../css/shop.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

  <!-- Header -->
  <header class="navbar">

    <div class="header-left">
      <a href="../Account/account.php"><span class="material-symbols-outlined">account_circle</span></a>
      <div class="logo">ODISEO SHOP</div>
    </div>
    <nav class="nav-links">
      <a href="../index.php">Inicio</a>
      <a href="../shop.php">Tienda</a>
      <a href="../nosotros.php">Nosotros</a>
      <a href="#">Contacto</a>
      <?php if (isset($user)) if ($user['rol'] === '0') {
        echo '<a href="Panel/panel.php">Panel de productos</a>';
      } ?>
    </nav>
  </header>
  <a href="../index.php" class="btn-volver">
    <span class="material-symbols-outlined">arrow_back</span> Volver
  </a>
  <!-- Carrito -->
  <main class="carrito-container">
    <!-- Productos -->
    <div class="carrito-items">
      <?php
      $precio = 0;
        if ($id == 'error') {
          echo "<script>
          window.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
              title: 'Debes iniciar sesión para ver tu carrito',
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Aceptar'
            }).then(() => {
              window.location.href = '../User/user.php';
            });
          });
          </script>";
        } elseif (mysqli_num_rows($hacerConsulta) == 0) {
        {
        echo "<p>Tu carrito está vacío.</p>";
        }
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
                <button onclick="editCart(<?php echo $item['id_producto'] ?>, 'resta')">-</button>
                <input type="num" oninput="editCart(<?php echo $item['id_producto'] ?>, '')" data-id='<?php echo $item['id_producto'] ?>' value="<?php echo $item['cantidad'] ?>">
                <button onclick="editCart(<?php echo $item['id_producto'] ?>, 'suma ')">+</button>
              </div>
              <div class="precio"><?php echo '$' . number_format($item['precio'], 0, ',', '.')  ?></div>
              <button class="btn-eliminar" onclick="showModal(<?php echo $item['id_producto'] ?>)">Eliminar</button>
            </div>
          </div>
          <script>
            console.log("<?php echo $item['id_producto'] ?>")
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
          <span id="subt"><?php echo '$' . number_format($precio, 0, ',', '.'); ?></span>
        </div>
        <div class="resumen-item">
          <span>IVA</span>
          <span id="iva">$<?php
                  $iva = $precio * 0.19;
                  echo number_format($iva, 0, ',', '.') ?></span>
        </div>
      </div>
      <div class="down">
        <div class="resumen-item resumen-total">
          <span>Total</span>
          <span id="total">$<?php echo number_format($precio + $iva, 0, ',', '.') ?></span>
        </div>
        <button class="btn-pagar">Finalizar Compra</button>
      </div>
    </div>
  </main>

  <div class="modal " id="deleteModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Confirmar Eliminación</h3>
      </div>
      <p>¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.</p>
      <div class="modal-actions">
        <input type="hidden" name="productId" value="">
        <button type="submit" class="btn btn-danger" name="deleteProduct" id="delete">Eliminar</button>
        <button class="btn btn-primary" onclick="showModal()">Cancelar</button>
      </div>
    </div>
  </div>
</body>

<script>
  const deleteModal = document.getElementById('deleteModal');
  const eliminatedProduct = document.getElementById('delete');

  function showModal(id) {
    deleteModal.classList.toggle('active');
    if (id) {
      eliminatedProduct.setAttribute('onclick', ' deleteProduct(' + id + ')');
    } else {
      window.location = 'cart.php';
    }
  }

  function deleteProduct(id) {

    fetch("eliminatedProductCart.php?id=" + id)
      .then(res => res.json())
      .then(data => {
        window.location = 'cart.php'
      })
      .catch(err => console.error(err));
  }

  function editCart(id, acc) {
    const formatterSinDecimales = new Intl.NumberFormat('es-ES', {
  style: 'currency',
  currency: 'COP',
  minimumFractionDigits: 0,
  maximumFractionDigits: 0,
});
console.log(formatterSinDecimales.format(1500));
    const input = document.querySelector(`input[data-id="${id}"]`);
    if (acc === 'resta') {
        input.value = parseInt(input.value) - 1;
        console.log(input.value);
        if (input.value == 0) {
          showModal(id);
        }
    } else if (acc === 'suma ') {
      input.value = parseInt(input.value) + 1;
    }
    fetch("editCart.php?id=" + id + "&&cant=" + input.value)
      .then(res => res.json())
      .then(data => {
       console.log(data);
       if (data.message == 'cantidad reducida') {
         document.getElementById('subt').textContent = '$' + formatterSinDecimales.format(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) - data.price).replace('COP', '').trim();
         console.log(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) - data.price);
       } else if (data.message == 'cantidad aumentada') {
         document.getElementById('subt').textContent = '$' + formatterSinDecimales.format(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) + data.price).replace('COP', '').trim();
         console.log(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) + data.price);
       }
      })
      .catch(err => console.error(err));
  }
</script>

</html>