<?php 
	/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los vídeos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR MÁS POCO QUE SEA".
	*/
	include_once('conexion.php');

	$ideditar = $_POST['ideditar'];
	$nom_edit = $_POST['nom_edit'];
	$contra = $_POST['contra'];
	$estado = $_POST['estado'];
	$NombreCompleto = $_POST['NombreCompleto'];
	$dni_edit = $_POST['dni_edit'];

	$sql= "UPDATE usuario SET id=$ideditar, usuario='$nom_edit', contra='$contra', estado=$estado, NombreCompleto='$NombreCompleto', dni='$dni_edit' WHERE id =$ideditar;";
	$res = mysqli_query($conexion,$sql);
	
	echo "$sql";

	var_dump($_POST);

	if ( isset($res) )
		echo "Correcto";
	else
		echo "Incorrecto";	
?>

