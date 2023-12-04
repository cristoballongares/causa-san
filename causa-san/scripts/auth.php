<?php
function validateCredentials($mail, $password) {
    global $conn;

    $mail = mysqli_real_escape_string($conn, $mail);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM usuarios WHERE MAIL = '$mail' AND PASS = '$password'";
    $result = $conn->query($sql);

    return ($result->num_rows > 0);
}
?>



