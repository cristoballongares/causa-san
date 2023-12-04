<?php
require_once("db.php");

$targetDirectory = "../imgs/";
$targetFile = $targetDirectory . basename($_FILES["imagen"]["name"]);
$uploadOk = 1;
$targetFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $categoria = $_POST["categoria"];


    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $subidaOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $subidaOk = 0;
    }

    if (file_exists($targetFile)) {
        echo "Lo siento, el archivo ya existe.";
        $subidaOk = 0;
    }

    if ($_FILES["imagen"]["size"] > 500000) {
        echo "Lo siento, el archivo es muy grande.";
        $subidaOk = 0;
    }

    if ($targetFileType != "jpg" && $targetFileType != "png" && $targetFileType != "jpeg" && $targetFileType != "gif") {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $subidaOk = 0;
    }

    if ($subidaOk == 0) {
        echo "Lo siento, tu archivo no fue cargado.";
    } else {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
            echo "El archivo " . basename($_FILES["imagen"]["name"]) . " ha sido cargado.";

            $path = "../imgs/" . basename($_FILES["imagen"]["name"]);

            $sql = "INSERT into productos (NOMBRE, STOCK, PRECIO, CATEGORIA, imagen)
            VALUES ('$nombre', '$stock', '$precio', '$categoria', '$path')";

            if ($conn->query($sql) === TRUE) {
                echo "Producto añadido correctamente";
                header("location: ../pages/Productos.php");
            } else {
                echo "Error al registrar producto" . $conn->error;
            }
        }
    }
}

$conn->close();
