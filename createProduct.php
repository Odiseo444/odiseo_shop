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
$sql = 'SELECT * FROM categorias';
$hacerConsulta = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="css/panel.css">
</head>
<body>

<div class="form-container active">
            <h2>Agregar Nuevo Producto</h2>
            <form method="POST" action="subirProducto.php">
                <div class="form-group">
                    <label for="productName">Nombre del Producto *</label>
                    <input type="text" class="form-control" id="productName" name="productName" required>
                </div>
                
                <div class="form-group">
                    <label for="productPrice">Precio *</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="productStock">Stock *</label>
                    <input type="number" class="form-control" id="productStock" name="productStock" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="productCategory">Categoría</label>
                    <select name="categoria" class="form-control" id="productCategory">
                        <option value="" selected>Selecciona una categoria</option>
                    <?php while ($categ = mysqli_fetch_array($hacerConsulta)) { ?>    
                    <option value="<?php echo $categ['id_categoria'] ?>"><?php echo $categ['nombre'] ?></option>
                    <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="productSubCategory">Sub Categoría</label>
                    <select name="subcategoria" class="form-control" id="productSubCategory">
                        <option value=""><?php if () ?></option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="productDescription">Descripción</label>
                    <textarea class="form-control" id="productDescription" name="productDescription" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="mainImage">Imagen Principal *</label>
                    <div class="image-upload-container">
                        <label for="mainImage" class="upload-label">
                            <div class="upload-icon">📷</div>
                            <strong>Haz clic aquí o arrastra la imagen principal</strong>
                            <br><small>Formatos: JPG, PNG, GIF - Máximo 5MB</small>
                        </label>
                        <input type="file" id="mainImage" name="mainImage" class="file-input" accept="image/*" required>
                    </div>
                    <div class="image-preview-container" id="mainImagePreview"></div>
                </div>

                <div class="form-group">
                    <label for="galleryImages">Imágenes de Galería (Opcional)</label>
                    <div class="image-upload-container">
                        <label for="galleryImages" class="upload-label">
                            <div class="upload-icon">🖼️</div>
                            <strong>Selecciona múltiples imágenes para la galería</strong>
                            <br><small>Puedes seleccionar hasta 5 imágenes adicionales</small>
                        </label>
                        <input type="file" id="galleryImages" name="galleryImages[]" class="file-input" accept="image/*" multiple>
                    </div>
                    <div class="image-preview-container" id="galleryPreview"></div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="addProduct">Agregar Producto</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.replace('panel.php')">Cancelar</button>
                </div>
            </form>
        </div>

</body>
</html>
