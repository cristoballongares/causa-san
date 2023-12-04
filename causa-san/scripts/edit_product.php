<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <h2>Editar Producto</h2>

    <?php
    require_once 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id_producto = $_GET['id'];

        $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
    ?>
            <form method="post" action="validate_product.php" enctype="multipart/form-data">
                <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $row['nombre']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Cantidad disponible</label>
                    <input name="stock" type="text" class="form-control" id="stock" value="<?php echo $row['stock']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio unitario</label>
                    <input name="precio" type="text" class="form-control" id="precio" value="<?php echo $row['precio']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input name="test" type="text" class="form-control" id="test" value="<?php echo $row['categoria']; ?>" disabled>
                    <select name="categoria" class="form-select" id="categoria" required>
                        <option value="mangas">Mangas</option>
                        <option value="comics">Comics</option>
                        <option value="figuras">Figuras</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen actual del producto: </label><br>
                    <img src="<?php echo $row['imagen']; ?>" alt="<?php echo $row['imagen']; ?>" style="max-width: 200px;"><br><br>
                    <label for="imagen" class="form-label">Seleccionar nueva imagen: </label>
                    <input name="imagen" type="file" class="form-control" id="imagen_nueva">
                </div>
                <input type="submit" class="btn btn-primary" value="Guardar Cambios"></input>
            </form>
    <?php
        } else {
            echo "Producto no encontrado.";
        }
    } else {
        echo "Parametro 'id' no especificado.";
    }

    $conn->close();
    ?>
</body>

</html>