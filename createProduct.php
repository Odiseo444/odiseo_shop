<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="css\style.css">
</head>
<body>

    <div class="contenedor">
        <h1>Agregar Nuevo Producto</h1>

        <form action="subirProducto.php" method="POST" enctype="multipart/form-data">
            <div class="form-grupo">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-grupo">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
            </div>

            <div class="form-grupo">
                <label for="precio">Precio ($)</label>
                <input type="number" step="0.01" id="precio" name="precio" required>
            </div>

            <div class="form-grupo">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" required>
            </div>

            <div class="form-grupo">
                <label for="imagenes">Imágenes del Producto</label>
                <input type="file" id="imagenes" name="imagenes" multiple accept="image/*">
            </div>

            <div class="form-grupo">
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="marca" required>
            </div>

            <div class="form-grupo">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="1">Electrónica</option>
                    <option value="2">Ropa</option>
                    <option value="3">Hogar</option>
                    <!-- Agrega más categorías aquí -->
                </select>
            </div>

            <div class="form-grupo">
                <label for="subcategoria">Subcategoría</label>
                <select id="subcategoria" name="subcategoria" required>
                    <option value="">Seleccione una subcategoría</option>
                    <option value="1">Teléfonos</option>
                    <option value="2">Televisores</option>
                    <option value="3">Lavadoras</option>
                    <!-- Agrega más subcategorías aquí -->
                </select>
            </div>

            <div class="form-grupo">
                <label for="fecha_creacion">Fecha de Creación</label>
                <input type="date" id="fecha_creacion" name="fecha_creacion" required>
            </div>

            <div class="form-grupo">
                <label for="ultima_actualizacion">Última Actualización</label>
                <input type="date" id="ultima_actualizacion" name="ultima_actualizacion" required>
            </div>

            <button type="submit" class="btn">Guardar Producto</button>
        </form>
    </div>

</body>
</html>
