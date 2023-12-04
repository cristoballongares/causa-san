<?php
require_once 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $municipio = $_POST['municipio'];
    $codigo_postal = $_POST['codigo_postal'];
    $domicilio = $_POST['domicilio'];

    $sql = "INSERT INTO usuarios (nombre_usuario, telefono, correo, password, municipio, cp, domicilio, saldo) 
            VALUES ('$nombre', '$telefono', '$correo', '$password', '$municipio', '$codigo_postal', '$domicilio', 0)";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../pages/login.php");
    } else {
        echo "Error al registrar usuario: " . $conn->error;
    }
}

$conn->close();
?>
