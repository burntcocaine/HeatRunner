<?php 
	/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los vídeos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR MÁS POCO QUE SEA".
	*/
	include_once('conexion.php');
	$ideditar = $_POST['ideditar'];
	$nom_edit = $_POST['nom_edit'];
	$ape_pedit = $_POST['ape_pedit'];
	$ape_medit = $_POST['ape_medit'];
	$edad_edit = $_POST['edad_edit'];
	$dir_edit = $_POST['dir_edit'];
	$dni_edit = $_POST['dni_edit'];
	$sql= "UPDATE usuario SET id=$ideditar, usuario = '$nom_edit', contra='$ape_pedit', 
			estado=$edad_edit, NombreCompleto='$dir_edit', dni='$dni_edit' WHERE id =$ideditar;";
	$res = mysqli_query($conexion,$sql);

	echo "$sql";


	if ( isset($res) )
		echo "Correcto";
	else
		echo "Incorrecto";	
?>

