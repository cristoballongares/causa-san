<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        nav {
            background-color: #190482; /* Morado */
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
            color: #e5e5e5; /* Blanco */
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

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .order-list {
            margin-top: 20px;
        }

        .order-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-info span {
            font-weight: bold;
        }

        .order-status {
            font-style: italic;
            color: #888;
        }
    </style>
</head>

<body>
    <nav>
        <div class="brand">
            <img src="../imgs/sombrero.png" alt="Logo de la tienda">
            <h1>Causa-San</h1>
        </div>
        <div class="search-bar">
        </div>
        <ul>
            <?php
                $user_id = $_GET["id_usuario"];
                $username = $_GET["username"];
            ?>
            <li><a href="../pages/inicio.php?id_usuario=<?php echo $user_id ?>&nombre_usuario=<?php echo $username ?>">Inicio</a></li>
        </ul>
        <div class="welcome-user">
            <?php
                $username = $_GET["username"];
                $user_id = $_GET["id_usuario"];
                echo "<span>Bienvenido, $username</span>";
            ?>
        </div>
    </nav>

    <div class="container">
        <h2>Lista de Pedidos</h2>
        <div class="order-list">
            <?php
                require_once 'db.php';
                $id_usuario = $_GET["id_usuario"];
                $sql = "SELECT * from detalle_pedidos WHERE id_usuario = '$id_usuario'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="order-item">';
                        echo '<div class="order-info">';
                        echo '<span>ID de Pedido: ' . $row['id_pedido'] . '</span>';
                        echo '<span>Precio Total: $' . $row['precio_total'] . '</span>';
                        echo '</div>';
                        echo '<p>Fecha: ' . $row['fecha'] . '</p>';
                        echo '<p class="order-status">Estado: ' . $row['status'] . '</p>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>
</body>

</html>
