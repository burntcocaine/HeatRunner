<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: vivienda.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heat Runner - Inicio de sesión</title>
    <link rel="stylesheet" href="../css/estilo_login.css">
</head>
<body>
    <div class="login_container">
        <h1 class="login_title">Heat Runner</h1>

        <form action="login.php" method="post" class="login_form">
            <input type="text" name="usuario" placeholder="Usuario" class="login_input" required>
            <input type="password" name="contra" placeholder="Contraseña" class="login_input" required>

            <button type="submit" class="login_button">Iniciar sesión</button>
        </form>

    </div>
</body>
</html>
