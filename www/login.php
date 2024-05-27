<?php


session_start();
include_once('conexion.php');

$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$contra = mysqli_real_escape_string($conexion, $_POST['contra']);

$sql = "SELECT * FROM usuario WHERE usuario=? AND contra=? AND estado=1";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $usuario, $contra);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();

if ($fila) {
    $consultaUsuario = "SELECT nombre_completo, dni FROM usuario WHERE usuario='$usuario'";
    $resUsuario = mysqli_query($conexion, $consultaUsuario);
    $rowUsuario = mysqli_fetch_array($resUsuario);

    $_SESSION['usuario'] = $usuario;
    $_SESSION['NombreCompleto'] = $rowUsuario[0];
    $_SESSION['dni'] = $rowUsuario[1];

    if ($usuario === 'admin') {
        header('Location: principal.php');
    } else {
        header('Location: vivienda.php');
    }
} else {
    echo "Usuario o contraseña incorrectos";
}
?>
