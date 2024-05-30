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
$max_avatar_size = 16777215; // 16 MB, que es el límite para MEDIUMBLOB

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
    if ($_FILES['avatar']['size'] <= $max_avatar_size) {
        $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
    } else {
        die("El archivo de avatar es demasiado grande. El tamaño máximo permitido es 16 MB.");
    }
}

// Cifrar la contraseña con bcrypt si se proporciona
if (!empty($contra)) {
    $contra_cifrada = password_hash($contra, PASSWORD_BCRYPT);
} else {
    $contra_cifrada = null;
}

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

    $params = [$nombre, $estado, $NombreCompleto, $dni, $correo_electronico, $fecha_nacimiento, $pais, $genero, $telefono, $rol, $biografia];

    if ($contra_cifrada) {
        $sql .= ", contra = ?";
        $params[] = $contra_cifrada;
    }

    if ($avatar) {
        $sql .= ", avatar = ?";
        $params[] = $avatar;
    }

    $sql .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $conexion->prepare($sql);

    // Generar la cadena de tipos para bind_param
    $types = str_repeat("s", count($params) - 1) . "i";
    $stmt->bind_param($types, ...$params);
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
