<?php 
include "../conexion.php";

mysqli_Select_db($conexion, "productosbd");

$empleadosborrar = $_GET["id"];
$borrar="DELETE FROM empleados WHERE id = '$empleadosborrar'";
mysqli_Query($conexion, $borrar);
header("Location: baja_ok.php");
?>