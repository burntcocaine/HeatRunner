<?php 
	include_once('conexion.php');

	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$contra = $_POST['contra'];
	$estado = $_POST['estado'];
	$NombreCompleto = $_POST['NombreCompleto'];
	$dni = $_POST['dni'];
 
	$sql = "INSERT INTO usuario (id, usuario, contra, estado, NombreCompleto, dni) 
				VALUES ($id, '$nombre', '$contra', 1, '$NombreCompleto', '$dni');";
	$res = mysqli_query($conexion, $sql);
	if ($res) {
		echo "correcto";
	} else {
		echo "error";
	}
?>
