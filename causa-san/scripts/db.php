<?php
$servername = "localhost";
$username = "root";
$password = '';  // Corregido aquí
$dbname = 'causa-san';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de la conexión: " . $conn->connect_error);
}
?>
