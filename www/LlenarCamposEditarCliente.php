<?php
include_once('conexion.php');

header('Content-Type: application/json');

$id = $_GET['id'];

$response = array('success' => false, 'data' => null, 'message' => '');

if (isset($id) && is_numeric($id)) {
    $sql = "SELECT * FROM usuario WHERE id = $id";
    $res = mysqli_query($conexion, $sql);

    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            $cliente = mysqli_fetch_assoc($res);
            $response['success'] = true;
            $response['data'] = $cliente;
        } else {
            $response['message'] = 'Usuario no encontrado';
        }
    } else {
        $response['message'] = 'Error en la consulta SQL';
    }
} else {
    $response['message'] = 'ID inválido';
}

echo json_encode($response);
?>
