<?php
require_once("db.php");

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $id = $_GET["id"];

    $sql = "SELECT imagen FROM productos WHERE id_producto = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $path = $row["imagen"];

        if (file_exists($path)) {
            unlink($path); 
        }
    
    

    $sql = "DELETE FROM productos WHERE id_producto = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/Productos.php");
        } else {
            echo "Error al eliminar productos: " . $conn->error;
        }
        
    } else {
        echo "ID no valido";
    }
}

$conn->close();
?>
