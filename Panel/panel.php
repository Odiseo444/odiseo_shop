<?php
session_start();

$id = $_SESSION['id'];
if (!($id == '')) {
    include_once '../inc\database.php';
    $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
    $doConsult = mysqli_query($conexion, $consult);
    $user = mysqli_fetch_array($doConsult);
    } else {
    header('location:../index.php');

    if ($user['rol'] === '1') {
        header('location:../index.php');
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
    <link rel="stylesheet" href="../css/panel.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Panel de Administración</h1>
            <p>Gestiona los productos de tu tienda online de forma sencilla y eficiente</p>
            <a href="../index.php" style="color: white;">Atras</a>
        </div>

        <!-- Statistics -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number" id='totalProducts'>0</div>
                <div class="stat-label" >Productos Totales</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id='lowStock'>0</div>
                <div class="stat-label" >Stock Bajo</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id='priceProm'>$0</div>
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
                                //$imagenes = json_decode($products['imagenes']);
                                //for ($i = 0; $i <= count($imagenes); $i++) { ?>
                                <!-- <img src="data:image/jpeg;base64,<?php // echo $imagenes[$i] ?>" alt="Vista" class="product-gallery-image"> -->
                                <?php //} ?>
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
                                <button class="btn btn-danger btn-sm" onclick="showModal(<?php echo $products['id_producto'] ?>)">Eliminar</button>
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

    <!-- Alert Messages -->
    <!-- 
    <div class="alert alert-success">Producto agregado correctamente</div>
    <div class="alert alert-danger">Error al eliminar el producto</div>
    <div class="alert alert-warning">Producto actualizado correctamente</div>
    -->

    <script>
        const searchBox = document.querySelector('.search-box');
        const productCards = document.querySelectorAll('.product-card');
        const totalProducts = document.getElementById('totalProducts');
        const lowStock = document.getElementById('lowStock');
        const priceProm = document.getElementById('priceProm');
        const deleteModal = document.getElementById('deleteModal');
        const eliminatedProduct = document.getElementById('delete');
        function showModal(id) {
            deleteModal.classList.toggle('active');
            if (id) {
                eliminatedProduct.setAttribute('onclick', ' deleteProduct(' + id + ')');
            }
        }
        function deleteProduct(id) {
            
            fetch("eliminatedProduct.php?id=" + id)
            .then(res => res.json())
            .then(data => {
                window.location = 'panel.php'
            })
            .catch(err => console.error(err));
        }

        searchBox.addEventListener('input', () => {
            const query = searchBox.value.toLowerCase();
            productCards.forEach(card => {
                const productName = card.querySelector('h3').textContent.toLowerCase();
                if (productName.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        productCards.forEach(card => {
            const stock = parseInt(card.querySelector('.product-stock').textContent);
            if (stock < 5) {
                card.querySelector('.product-stock').classList.remove('stock-high');
                card.querySelector('.product-stock').classList.add('stock-low');
            }
        });

        productCards.length > 0 ? totalProducts.textContent = productCards.length : totalProducts.textContent = '0';
        let moreLowStock;
        let count = 0;
        productCards.forEach(card => {
            let lowStockCount = card.querySelector('.product-stock').textContent;
            if (count == 0) {
                moreLowStock = parseInt(lowStockCount);
            }

            if (count > 0) {
                if (moreLowStock > parseInt(lowStockCount)) {
                    moreLowStock = parseInt(lowStockCount);
                }
            }
            count += 1;
            lowStock.textContent = moreLowStock;
        });
        let totalPrice = 0;
        productCards.forEach(card => {
            let price = card.querySelector('.product-price').textContent;
            totalPrice += parseFloat(price.replace('$', ''));
            count += 1;
            priceProm.textContent = '$' + (totalPrice / count).toFixed(2);
        });
    </script>
</body>
</html>