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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="header-left">
            <a href="account.php"><span class="material-symbols-outlined">account_circle</span></a>
            <div class="logo">ODISEO SHOP</div>
        </div>
        <nav class="nav-links">
            <a href="index.php">Inicio</a>
            <a href="shop.php" class="active">Tienda</a>
            <a href="#">Ofertas</a>
            <a href="#">Contacto</a>
            <a href="panel.php">Panel</a>
        </nav>
    </header>

    <div class="main-container">
        <!-- Hero Section -->
        <div class="shop-hero">
            <h1>Catálogo Completo</h1>
            <p>Descubre toda nuestra colección de moda masculina premium</p>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="filters-container">
            <div class="filters-header">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Buscar productos..." id="searchInput">
                    <button class="search-btn" onclick="searchProducts()">🔍</button>
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
                      <option value="">Todas las categorías</option>
                      <?php while ($categ = mysqli_fetch_array($doConsulta)) { ?>
                        <option value="<?php echo $categ['id_categoria'] ?>"><?php echo $categ['nombre'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>Marca:</label>
                    <select class="filter-select" id="brandFilter">
                        <option value="">Todas las marcas</option>
                        <option value="odiseo">Odiseo</option>
                        <option value="elegance">Elegance</option>
                        <option value="streetwear">StreetWear</option>
                        <option value="premium">Premium</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>Precio:</label>
                    <select class="filter-select" id="priceFilter">
                        <option value="">Todos los precios</option>
                        <option value="0-50">$0 - $50</option>
                        <option value="50-100">$50 - $100</option>
                        <option value="100-200">$100 - $200</option>
                        <option value="200+">$200+</option>
                    </select>
                </div>
                
                <button class="btn-add-cart" onclick="clearFilters()" style="flex: none; padding: 10px 20px;">🗑️ Limpiar</button>
            </div>
            
            <div class="filter-tags" id="activeTags"></div>
        </div>

        <!-- Estadísticas de productos -->
        <div class="products-stats">
            <div class="results-count">
                Mostrando <strong id="resultsCount">12</strong> productos de <strong id="totalCount">24</strong>
            </div>
            <div class="sort-container">
                <label>Ordenar por:</label>
                <select class="sort-select" id="sortSelect">
                    <option value="featured">Destacados</option>
                    <option value="newest">Más recientes</option>
                    <option value="price-low">Precio: menor a mayor</option>
                    <option value="price-high">Precio: mayor a menor</option>
                    <option value="name">Nombre A-Z</option>
                    <option value="rating">Mejor valorados</option>
                </select>
            </div>
        </div>

        <!-- Grid de productos -->
        <div class="products-grid grid-view" id="productsGrid">
            <!-- Producto de ejemplo 1 -->
            <?php while ($products = mysqli_fetch_array($hacerConsulta)) { ?>
            <div class="product-card" data-category="camisas" data-brand="odiseo" data-price="89">
                <div class="product-image-container">
                    <img src="data:image/jpeg;base64,<?php echo $products['imagen'] ?>" alt="Camisa Premium" class="product-image">
                    <div class="product-badges">
                        <span class="badge badge-new">Nuevo</span>
                    </div>
                    <div class="product-actions-overlay">
                        <button class="action-btn" title="Favoritos">♡</button>
                        <button class="action-btn" title="Vista rápida">👁</button>
                        <button class="action-btn" title="Comparar">⚖</button>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-category"><?php echo $products['categoria'] ?></div>
                    <h3 class="product-title"><?php echo $products['nombre'] ?></h3>
                    <p class="product-description"><?php echo $products['descripcion'] ?></p>
                    <div class="product-features">
                        <span class="feature-tag"><?php echo $products['categoria'] ?></span>
                        <span class="feature-tag"><?php echo $products['subcategoria'] ?></span>
                    </div>
                    <div class="product-price-section">
                        <div class="product-price">
                            <span class="current-price">$<?php echo $products['precio'] ?></span>
                        </div>
                        <div class="product-rating">
                            <span class="stars">★★★★★</span>
                            <span class="rating-count">(24)</span>
                        </div>
                    </div>
                    <div class="product-actions">
                        <button class="btn-add-cart">Agregar al carrito</button>
                        <button class="btn-quick-view">👁</button>
                    </div>
                </div>
                </div>
                <?php } ?>


        </div>
    </div>

    <!-- CTA -->
    <section class="cta-section">
      <h2>Suscríbete a nuestro boletín</h2>
      <p>Recibe ofertas exclusivas y las últimas tendencias</p>
      <form class="cta-form">
        <input type="email" placeholder="Tu correo electrónico" required>
        <button type="submit" class="cta-btn">Suscribirme</button>
      </form>
    </section>
  </div>

  <!-- FOOTER -->
  <footer class="footer">
    <p>&copy; 2025 Odiseo Shop. Todos los derechos reservados.</p>
    <div>
      <a href="#"><i class="fab fa-facebook-f">📘</i></a>
      <a href="#"><i class="fab fa-instagram">📷</i></a>
      <a href="#"><i class="fab fa-twitter">🐦</i></a>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
<script>
  document.addEventListener('DOMContentLoaded', () => {
  /* -------------------------
     Injectar estilos mínimos
     ------------------------- */
  const style = document.createElement('style');
  style.textContent = `
    .hidden{display:none !important;}
    .no-products{padding:2rem;text-align:center;color:#666;font-size:1.05rem;}
    #activeTags .active-tag{display:inline-flex;align-items:center;padding:6px 10px;background:#f1f3f5;border-radius:999px;margin-right:6px;margin-bottom:6px;font-weight:600}
    #activeTags .active-tag button{background:none;border:none;margin-left:8px;cursor:pointer;font-weight:700}
    .view-btn.active{box-shadow:0 6px 18px rgba(0,0,0,0.12);transform:translateY(-2px)}
  `;
  document.head.appendChild(style);

  /* -------------------------
     Elementos del DOM
     ------------------------- */
  const productsGrid = document.getElementById('productsGrid');
  if (!productsGrid) return; // seguridad si cambia el id

  // colección inicial (tomada una vez)
  let productNodes = Array.from(productsGrid.querySelectorAll('.product-card'));
  const totalCountEl = document.getElementById('totalCount');
  const resultsCountEl = document.getElementById('resultsCount');

  const categorySelect = document.getElementById('categoryFilter');
  const brandSelect = document.getElementById('brandFilter');
  const priceSelect = document.getElementById('priceFilter');
  const searchInput = document.getElementById('searchInput');
  const sortSelect = document.getElementById('sortSelect');
  const activeTags = document.getElementById('activeTags');
  const viewBtns = document.querySelectorAll('.view-btn');

  // guardar orden original para "featured"
  const originalOrder = productNodes.slice();

  // establecer total count
  if (totalCountEl) totalCountEl.textContent = productNodes.length;

  // crear elemento "no results"
  let noResultsDiv = productsGrid.querySelector('.no-products');
  if (!noResultsDiv) {
    noResultsDiv = document.createElement('div');
    noResultsDiv.className = 'no-products hidden';
    noResultsDiv.textContent = 'No hay productos que coincidan con tus filtros.';
    productsGrid.appendChild(noResultsDiv);
  }

  /* -------------------------
     Helpers: leer datos del producto
     ------------------------- */
  function parsePrice(card) {
    // 1) intenta dataset.price
    const ds = card.dataset.price;
    if (ds !== undefined && ds !== '') {
      const n = Number(ds);
      if (!isNaN(n)) return n;
    }
    // 2) fallback por texto .current-price
    const el = card.querySelector('.current-price');
    if (el) {
      const txt = el.textContent.replace(/[^0-9,.\-]/g, '').replace(',', '.'); // quitar $ y texto
      const num = parseFloat(txt);
      return isNaN(num) ? 0 : num;
    }
    return 0;
  }

  function getCategory(card) {
    const ds = card.dataset.category;
    if (ds) return String(ds).trim().toLowerCase();
    const el = card.querySelector('.product-category');
    if (el) return el.textContent.trim().toLowerCase();
    // fallback: buscar en feature-tags
    const f = card.querySelector('.feature-tag');
    if (f) return f.textContent.trim().toLowerCase();
    return '';
  }

  function getBrand(card) {
    const ds = card.dataset.brand;
    if (ds) return String(ds).trim().toLowerCase();
    // intentar selectores comunes (si en un futuro añades marca dentro del card)
    const possible = card.querySelector('.product-brand, .producto-marca, .brand');
    if (possible) return possible.textContent.trim().toLowerCase();
    return '';
  }

  function getTitle(card) {
    return (card.querySelector('.product-title')?.textContent || '').trim().toLowerCase();
  }
  function getDescription(card) {
    return (card.querySelector('.product-description')?.textContent || '').trim().toLowerCase();
  }
  function getFeaturesText(card) {
    return Array.from(card.querySelectorAll('.feature-tag')).map(x => x.textContent).join(' ').toLowerCase();
  }

  /* -------------------------
     Mapa: si el select de categorías usa IDs, mapeamos id -> nombre (texto del option)
     esto nos permite comparar la opción seleccionada con el texto imprimido en la tarjeta
     ------------------------- */
  const categoryIdToName = {};
  if (categorySelect) {
    Array.from(categorySelect.options).forEach(opt => {
      const val = String(opt.value || '').trim();
      if (val !== '') categoryIdToName[val] = opt.textContent.trim().toLowerCase();
    });
  }

  /* -------------------------
     Filtrado principal
     ------------------------- */
  function filtrarYRenderizar() {
    const catVal = (categorySelect?.value || '').trim();
    const brandVal = (brandSelect?.value || '').trim().toLowerCase();
    const priceVal = (priceSelect?.value || '').trim(); // "0-50", "200+", etc
    const searchVal = (searchInput?.value || '').trim().toLowerCase();

    // convertir catVal (id) a nombre si existe en el map
    const catLabel = catVal && categoryIdToName[catVal] ? categoryIdToName[catVal] : (catVal || '');

    let visibles = 0;

    productNodes.forEach(card => {
      let mostrar = true;

      // categoría: comparamos con texto de categoria en la tarjeta
      if (catLabel) {
        const cardCat = getCategory(card);
        if (!cardCat) mostrar = false;
        else if (!cardCat.includes(catLabel)) mostrar = false;
      }

      // marca
      if (brandVal) {
        const cardBrand = getBrand(card);
        if (!cardBrand || !cardBrand.includes(brandVal)) mostrar = false;
      }

      // precio
      if (priceVal) {
        const price = parsePrice(card);
        if (priceVal.endsWith('+')) {
          const min = Number(priceVal.slice(0, -1));
          if (isNaN(min) || price < min) mostrar = false;
        } else if (priceVal.includes('-')) {
          const [minS, maxS] = priceVal.split('-');
          const min = Number(minS) || 0;
          const max = Number(maxS) || Infinity;
          if (price < min || price > max) mostrar = false;
        }
      }

      // búsqueda de texto (title, description, category, features, brand)
      if (searchVal) {
        const hay = (
          getTitle(card).includes(searchVal) ||
          getDescription(card).includes(searchVal) ||
          getCategory(card).includes(searchVal) ||
          getBrand(card).includes(searchVal) ||
          getFeaturesText(card).includes(searchVal)
        );
        if (!hay) mostrar = false;
      }

      // aplicar visibilidad
      if (mostrar) {
        card.classList.remove('hidden');
        card.style.display = ''; // devolvemos a estilo por defecto
        visibles++;
      } else {
        card.classList.add('hidden');
      }
    });

    // actualizar contadores
    if (resultsCountEl) resultsCountEl.textContent = visibles;
    // mostrar/ocultar mensaje "no hay productos"
    if (noResultsDiv) {
      if (visibles === 0) noResultsDiv.classList.remove('hidden');
      else noResultsDiv.classList.add('hidden');
    }

    // actualizar etiquetas activas
    renderActiveTags({ catVal, brandVal, priceVal, searchVal });

    // aplicar orden (reordenar DOM)
    aplicarOrden();
  }

  /* -------------------------
     Ordenamiento (reordena DOM según sortSelect)
     ------------------------- */
  function aplicarOrden() {
    const orden = sortSelect?.value || 'featured';
    // tomar solo nodos visibles
    const visibles = productNodes.filter(n => !n.classList.contains('hidden'));

    let ordenados = visibles.slice();

    if (orden === 'featured') {
      // orden original: mantener el orden en originalOrder pero solo elementos visibles
      const orderIndex = new Map(originalOrder.map((n,i)=>[n, i]));
      ordenados.sort((a,b)=> (orderIndex.get(a) || 0) - (orderIndex.get(b) || 0));
    } else if (orden === 'newest') {
      // intenta por data-date (si existe), sino mantiene orden actual
      ordenados.sort((a,b) => {
        const da = a.dataset.date ? Date.parse(a.dataset.date) : 0;
        const db = b.dataset.date ? Date.parse(b.dataset.date) : 0;
        return db - da;
      });
    } else if (orden === 'price-low') {
      ordenados.sort((a,b)=> parsePrice(a) - parsePrice(b));
    } else if (orden === 'price-high') {
      ordenados.sort((a,b)=> parsePrice(b) - parsePrice(a));
    } else if (orden === 'name') {
      ordenados.sort((a,b)=> getTitle(a).localeCompare(getTitle(b)));
    } else if (orden === 'rating') {
      // si hay data-rating o .rating-count
      const parseRating = card => {
        if (card.dataset.rating) return Number(card.dataset.rating);
        const rc = card.querySelector('.rating-count');
        if (rc) {
          const match = rc.textContent.match(/\d+/);
          return match ? Number(match[0]) : 0;
        }
        return 0;
      };
      ordenados.sort((a,b)=> parseRating(b) - parseRating(a));
    }

    // reinsertar ordenados en el DOM (solo los visibles)
    const frag = document.createDocumentFragment();
    ordenados.forEach(node => frag.appendChild(node));
    // después volvemos a adjuntar los elementos ocultos al final en su orden original para no perderlos
    productNodes.filter(n => n.classList.contains('hidden')).forEach(node => frag.appendChild(node));
    productsGrid.appendChild(frag);
  }

  /* -------------------------
     Etiquetas activas (badges) con opción de remover
     ------------------------- */
  function renderActiveTags({ catVal, brandVal, priceVal, searchVal }) {
    if (!activeTags) return;
    activeTags.innerHTML = '';

    const addTag = (label, onRemove) => {
      const t = document.createElement('span');
      t.className = 'active-tag';
      t.innerHTML = `${label} <button aria-label="remove">x</button>`;
      t.querySelector('button').addEventListener('click', onRemove);
      activeTags.appendChild(t);
    };

    if (catVal) {
      const label = (categoryIdToName[catVal] || categorySelect.options[categorySelect.selectedIndex].text).trim();
      addTag(`Categoria: ${label}`, () => {
        categorySelect.selectedIndex = 0;
        filtrarYRenderizar();
      });
    }
    if (brandVal) {
      addTag(`Marca: ${brandSelect.options[brandSelect.selectedIndex].text}`, () => {
        brandSelect.selectedIndex = 0;
        filtrarYRenderizar();
      });
    }
    if (priceVal) {
      const label = priceSelect.options[priceSelect.selectedIndex].text;
      addTag(`Precio: ${label}`, () => {
        priceSelect.selectedIndex = 0;
        filtrarYRenderizar();
      });
    }
    if (searchVal) {
      addTag(`Buscar: ${searchVal}`, () => {
        searchInput.value = '';
        filtrarYRenderizar();
      });
    }
  }

  /* -------------------------
     Debounce util
     ------------------------- */
  function debounce(fn, wait = 200) {
    let t;
    return function(...args) {
      clearTimeout(t);
      t = setTimeout(()=> fn.apply(this, args), wait);
    };
  }

  /* -------------------------
     Eventos
     ------------------------- */
  if (categorySelect) categorySelect.addEventListener('change', filtrarYRenderizar);
  if (brandSelect) brandSelect.addEventListener('change', filtrarYRenderizar);
  if (priceSelect) priceSelect.addEventListener('change', filtrarYRenderizar);
  if (sortSelect) sortSelect.addEventListener('change', filtrarYRenderizar);

  if (searchInput) searchInput.addEventListener('input', debounce(() => filtrarYRenderizar(), 180));

  // view toggle (grid / list)
  viewBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      viewBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const view = btn.dataset.view;
      if (view === 'list') {
        productsGrid.classList.remove('grid-view');
        productsGrid.classList.add('list-view');
      } else {
        productsGrid.classList.remove('list-view');
        productsGrid.classList.add('grid-view');
      }
    });
  });

  /* -------------------------
     Funciones globales accesibles desde HTML (clear, search)
     ------------------------- */
  window.clearFilters = function() {
    if (categorySelect) categorySelect.selectedIndex = 0;
    if (brandSelect) brandSelect.selectedIndex = 0;
    if (priceSelect) priceSelect.selectedIndex = 0;
    if (searchInput) searchInput.value = '';
    if (sortSelect) sortSelect.selectedIndex = 0;
    // reestablecer orden original en DOM
    const frag = document.createDocumentFragment();
    originalOrder.forEach(n => frag.appendChild(n));
    productsGrid.appendChild(frag);
    productNodes = Array.from(productsGrid.querySelectorAll('.product-card'));
    filtrarYRenderizar();
  };

  window.searchProducts = function() {
    // llamada desde el botón de búsqueda
    filtrarYRenderizar();
    // opcional: poner foco o cerrar teclado si móvil
    searchInput?.blur();
  };

  /* -------------------------
     Inicializar
     ------------------------- */
  filtrarYRenderizar();
});

</script>
</html>