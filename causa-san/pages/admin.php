<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
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

    <h2>Panel de Administración</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Municipio</th>
                <th>Código Postal</th>
                <th>Domicilio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../scripts/db.php';

            $sql = "SELECT * FROM usuarios";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_usuario']}</td>
                            <td>{$row['nombre_usuario']}</td>
                            <td>{$row['telefono']}</td>
                            <td>{$row['correo']}</td>
                            <td>{$row['municipio']}</td>
                            <td>{$row['cp']}</td>
                            <td>{$row['domicilio']}</td>
                            <td>
                                <a href='../scripts/edit_user.php?id={$row['id_usuario']}' class='btn btn-primary'>Editar</a>
                                <a href='../scripts/delete_user.php?id={$row['id_usuario']}' class='btn btn-danger'>Eliminar</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay usuarios registrados.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>
