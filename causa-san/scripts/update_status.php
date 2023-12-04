<?php
require_once("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "UPDATE detalle_pedidos
            SET status = 'Enviado'
            WHERE id_detallepedido = '$id'";

    if ($conn->query($sql)) {
        header("Location: ../pages/orders_manager.php");
        exit(); 
    } else {
        echo "Error " . $conn->error;
    }
} else {
    echo "ID de detalle de pedido no especificado";
}
?>
