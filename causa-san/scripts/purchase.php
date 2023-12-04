<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_user']) && isset($_POST['id_product']) && isset($_POST['quantity'])) {
    $user_id = $_POST['id_user'];
    $product_id = $_POST['id_product'];
    $quantity = $_POST['quantity'];
    $username = $_POST['username'];

    $current_date = date("Y-m-d");

    $sql_insert_purchase = "INSERT INTO pedidos (id_usuario, id_producto, total_producto) VALUES ('$user_id', '$product_id', '$quantity')";

    if ($conn->query($sql_insert_purchase) === TRUE) {
        echo "Compra realizada exitosamente";
    } else {
        echo "Error al realizar la compra: " . $conn->error;
    }

    $sql_product = "SELECT * from productos where id_producto = '$product_id'";
    $result = $conn->query($sql_product);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $priceProduct = $row["precio"];
    }

    $total = $priceProduct * $quantity;

    $sql_last_order_id = "SELECT id_pedido FROM pedidos WHERE id_usuario = '$user_id' ORDER BY id_pedido DESC LIMIT 1";
    $result_last_order_id = $conn->query($sql_last_order_id);

    if ($result_last_order_id && $result_last_order_id->num_rows == 1) {
        $row = $result_last_order_id->fetch_assoc();
        $last_order_id = $row['id_pedido'];

        $sql_deteils_purchase = "INSERT INTO detalle_pedidos (id_usuario, id_pedido, precio_total, fecha, status) VALUES ('$user_id', '$last_order_id', '$total', '$current_date', 'SIN ENVIAR')";

        if ($conn->query($sql_deteils_purchase) === TRUE) {
            header("Location: orders.php?id_usuario=$user_id&username=$username");
        } else {
            echo "Error al realizar detalles de la compra: " . $conn->error;
        }

        $sql_update_stock = "UPDATE productos SET stock = stock - $quantity WHERE id_producto = $product_id";

        // Ejecutar la consulta para actualizar el stock del producto
        if ($conn->query($sql_update_stock) === TRUE) {
            header("Location: orders.php?id_usuario=$user_id&username=$username");
        } else {
            echo "Error al quitar producto" . $conn->error;
        }
    } else {
        echo "Error al seleccionar id_pedido";
    }
} else {
    echo "Falta información necesaria para completar la compra.";
}
