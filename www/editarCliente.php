<?php 
include_once('conexion.php');

$idEditar = $_POST['idEditar'];
$nom_edit = $_POST['nom_edit'];
$contra_edit = $_POST['contra_edit']; // Campo para la nueva contraseña
$estado_edit = $_POST['estado_edit'];
$nombre_completo_edit = $_POST['nombre_completo_edit'];
$dni_edit = $_POST['dni_edit'];
$correo_electronico_edit = $_POST['correo_electronico_edit'];
$fecha_nacimiento_edit = $_POST['fecha_nacimiento_edit'];
$pais_edit = $_POST['pais_edit'];
$genero_edit = $_POST['genero_edit'];
$telefono_edit = $_POST['telefono_edit'];
$rol_edit = $_POST['rol_edit'];
$biografia_edit = $_POST['biografia_edit'];
$avatar_edit = $_POST['avatar_edit'];

// Construir la consulta SQL
$sql = "UPDATE usuario SET
            usuario = '$nom_edit',
            estado = '$estado_edit',
            nombre_completo = '$nombre_completo_edit',
            dni = '$dni_edit',
            correo_electronico = '$correo_electronico_edit',
            fecha_nacimiento = '$fecha_nacimiento_edit',
            pais = '$pais_edit',
            genero = '$genero_edit',
            telefono = '$telefono_edit',
            rol = '$rol_edit',
            biografia = '$biografia_edit',
            avatar = '$avatar_edit'";

// Cifrar la contraseña si se proporciona una nueva
if (!empty($contra_edit)) {
    $contra_cifrada = password_hash($contra_edit, PASSWORD_BCRYPT);
    $sql .= ", contra = '$contra_cifrada'";
}

$sql .= " WHERE id = '$idEditar'";

$res = mysqli_query($conexion, $sql);

if ($res) {
    echo "Correcto";
} else {
    echo "Incorrecto";
}

?>
