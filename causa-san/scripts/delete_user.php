<?php
require_once("db.php");

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $id_usuario = $_GET["id"];

    $sql = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";


        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/admin.php");
        } else {
            echo "Error al eliminar usuario: " . $conn->error;
        }
        
    } else {
        echo "Parámetros no válidos";
    }


$conn->close();
?>
