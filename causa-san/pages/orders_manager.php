<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        nav {
            background-color: #190482;
            /* Morado */
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
            /* Blanco */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #190482;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

    </style>
</head>

<body>
    <nav>
        <div class="brand">
            <img src="../imgs/sombrero.png" alt="Logo de la tienda">
            <h1>Causa-San - Panel de control</h1>
        </div>
        <div class="search-bar">
        </div>
        <ul>
            <li><a href="orders_manager.php">Pedidos</a></li>
            <li><a href="admin.php">Usuarios</a></li>
            <li><a href="Productos.php">Productos</a></li>

        </ul>
        <div class="welcome-user">
        </div>
    </nav>
    <h2 style="text-align: center;">Pedidos</h2>
    <table>
        <tr>
            <th>ID Usuario</th>
            <th>ID Pedido</th>
            <th>Precio Total</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
        <?php
        require_once '../scripts/db.php';

        $sql = "SELECT * FROM detalle_pedidos";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_usuario'] . "</td>";
                echo "<td>" . $row['id_pedido'] . "</td>";
                echo "<td>$" . $row['precio_total'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>";
                if ($row['status'] == 'SIN ENVIAR') {
                    echo "<a href='../scripts/update_status.php?id=" . $row['id_detallepedido'] . "'>Enviar pedido</a>";
                } else {
                    echo "Pedido enviado";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay pedidos registrados</td></tr>";
        }
        ?>
    </table>
</body>

</html>