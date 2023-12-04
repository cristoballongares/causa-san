<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <h2>Editar Usuario</h2>
    
    <?php
    require_once 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $usuario_id = $_GET['id'];

        $sql = "SELECT * FROM usuarios WHERE id_usuario = $usuario_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="validate_edit.php">
                <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $row['nombre_usuario']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input name="telefono" type="text" class="form-control" id="telefono" value="<?php echo $row['telefono']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input name="correo" type="email" class="form-control" id="correo" value="<?php echo $row['correo']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="municipio" class="form-label">Municipio</label>
                    <input name="municipio" type="text" class="form-control" id="municipio" value="<?php echo $row['municipio']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="codigo_postal" class="form-label">Código Postal</label>
                    <input name="codigo_postal" type="text" class="form-control" id="codigo_postal" value="<?php echo $row['cp']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="domicilio" class="form-label">Domicilio</label>
                    <input name="domicilio" type="text" class="form-control" id="domicilio" value="<?php echo $row['domicilio']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="saldo" class="form-label">Saldo</label>
                    <input name="saldo" type="text" class="form-control" id="saldo" value="<?php echo $row['SALDO']; ?>" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Guardar Cambios"></input>
            </form>
            <?php
        } else {
            echo "Usuario no encontrado.";
        }
    } else {
        echo "Parámetro 'id' no especificado.";
    }

    $conn->close();
    ?>
</body>
</html>
