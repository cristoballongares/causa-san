<?php

require_once("db.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["email"];
    $password = $_POST["password"];

    // Consulta SQL para obtener los datos del usuario
    $sql = "SELECT id_usuario ,correo, password, nombre_usuario FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        if ($password === $stored_password) {
            $nombre_usuario = $row["nombre_usuario"]; 
            $id_usuario = $row["id_usuario"];
            header("Location: ../pages/inicio.php?nombre_usuario=$nombre_usuario&id_usuario=$id_usuario");
            exit();
        } else {

            session_start();
            $_SESSION['error_message'] = 'Usuario incorrecto. Por favor, inténtalo de nuevo.';
            header("Location: ../pages/login.php");
            exit();
        }
    } else {
        session_start();
        $_SESSION['error_message'] = 'Contraseña incorrecta. Por favor, inténtalo de nuevo.';
    header("Location: ../pages/login.php");
        exit();
    }
}

$conn->close();
?>
