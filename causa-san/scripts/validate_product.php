<?php
require_once("db.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];
    $nombre = $_POST["nombre"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $categoria = $_POST["categoria"];

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
        $fileName = $_FILES["imagen"]["name"];
        $rute = $_FILES["imagen"]["tmp_name"];
        $path = "../imgs/" . $fileName;

        if (move_uploaded_file($rute, $path)) {

            $sql = "UPDATE productos
            SET NOMBRE = '$nombre', STOCK = '$stock', PRECIO = '$precio', CATEGORIA = '$categoria', imagen = '$path'
            WHERE id_producto = $id_producto;
    
            ";
        } else {
            echo "Error al mover la imagen.";
            exit();
        }
    } else {
        $sql = "UPDATE productos
                SET NOMBRE = '$nombre', STOCK = '$stock', PRECIO = '$precio', categoria = '$categoria', imagen = '$path'
                WHERE id_producto = $id_producto;";
    }
}

if ($conn->query($sql) === TRUE) {
    header("Location: ../pages/Productos.php");
} else {
    echo "Error al editar producto" . $conn->error;
}



$conn->close();
