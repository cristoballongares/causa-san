<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        nav {
            background-color: #190482;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }

        nav .brand {
            display: flex;
            align-items: center;
        }

        nav .brand img {
            width: 40px;
            margin-right: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #e5e5e5;
        }

        nav .search-bar {
            flex: 1;
            margin: 0 20px;
            position: relative;
        }

        nav .search-bar input[type="text"] {
            width: calc(70% - 40px);
            padding: 10px;
            border-radius: 20px;
            border: none;
            outline: none;
            font-size: 16px;
        }

        nav .search-bar input[type="text"]::placeholder {
            color: #ccc;
        }

        nav .search-bar button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        nav .search-bar button img {
            width: 20px;
        }

        nav .search-bar button:focus {
            outline: none;
        }

        nav .welcome-user {
            margin-left: auto;
        }

        h1 {
            margin: 20px;
            color: #190482;
        }

        form {
            width: 70%;
            margin: 0 auto;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #190482;
            border: none;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2c0f8c;
        }

        h2 {
            margin: 20px;
            color: #190482;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #190482;
            color: white;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0a043c;
            color: white;
        }

        td {
            background-color: #271052;
        }

        a {
            color: #190482;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <nav>
        <div class="brand">
            <img src="../imgs/sombrero.png" alt="Logo de la tienda">
            <h1>Causa-San - Panel de control</h1>
        </div>
        <div class="search-bar"></div>
        <ul>
            <li><a href="orders_manager.php">Pedidos</a></li>
            <li><a href="admin.php">Usuarios</a></li>
            <li><a href="Productos.php">Productos</a></li>
        </ul>
        <div class="welcome-user"></div>
    </nav>

    <h1>Añadir Productos</h1>
    <form action="../scripts/add_product.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto: </label>
            <input name="nombre" type="text" class="form-control" id="nombre" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Cantidad disponible: </label>
            <input name="stock" type="text" class="form-control" id="stock" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio del producto: </label>
            <input name="precio" type="text" class="form-control" id="precio" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria del producto: </label>
            <select name="categoria" class="form-select" required>
                <option value="mangas">Mangas</option>
                <option value="comics">Comics</option>
                <option value="figuras">Figuras</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del producto: </label>
            <input name="imagen" type="file" class="form-control" id="imagen" required>
        </div>
        <input type="submit" class="btn btn-primary" value="Registrar"></input>
    </form>

    <h2>Panel de productos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Imagenes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once("../scripts/db.php");
            $sql = "SELECT * from productos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_producto']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['stock']}</td>
                            <td>{$row['precio']}</td>
                            <td>{$row['categoria']}</td>
                            <td>{$row['imagen']}</td>
                            <td>
                                <a href='../scripts/edit_product.php?id={$row['id_producto']}' class='btn btn-primary'>Editar</a>
                                <a href='../scripts/delete_product.php?id={$row['id_producto']}' class='btn btn-danger'>Eliminar</a>
                            </td>
                        </tr>";
                }
            }

            ?>
        </tbody>
    </table>
</body>

</html>
