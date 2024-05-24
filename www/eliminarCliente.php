<?php  
	/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los vídeos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR MÁS POCO QUE SEA".
	*/
	include_once('conexion.php');
	$idcli=$_POST['idcli'];
	$sql = "UPDATE usuario SET estado=0  WHERE id = $idcli;";// eliminamos cambiando el estado
	$res = mysqli_query($conexion,$sql);

	if ( isset($res) )
		echo "Correcto";
	else
		echo "Incorrecto";
?>
