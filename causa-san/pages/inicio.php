<?php
require_once("../scripts/db.php");

$productos_html_default = ""; 
$productos_html_busqueda = ""; 

$sql_default = "SELECT * FROM productos"; 
$resultado_default = $conn->query($sql_default);

if ($resultado_default->num_rows > 0) {
    while ($row_default = $resultado_default->fetch_assoc()) {
        $productos_html_default .= "
            <div class='producto'>
                <img src='{$row_default['imagen']}'>
                <h3>{$row_default['nombre']}</h3>
                <p>Precio: {$row_default['precio']}</p>
                <p>Categoría: {$row_default['categoria']}</p>
                <button class='comprar-btn' data-product-id='{$row_default['id_producto']}'>Comprar</button>
                </div>
        ";
    }
} else {
    $productos_html_default = "<p>No hay productos disponibles</p>";
}

if (isset($_POST["product"])) {
    $product = $_POST["product"];

    $sql = "SELECT * FROM productos WHERE nombre LIKE '$product%'";
    $resultado = $conn->query($sql);
    $user_id = $_GET["id_usuario"] ;
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $productos_html_busqueda .= "
                <div class='producto'>
                    <img src='{$row['imagen']}'>
                    <h3>{$row['nombre']}</h3>
                    <p>Precio: {$row['precio']}</p>
                    <p>Categoría: {$row['categoria']}</p>
                    <button class='comprar-btn' data-product-id='{$row['id_producto']}'>Comprar</button>
                    </div>
            ";

            $productos_html_default = ""; 
        }
    } else {
        $productos_html_busqueda = "<p>No se encontraron productos</p>";
        $productos_html_default = ""; 
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <style>
         body {
            margin: 0;
            font-family: Arial, sans-serif;
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
        .title {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
        }

        /* Estilos para los productos */
        .productos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .producto {
            width: 200px;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .producto img {
            width: 100%;
            height: auto;
        }
        .producto h3 {
            margin-top: 10px;
            font-size: 18px;
        }
        .producto p {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .producto button {
            padding: 8px 16px;
            background-color: #6f42c1;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .producto button:hover {
            background-color: #5a2d9d;
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
        <form action="" method="post">
        <input name="product" type="text" placeholder="Buscar productos...">
        </form>
    </div>
    <ul>
    <?php
        $user_id = $_GET["id_usuario"] ;
        $usernamee = $_GET["nombre_usuario"] ;
    ?>

        <li><a href="../scripts/orders.php?id_usuario=<?php echo $user_id ?>&username=<?php echo $usernamee ?>">Ver pedidos</a></li>
    </ul>
    <div class="welcome-user">
    <?php
    $username = $_GET["nombre_usuario"] ;
    $user_id = $_GET["id_usuario"] ;
    echo"<span>Bienvenido, $username</span>";
?>
        
    </div>
</nav>

<h1 class="title">Causa-San</h1>


<div class="productos-container">
    <?php  
        echo $productos_html_default;
        echo $productos_html_busqueda;
 ?>
</div>

</body>
</html>


<script>
    const username = '<?php echo $_GET["nombre_usuario"]; ?>';

    // Script para el botón de compra
    const buttons = document.querySelectorAll('.comprar-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');

            const userId = <?php echo $_GET["id_usuario"]; ?>;

            window.location.href = `view_product.php?id_usuario=${userId}&id_producto=${productId}&username=${username}`;
        });
    });
</script>
