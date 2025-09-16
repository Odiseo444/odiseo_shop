<?php
session_start();

$id = $_SESSION['id'];
if (!($id == '')) {
    include_once 'inc\database.php';
    $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
    $doConsult = mysqli_query($conexion, $consult);
    $user = mysqli_fetch_array($doConsult);
    } else {
    header('location:index.php');

    if ($user['rol'] === '1') {
        header('location:index.php');
    }

}
$sql = 'SELECT 
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
INNER JOIN subcategorias s ON p.id_subcategoria = s.id_subcategoria;';
$hacerConsulta = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Odiseo Shop</title>
    <link rel="stylesheet" href="css/panel.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Panel de Administración</h1>
            <p>Gestiona los productos de tu tienda online de forma sencilla y eficiente</p>
        </div>

        <!-- Statistics -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number">0</div>
                <div class="stat-label">Productos Totales</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">0</div>
                <div class="stat-label">Stock Bajo</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">$0</div>
                <div class="stat-label">Precio Promedio</div>
            </div>
        </div>

        <!-- Controls -->
        <div class="controls">
            <button class="btn btn-primary" onclick="window.location.href = 'createProduct.php'">+ Agregar Nuevo Producto</button>
        </div>

        <!-- Products List -->
        <div class="products-grid">
            <div class="products-header">
                <h2>Productos</h2>
                <input type="text" class="search-box" placeholder="Buscar productos...">
            </div>
            
            <?php while ($products = mysqli_fetch_array($hacerConsulta)) { ?>
                <div class="product-card">
                    <div class="product-content">
                        <div class="product-image-section">
                            <img src="data:image/jpeg;base64,<?php echo $products['imagen'] ?>" alt="imagen" class="product-main-image">
                            <div class="product-gallery">
                                <?php 
                                $imagenes = json_decode($products['imagenes']);
                                for ($i = 0; $i <= count($imagenes); $i++) { ?>
                                <img src="data:image/jpeg;base64,<?php echo $imagenes[$i] ?>" alt="Vista" class="product-gallery-image">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="product-details">
                            <div class="product-header">
                                <div class="product-info">
                                    <h3><?php echo $products['nombre'] ?></h3>
                                    <div class="product-price"><?php echo $products['precio'] ?></div>
                                </div>
                                <div class="product-stock stock-high"><?php echo $products['stock'] ?></div>
                            </div>
                            <p><strong>Categoría:</strong> <?php echo $products['categoria'] ?></p>
                            <p class="product-description"><?php echo $products['descripcion'] ?></p>
                            <div class="product-actions">
                                <button class="btn btn-warning btn-sm" onclick="window.location.href = 'updateProduct.php?id=<?php echo $products['id_producto'] ?>'">Editar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            
            <!-- No products message -->
            <!-- <div class="no-products">No hay productos para mostrar</div> -->
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirmar Eliminación</h3>
            </div>
            <p>¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.</p>
            <div class="modal-actions">
                <form method="POST" action="" style="display: inline;">
                    <input type="hidden" name="productId" value="">
                    <button type="submit" class="btn btn-danger" name="deleteProduct">Eliminar</button>
                </form>
                <button class="btn btn-primary">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <!-- 
    <div class="alert alert-success">Producto agregado correctamente</div>
    <div class="alert alert-danger">Error al eliminar el producto</div>
    <div class="alert alert-warning">Producto actualizado correctamente</div>
    -->
</body>
</html>