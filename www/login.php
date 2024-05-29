<?php
session_start();
include_once('conexion.php');

$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$contra = mysqli_real_escape_string($conexion, $_POST['contra']);

$sql = "SELECT * FROM usuario WHERE usuario = ? AND estado = 1";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();

if ($fila) {
    if (password_verify($contra, $fila['contra'])) {
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
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado o inactivo.";
}

$stmt->close();
$conexion->close();
?>



