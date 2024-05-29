<?php
include_once('conexion.php');

$id = $_POST['id'];

$sql = "DELETE FROM usuario WHERE id = $id";
$res = mysqli_query($conexion, $sql);

if ($res) {
    echo "Usuario eliminado correctamente.";
} else {
    echo "Error al eliminar el usuario.";
}
?>
