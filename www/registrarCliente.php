<?php
include_once('conexion.php');

$id = $_POST['id'];
$is_edit = $_POST['is_edit'];
$nombre = $_POST['nombre'];
$contra = $_POST['contra'];
$estado = $_POST['estado'];
$NombreCompleto = $_POST['NombreCompleto'];
$dni = $_POST['dni'];
$correo_electronico = $_POST['correo_electronico'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$pais = $_POST['pais'];
$genero = $_POST['genero'];
$telefono = $_POST['telefono'];
$rol = $_POST['rol'];
$biografia = $_POST['biografia'];

// Manejo del archivo de avatar
$avatar = null;
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
    $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
}

// Cifrar la contraseña con bcrypt si se proporciona
$contra_cifrada = !empty($contra) ? password_hash($contra, PASSWORD_BCRYPT) : null;

if ($is_edit == 1 && !empty($id)) {
    // Actualizar el usuario existente
    $sql = "UPDATE usuario SET
                usuario = ?,
                estado = ?,
                nombre_completo = ?,
                dni = ?,
                correo_electronico = ?,
                fecha_nacimiento = ?,
                pais = ?,
                genero = ?,
                telefono = ?,
                rol = ?,
                biografia = ?";
                
    if ($contra_cifrada) {
        $sql .= ", contra = ?";
    }
    
    if ($avatar) {
        $sql .= ", avatar = ?";
    }
    
    $sql .= " WHERE id = ?";
    
    $stmt = $conexion->prepare($sql);
    
    if ($contra_cifrada && $avatar) {
        $stmt->bind_param("sissssssssssi", $nombre, $estado, $NombreCompleto, $dni, $correo_electronico, $fecha_nacimiento, $pais, $genero, $telefono, $rol, $biografia, $contra_cifrada, $avatar, $id);
    } elseif ($contra_cifrada) {
        $stmt->bind_param("sisssssssssi", $nombre, $estado, $NombreCompleto, $dni, $correo_electronico, $fecha_nacimiento, $pais, $genero, $telefono, $rol, $biografia, $contra_cifrada, $id);
    } elseif ($avatar) {
        $stmt->bind_param("sisssssssssbi", $nombre, $estado, $NombreCompleto, $dni, $correo_electronico, $fecha_nacimiento, $pais, $genero, $telefono, $rol, $biografia, $avatar, $id);
    } else {
        $stmt->bind_param("sisssssssssi", $nombre, $estado, $NombreCompleto, $dni, $correo_electronico, $fecha_nacimiento, $pais, $genero, $telefono, $rol, $biografia, $id);
    }
} else {
    // Insertar un nuevo usuario
    $sql = "INSERT INTO usuario (usuario, contra, estado, nombre_completo, dni, correo_electronico, fecha_nacimiento, pais, genero, telefono, rol, biografia, avatar)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssissssssssss", $nombre, $contra_cifrada, $estado, $NombreCompleto, $dni, $correo_electronico, $fecha_nacimiento, $pais, $genero, $telefono, $rol, $biografia, $avatar);
}

$res = $stmt->execute();

if ($res) {
    echo "correcto";
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
