<?php
session_start();
$id = $_SESSION['id'] ?? 'error';
include_once '../inc\database.php';
if (!($id == '')) {
  $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
  $doConsult = mysqli_query($conexion, $consult);
  $user = mysqli_fetch_array($doConsult);
}
$sql = 'SELECT cr.id_producto, p.nombre, cr.cantidad, p.id_categoria, ca.nombre AS categoria, p.precio, cr.cantidad, p.imagen FROM carrito cr JOIN productos p ON cr.id_producto = p.id_producto JOIN categorias ca ON p.id_categoria = ca.id_categoria WHERE cr.id_usuario = ' . intval($id);
$hacerConsulta = mysqli_query($conexion, $sql);
$hacerConsulta2 = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu Carrito</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
<a href="Cart/cart.php">Carrito</a>
      <?php if (isset($user)) if ($user['rol'] === '0') {
        echo '<a href="../Panel/panel.php">Panel de productos</a>';
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
        <button class="btn-pagar" onclick="showModal('', 'buy')">Finalizar Compra</button>
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
  <div class="modal" id="buyModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Confirmar Compra</h3>
      </div>
      <p>¿Estás seguro de que deseas Comprar estos productos? se realizara un reembolso si los productos no legan en 20 dias habiles.</p>
      <ul class="list-group">
        <?php while ($item = mysqli_fetch_array($hacerConsulta2)) { ?>
  <li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?php echo $item['id_producto'] ?>">
    <?php echo $item['nombre']; ?>
    <span class="badge text-bg-primary rounded-pill"><?php echo $item['cantidad']; ?> </span>
  </li>
<?php } ?>  
</ul>
<br>
<div class="d-flex justify-content-between align-items-center mb-3">
                <div data-mdb-input-init class="form-outline">
                  <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                    placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                  <label class="form-label" for="typeText">Card Number</label>
                </div>
                <img src="https://img.icons8.com/color/48/000000/visa.png" alt="visa" width="64px" />
              </div>

              <div class="d-flex justify-content-between align-items-center mb-4">
                <div data-mdb-input-init class="form-outline">
                  <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                    placeholder="Cardholder's Name" />
                  <label class="form-label" for="typeName">Cardholder's Name</label>
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center pb-2">
                <div data-mdb-input-init class="form-outline">
                  <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY"
                    size="7" id="exp" minlength="7" maxlength="7" />
                  <label class="form-label" for="typeExp">Expiration</label>
                </div>
                <div data-mdb-input-init class="form-outline">
                  <input type="password" id="typeText2" class="form-control form-control-lg"
                    placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                  <label class="form-label" for="typeText2">Cvv</label>
                </div>
              </div>
      <div class="modal-actions">
        <button class="btn btn-danger" onclick="showModal()">Cancelar</button>  
        <button type="submit" class="btn btn-success" name="buyProduct" id="buy" onclick="buyProducts()">Comprar</button>
      </div>
    </div>
  </div>
</body>

<script>
  const deleteModal = document.getElementById('deleteModal');
  const buyModal = document.getElementById('buyModal');
  const eliminatedProduct = document.getElementById('delete');
  const buyProduct = document.getElementById('buy');
  const carrito = document.querySelector('.carrito-items');

  // datos de la tarjeta
  const cardNumber = document.getElementById('typeText');
  const cardName = document.getElementById('typeName');
  const cardExp = document.getElementById('typeExp');
  const cardCvv = document.getElementById('typeText2');

  function showModal(id, acc) {
    if (acc === 'buy') {
      buyModal.classList.toggle('active');
      return;
    } else {
      deleteModal.classList.toggle('active');
    }
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
  function buyProducts() {
    if (cardNumber.value === '' || cardName.value === '' || cardExp.value === '' || cardCvv.value === '') {
      alert('Por favor, complete todos los campos de la tarjeta.');
      return;
    } else if (carrito.innerHTML.trim() === '' || carrito.innerHTML.includes('Tu carrito está vacío.')) {
      alert('Tu carrito está vacío.');
      return;
    } else {
      fetch("buyProducts.php")
      .then(res => res.json())
      .then(data => {
        window.location = 'cart.php?msg=Pedido hecho con exito';
        console.log(data);
      })
      .catch(err => console.error(err));
    }
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
    const p = document.querySelector('.list-group-item[data-id="' + id + '"] span');
    if (acc === 'resta') {
        input.value = parseInt(input.value) - 1;
        console.log(input.value);
        if (input.value == 0) {
          showModal(id);
        }
    } else if (acc === 'suma ') {
      input.value = parseInt(input.value) + 1;
      if (input.value > 99) {
        input.value = 99;
      }
    }
    fetch("editCart.php?id=" + id + "&&cant=" + input.value)
      .then(res => res.json())
      .then(data => {
       console.log(data);
       if (data.message == 'cantidad reducida') {
         document.getElementById('subt').textContent = '$' + formatterSinDecimales.format(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) - data.price).replace('COP', '').trim();
         console.log(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) - data.price);
         document.getElementById('iva').textContent = '$' + formatterSinDecimales.format((parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')))*0.19).replace('COP', '').trim();
         document.getElementById('total').textContent = '$' + formatterSinDecimales.format(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) + (parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')))*0.19).replace('COP', '').trim();
         p.textContent = input.value;
         console.log('cantidad: ' + p.textContent);
        } else if (data.message == 'cantidad aumentada') {
          document.getElementById('subt').textContent = '$' + formatterSinDecimales.format(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) + data.price).replace('COP', '').trim();
          console.log(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) + data.price);
          document.getElementById('iva').textContent = '$' + formatterSinDecimales.format((parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')))*0.19).replace('COP', '').trim();
          document.getElementById('total').textContent = '$' + formatterSinDecimales.format(parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')) + (parseInt(document.getElementById('subt').textContent.replace('$', '').replace(/\./g, '')))*0.19).replace('COP', '').trim();
          p.textContent = input.value;
       }
      })
      .catch(err => console.error(err));
  }
</script>

</html>