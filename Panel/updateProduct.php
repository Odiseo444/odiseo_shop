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

}
    if ($user['rol'] === '1') {
        header('location:../index.php');
    }

$sql = 'SELECT * FROM categorias';
$hacerConsulta = mysqli_query($conexion, $sql);

$idProd = $_GET['id'];

$consulta = "SELECT * FROM productos WHERE id_producto='$idProd'";
$obtenerConsulta = mysqli_query($conexion, $consulta);
$product = mysqli_fetch_array($obtenerConsulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="../css/panel.css">
</head>
<body>

<div class="form-container active">
            <h2>Actualizar Producto</h2>
            <form method="POST" action='actualizarProducto.php?id=<?php echo $idProd ?>' enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Nombre del Producto *</label>
                    <input type="text" value="<?php echo $product['nombre'] ?>" class="form-control" id="productName" name="nombre" required>
                </div>
                
                <div class="form-group">
                    <label for="productPrice">Precio *</label>
                    <input type="number" value="<?php echo $product['precio'] ?>" class="form-control" id="productPrice" name="precio" step="0.01" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="productStock">Stock *</label>
                    <input type="number" value="<?php echo $product['stock'] ?>" class="form-control" id="productStock" name="stock" min="0" required>
                </div>

                <div class="form-group">
                    <label for="marca">Marca *</label>
                    <input type="text" value="<?php echo $product['marca'] ?>" class="form-control" id="marca" name="marca" required>
                </div>
                
                <div class="form-group">
                    <label for="productCategory">Categoría</label>
                    <select name="categoria" class="form-control" id="productCategory">
                        <option value="" selected>Selecciona una categoria</option>
                    <?php while ($categ = mysqli_fetch_array($hacerConsulta)) { ?>    
                    <option value="<?php echo $categ['id_categoria'] ?>" <?php if ($categ['id_categoria'] == $product['id_categoria']) echo 'selected'?>><?php echo $categ['nombre'] ?></option>
                    <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subcategoria">Sub Categoría</label>
                    <select name="subcategoria" class="form-control" id="productSubCategory">
                        <option value=""></option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="productDescription">Descripción</label>
                    <textarea class="form-control" id="productDescription" name="descripcion" rows="4"><?php echo $product['descripcion'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="mainImg">Imagen Principal *</label>
                    <div class="image-upload-container">
                        <label for="mainImg" class="upload-label">
                            <div class="upload-icon">📷</div>
                            <strong>Haz clic aquí o arrastra la imagen principal</strong>
                            <br><small>Formatos: JPG, PNG, GIF - Máximo 5MB</small>
                        </label>
                        <input type="file" id="mainImg" name="imagen" class="file-input" accept="image/*">
                    </div>
                    <div class="image-preview-container" id="mainImagePreview">
                        <?php echo "<img src='data:image/jpeg;base64,". $product['imagen'] . "' class='image-preview' alt=''>" ?>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="galleryImages">Imágenes de Galería (Opcional)</label>
                    <div class="image-upload-container">
                        <label for="galleryImages" class="upload-label">
                            <div class="upload-icon">🖼️</div>
                            <strong>Selecciona múltiples imágenes para la galería</strong>
                            <br><small>Puedes seleccionar hasta 5 imágenes adicionales</small>
                        </label>
                        <input type="file" id="galleryImages" name="imagenes[]" class="file-input" accept="image/*" multiple>
                    </div>
                    <div class="image-preview-container" id="galleryPreview"></div>
                </div> -->
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="addProduct">Actualizar Producto</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.replace('panel.php')">Cancelar</button>
                </div>
            </form>
        </div>
<script>
    const fileInput = document.getElementById('mainImg');
    const filesInput = document.getElementById('galleryImages');
    const mainImagePreview = document.getElementById('mainImagePreview');
    const galleryImages = document.getElementById('galleryPreview');

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (file) {
            const imageUrl = URL.createObjectURL(file);
            mainImagePreview.innerHTML = `<img src="${imageUrl}" class='image-preview' alt="">`
        }
    });

    /* filesInput.addEventListener('change', () => {
        galleryImages.innerHTML = "";
        const files = filesInput.files;
        for (const file of files) {
            if (file.type.startsWith('image/')) {
                const imageUrl = URL.createObjectURL(file);
                galleryImages.innerHTML += `<img src="${imageUrl}" class='image-preview' alt="">`;
            }
        }
    }); */

document.getElementById('productCategory').addEventListener('change', function() {
    let categoriaId = this.value;

    if(categoriaId === ""){
        document.getElementById('productSubCategory').innerHTML = "<option value=''>-- Selecciona Subcategoría --</option>";
        return;
    }

    fetch("get_subcategories.php?categoria_id=" + categoriaId)
        .then(res => res.json())
        .then(data => {
            let subcatSelect = document.getElementById('productSubCategory');
            subcatSelect.innerHTML = "<option value=''>-- Selecciona Subcategoría --</option>";

            data.forEach(subcat => {
                subcatSelect.innerHTML += `<option value="${subcat.id_subcategoria}">${subcat.nombre}</option>`;
            });
        })
        .catch(err => console.error(err));
});

document.addEventListener('DOMContentLoaded', () => {
    categoriaId = document.getElementById('productCategory').value
    if (categoriaId == "") {
        console.error('error')
    }
    fetch("get_subcategories.php?categoria_id=" + categoriaId)
        .then(res => res.json())
        .then(data => {
            let subcatSelect = document.getElementById('productSubCategory');
            subcatSelect.innerHTML = "<option value=''>-- Selecciona Subcategoría --</option>";
            data.forEach(subcat => {
                let selected = subcat.id_subcategoria == <?php echo $product['id_subcategoria'] ?> ? 'selected' : ''
                console.log('hola')
                subcatSelect.innerHTML += `<option value="${subcat.id_subcategoria}" ${selected}>${subcat.nombre}</option>`;
            });
        })
        .catch(err => console.error(err));
})
</script>
</body>
</html>
