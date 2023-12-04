<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/5f23435a63.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Document</title>
</head>
<body>

    <section>
        <div class="contenedor">
            <div class="fromulario">
                <form action="../scripts/validate_login.php" method="post">
                    <h2>Bienvenido</h2>

                    <div class="input-contenedor">
                        <i class="fa-solid fa-envelope"></i>
                        <input name="email"type="email" required>
                        <label name="email" for="email">Email</label>
                    </div>

                    <div class="input-contenedor">
                        <i class="fa-solid fa-lock"></i>
                        <input name="password" type="password" required>
                        <label name ="password "for="password">Contraseña</label>
                    </div>

                    <div class="olvidar">
                        <label for="#">
                        </label>
                    </div>

                <div>
                    <button>Acceder</button>
                </form>

                    <div class="registrar">
                        <p>No tengo cuenta <a href="register.html">Crea una</a></p>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php
session_start();

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    echo "<script>alert('$error_message');</script>";
    unset($_SESSION['error_message']); 
}
?>