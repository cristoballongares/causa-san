<?php
require_once 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $municipio = $_POST['municipio'];
    $codigo_postal = $_POST['codigo_postal'];
    $domicilio = $_POST['domicilio'];
    $saldo = $_POST['saldo'];

    $sql = "UPDATE usuarios 
            SET NOMBRE = '$nombre', TELEFONO = '$telefono', correo = '$correo', 
                MUNICIPIO = '$municipio', `CODIGO-POSTAL` = '$codigo_postal', 
                DOMICILIO = '$domicilio', SALDO = '$saldo' 
            WHERE id_usuario = $usuario_id";

    if ($conn->query($sql) === TRUE) {
         header("Location: ../pages/admin.php");
    } else {
        echo "Error al actualizar usuario: " . $conn->error;
    }
}

$conn->close();
?>
