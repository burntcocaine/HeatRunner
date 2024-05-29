<?php
include_once('conexion.php');

$sql = "SELECT id, contra FROM usuario";
$result = mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $contra = $row['contra'];

    // Cifrar la contraseña si aún no está cifrada
    if (password_needs_rehash($contra, PASSWORD_BCRYPT)) {
        $contra_cifrada = password_hash($contra, PASSWORD_BCRYPT);
        $update_sql = "UPDATE usuario SET contra = ? WHERE id = ?";
        $stmt = $conexion->prepare($update_sql);
        $stmt->bind_param("si", $contra_cifrada, $id);
        $stmt->execute();
        $stmt->close();
    }
}

$conexion->close();
?>
