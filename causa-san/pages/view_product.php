    <?php
    require_once("../scripts/db.php");

    if (isset($_GET['id_usuario']) && isset($_GET['id_producto'])) {
        $user_id = $_GET['id_usuario'];
        $product_id = $_GET['id_producto'];

        $sql = "SELECT * FROM productos WHERE id_producto = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $productData = $result->fetch_assoc();
    ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Detalles del Producto</title>
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

                    .title {
                        text-align: center;
                        margin-top: 20px;
                        font-size: 24px;
                    }

                    .container {
                        width: 80%;
                        margin: 0 auto;
                        padding: 20px;
                        text-align: center;
                    }

                    .product-info img {
                        max-width: 300px;
                        border-radius: 15px;

                        height: auto;
                    }

                    .details {
                        border: 3px solid #1b8798;
                        border-radius: 15px;
                        display: flex;
                    }

                    .description {
                        text-align: left;
                        margin: 23px auto;
                    }

                    .btn-comprar {
                        display: block;
                        padding: 20px 20px 20px 20px;
                        text-align: center;
                        background-color: #4caf50;
                        color: #fff;
                        text-decoration: none;
                        border-radius: 4px;
                        transition: background-color 0.3s ease;
                        margin: 70px auto 0;
                        border: none;

                    }

                    .btn-comprar:hover {
                        background-color: #357a38;
                    }

                    .price {
                        text-align: center;
                        border-bottom: 2px solid;
                        font-size: 25px;
                    }

                    .title {
                        border: 3px solid #57A8E7;
                        border-radius: 15PX;
                        background-color: rgba(27, 135, 152, 0.3);
                        padding: 15px;
                        width: 140px;
                        text-align: center;
                        justify-content: center;
                        margin: 0 auto 20px;
                    }

                    .quantity-selector {
                        margin-top: 20px;
                    }

                    .quantity-selector label {
                        font-weight: bold;
                    }

                    .quantity-selector input {
                        width: 50px;
                        margin-right: 10px;
                        padding: 5px;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        text-align: center;
                    }
                </style>
            </head>

            <body>
                    <form action="../scripts/purchase.php" method="post">
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

                        <li><a href="../scripts/orders.php?id_usuario=<?php echo $user_id ?>&username=<?php echo $username ?>">Ver pedidos</a></li>
                    </ul>
                    <div class="welcome-user">
                        <?php
                        $username = $_GET["username"];
                        $user_id = $_GET["id_usuario"];
                        $product_id = $_GET["id_producto"];
                        echo "<span>Bienvenido, $username</span>";
                        ?>

                    </div>
                </nav>


                <div class="container">
                    <div class="product-info">
                        <h2 class="title" style="text-align: center;"><?php echo $productData['nombre']; ?></h2>
                        <div class="details">
                            <img src="<?php echo $productData['imagen']; ?>">
                            <div class="description">
                                <p class="price"><strong>Precio:</strong> $<?php echo $productData['precio']; ?></p>
                                <p><strong>Categoría:</strong> <?php echo $productData['categoria']; ?></p>
                                <div class="quantity-selector">
                                    <label for="quantity">Cantidad:</label>
                                    <input type="number" id="quantity" name="quantity" min="1" value="1">
                                </div>
                                <input type="hidden" name="id_user" value="<?php echo $user_id ?>">
                                <input type="hidden" name="id_product" value="<?php echo $product_id ?>">
                                <input type="hidden" name="username" value="<?php echo $username ?>">
                                <button class="btn-comprar">Comprar</button>

                            </div>
                        </div>
                    </div>
                </div>
                </form>
                </div>

            </body>

            </html>
    <?php
        } else {
            echo "Producto no encontrado.";
        }
    } else {
        echo "Falta el ID de usuario o ID de producto.";
    }
    ?>