<?php

//Configurar nuestros datos de conexión a la BD ////////////////////////////////////////

$conexion = mysqli_connect('db','HeatRunner','sv.03/SNG') or die("Error, conexion");
$bd = mysqli_select_db($conexion,'HeatRunner') or die("Error, Base de datos");

?>