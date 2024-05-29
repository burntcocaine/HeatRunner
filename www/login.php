<?php
session_start();
include_once('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $contra = $_POST['contra'];  // No necesitas escapar aquí porque password_verify no ejecuta SQL

    // Añadir depuración para ver valores
   

    $sql = "SELECT * FROM usuario WHERE usuario = ? AND estado = 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();

    if ($fila) {
        // Añadir depuración para ver el hash de la contraseña

        if (password_verify($contra, $fila['contra'])) {
            // Contraseña es correcta
            $_SESSION['usuario'] = $usuario;
            $_SESSION['NombreCompleto'] = $fila['nombre_completo'];
            $_SESSION['dni'] = $fila['dni'];

            if ($usuario === 'admin') {
                header('Location: principal.php');
            } else {
                header('Location: vivienda.php');
            }
            exit;
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado o inactivo
        echo "Usuario no encontrado o inactivo.";
    }

    $stmt->close();
    $conexion->close();
}
?>
