<?php

//Configurar nuestros datos de conexión a la BD ////////////////////////////////////////

$conexion = mysqli_connect('localhost','admin','bdfoundation') or die("Error, conexion");
$bd = mysqli_select_db($conexion,'productosbd') or die("Error, Base de datos");

?>