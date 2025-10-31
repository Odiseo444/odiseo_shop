<?php session_start();
$id = $_SESSION['id'] ?? '';
include_once 'inc\database.php';
if (!($id == '')) {
  $consult = "SELECT * FROM usuarios WHERE id_usuario='$id'";
  $doConsult = mysqli_query($conexion, $consult);
  $user = mysqli_fetch_array($doConsult);
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
$consulta = 'SELECT * FROM categorias';
$doConsulta =  mysqli_query($conexion, $consulta);

$sqlConsult = 'SELECT * FROM categorias';
$consultSql = mysqli_query($conexion, $sqlConsult);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda || Odiseo Shop - Moda Masculina</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/shop.css">
</head>
<body>
    <header class="navbar">
        <div class="header-left">
            <a href="Account/account.php"><span class="material-symbols-outlined">account_circle</span></a>
            <div class="logo">ODISEO SHOP</div>
        </div>
        <nav class="nav-links">
        <a href="index.php">Inicio</a>
      <a href="#">Tienda</a>
      <a href="nosotros.php">Nosotros</a>
      <a href="#">Contacto</a>
<a href="Cart/cart.php">Carrito</a>
      <?php if (isset($user)) if ($user['rol'] === '0') {
          echo '<a href="Panel/panel.php">Panel de productos</a>';
        } ?>
        </nav>
    </header>

    <div class="main-container">
        <div class="shop-hero">
            <h1>Catálogo Completo</h1>
            <p>Descubre toda nuestra colección de moda premium</p>
        </div>

        <div class="filters-container">
            <div class="filters-header">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Buscar productos..." id="searchInput">
                    <button class="search-btn">🔍</button>
                </div>
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid">⊞</button>
                    <button class="view-btn" data-view="list">☰</button>
                </div>
            </div>
            
            <div class="filters-row">
                <div class="filter-group">
                    <label>Categoría:</label>
                    <select class="filter-select" id="categoryFilter">
                        <option value="" selected>Selecciona una categoria</option>
                    <?php while ($categ = mysqli_fetch_array($consultSql)) { ?>
                        <option value="<?php echo $categ['nombre'] ?>"><?php echo $categ['nombre'] ?></option>
                    <?php } ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>Precio:</label>
                    <select class="filter-select" id="priceFilter">
                        <option value="">Todos</option>
                        <option value="0-50">$0 - $50</option>
                        <option value="50-100">$50 - $100</option>
                        <option value="100-200">$100 - $200</option>
                        <option value="200-500">$200+</option>
                    </select>
                </div>
                
                <button class="btn-clear" onclick="clearFilters()">Limpiar filtros</button>
            </div>
        </div>

        <div class="products-stats">
            <div class="results-count">Mostrando <strong id="resultsCount">0</strong> productos</div>
            <div>
                <select class="filter-select" id="sortSelect">
                    <option value="default">Ordenar por</option>
                    <option value="price-low">Precio: Menor a Mayor</option>
                    <option value="price-high">Precio: Mayor a Menor</option>
                    <option value="name">Nombre A-Z</option>
                </select>
            </div>
        </div>

        <div class="products-grid" id="productsGrid">
            <?php while ($products = mysqli_fetch_array($hacerConsulta)) { ?>
            <div class="product-card" data-category="<?php echo $products['categoria'] ?>" data-price="<?php echo $products['precio'] ?>" data-id='<?php echo $products['id_producto'] ?>'>
                <div class="product-image-container">
                    <img src="data:image/jpeg;base64,<?php echo $products['imagen'] ?>" class="product-image">
                    <div class="product-badges">
                        <span class="badge badge-new">Nuevo</span>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-category"><?php echo $products['categoria'] ?></div>
                    <h3 class="product-title"><?php echo $products['nombre'] ?></h3>
                    <p class="product-description"><?php echo $products['descripcion'] ?></p>
                    <div class="product-price-section">
                        <div>
                            <span class="current-price">$<?php echo number_format($products['precio'], 0, ',', '.') ?> COP</span>
                        </div>
                        <div class="product-rating">
                            <span class="stars">★★★★★</span>
                            <span>(24)</span>
                        </div>
                    </div>
                    <button class="btn-add-cart">Ver</button>
                </div>
              </div>
              
              <?php } ?>
            
        </div>

    <script>
      window.onload = function() {
          document.getElementById('resultsCount').textContent = document.querySelectorAll('.product-card').length;
      };
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const grid = document.getElementById('productsGrid');
                const cards = document.querySelectorAll('.product-card');
                
                if (this.dataset.view === 'list') {
                    grid.classList.add('list-view');
                    cards.forEach(card => card.classList.add('list-item'));
                } else {
                    grid.classList.remove('list-view');
                    cards.forEach(card => card.classList.remove('list-item'));
                }
            });
        });

        // Búsqueda
        document.getElementById('searchInput').addEventListener('input', function() {
            const search = this.value.toLowerCase();
            filterProducts();
        });

        // Filtros
        document.getElementById('categoryFilter').addEventListener('change', filterProducts);
        document.getElementById('priceFilter').addEventListener('change', filterProducts);

        function filterProducts() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const category = document.getElementById('categoryFilter').value;
            const priceRange = document.getElementById('priceFilter').value;
            const cards = document.querySelectorAll('.product-card');
            let count = 0;

            cards.forEach(card => {
                let show = true;
                const title = card.querySelector('.product-title').textContent.toLowerCase();
                const cardCategory = card.dataset.category;
                const price = parseInt(card.dataset.price);

                if (search && !title.includes(search)) show = false;
                if (category && cardCategory !== category) show = false;
                
                if (priceRange) {
                    const [min, max] = priceRange.split('-').map(p => parseInt(p) || 999999);
                    if (price < min || price > max) show = false;
                }

                card.style.display = show ? 'block' : 'none';
                if (show) count++;
              });
              if (count == 0) {
                document.querySelector('.products-grid').innerHTML += '<p class="text-no">No existe un producto con esas características</p>';
            } else {
                document.querySelector('.text-no    ').remove();
            }

            document.getElementById('resultsCount').textContent = count;
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('categoryFilter').value = '';
            document.getElementById('priceFilter').value = '';
            filterProducts();
        }

        // Ordenar
        document.getElementById('sortSelect').addEventListener('change', function() {
            const grid = document.getElementById('productsGrid');
            const cards = Array.from(document.querySelectorAll('.product-card'));
            
            cards.sort((a, b) => {
                switch(this.value) {
                    case 'price-low':
                        return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                    case 'price-high':
                        return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                    case 'name':
                        const nameA = a.querySelector('.product-title').textContent;
                        const nameB = b.querySelector('.product-title').textContent;
                        return nameA.localeCompare(nameB);
                    default:
                        return 0;
                }
            });

            cards.forEach(card => grid.appendChild(card));
        });

      const productCard = document.querySelectorAll('.product-card');

        productCard.forEach(card => {
            card.addEventListener('click', () => {
            const productId = card.getAttribute('data-id');
            window.location.href = 'producto.php?idPro=' + productId;
            });
        });
    </script>
</body>
</html>
