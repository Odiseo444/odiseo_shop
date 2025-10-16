<?php
session_start();
$id = $_SESSION['id'] ?? '';
include_once 'inc/database.php';

// Obtener datos del usuario si hay sesión activa
if (!empty($id)) {
    $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
    $doConsult = mysqli_query($conexion, $consult);
    $user = mysqli_fetch_array($doConsult);
}

// Obtener el ID del producto desde la URL
$idProducto = $_GET["idPro"] ?? '';

if (empty($idProducto)) {
    die("No se ha especificado un producto.");
}

// Consulta corregida
$sql = "SELECT 
    p.id_producto,
    p.nombre AS nombre,
    p.descripcion,
    p.precio,
    p.stock,
    p.imagen,
    p.imagenes,
    p.marca,
    c.nombre AS categoria,
    s.nombre AS subcategoria,
    p.fecha_creacion,
    p.ultima_actualizacion
FROM productos p
INNER JOIN categorias c ON p.id_categoria = c.id_categoria
INNER JOIN subcategorias s ON p.id_subcategoria = s.id_subcategoria
WHERE p.id_producto = '$idProducto'";

$hacerConsulta = mysqli_query($conexion, $sql);

if (!$hacerConsulta || mysqli_num_rows($hacerConsulta) == 0) {
    die("Producto no encontrado.");
}

$producto = mysqli_fetch_array($hacerConsulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre']; ?> || Odiseo Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="css/product.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="header-left">
            <a href="#"><span class="material-symbols-outlined">account_circle</span></a>
            <div class="logo">ODISEO SHOP</div>
        </div>
        <nav class="nav-links">
            <a href="index.php">Inicio</a>
            <a href="shop.php">Tienda</a>
            <a href="about.php">Nosotros</a>
            <a href="#">Contacto</a>
        </nav>
    </header>

    <div class="main-container">
        <!-- Producto principal -->
        <div class="product-container">
            <!-- Galería -->
            <div class="product-gallery">
                <div class="main-image-container">
                    <img src="data:image/jpeg;base64,<?php echo $producto['imagen']; ?>" 
                         alt="<?php echo $producto['nombre']; ?>">
                    <div class="product-badges">
                        <span class="badge badge-new">Nuevo</span>
                        <span class="badge badge-sale">-20%</span>
                    </div>
                    <button class="wishlist-btn" onclick="toggleWishlist(this)">♡</button>
                </div>

                <div class="thumbnail-container">
                    <?php
                    // Mostrar imágenes adicionales si existen
                    $imagenesExtra = explode(',', $producto['imagenes']);
                    foreach ($imagenesExtra as $i => $img) {
                        $img = trim($img);
                        if (!empty($img)) {
                            echo "<div class='thumbnail' onclick=\"changeImage(this, 'data:image/jpeg;base64,$img')\">
                                    <img src='data:image/jpeg;base64,$img' alt='Vista " . ($i+1) . "'>
                                  </div>";
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Información del producto -->
            <div class="product-info">
                <h1><?php echo $producto['nombre']; ?></h1>
                <p class="price">$<?php echo number_format($producto['precio'], 2); ?></p>
                <p class="stock">Stock disponible: <?php echo $producto['stock']; ?></p>
                <p class="description"><?php echo $producto['descripcion']; ?></p>
                <p class="category">Categoría: <?php echo $producto['categoria']; ?> / <?php echo $producto['subcategoria']; ?></p>

                <!-- Botón de añadir al carrito -->
                <form method="post" action="producto.php?idPro=<?php echo $idProducto; ?>">
                    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                    <input type="number" name="cantidad" value="1" min="1" max="<?php echo $producto['stock']; ?>">
                    <button type="submit" name="add_cart" class="add-cart-btn">Agregar al carrito</button>
                </form>
            </div>
        </div>
    </div>

<?php
// --- Agregar al carrito (usa sesión) ---
if (isset($_POST['add_cart'])) {
    $idP = $_POST['id_producto'];
    $cantidad = max(1, intval($_POST['cantidad']));

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Si ya existe en el carrito, aumentar cantidad
    if (isset($_SESSION['carrito'][$idP])) {
        $_SESSION['carrito'][$idP]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$idP] = [
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'cantidad' => $cantidad,
            'imagen' => $producto['imagen']
        ];
    }

    echo "<script>
        Swal.fire({
            title: '¡Producto añadido!',
            text: 'El producto se ha añadido a tu carrito.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'producto.php?idPro=$idProducto';
        });
    </script>";
}
?>

    <script>
    // Cambiar imagen principal
    function changeImage(element, imageUrl) {
        document.querySelector('.main-image-container img').src = imageUrl;
        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        element.classList.add('active');
    }

    // Marcar favorito
    function toggleWishlist(btn) {
        btn.textContent = btn.textContent === '♡' ? '♥' : '♡';
    }
    </script>
</body>
</html>