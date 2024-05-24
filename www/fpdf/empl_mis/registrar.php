<?php include "../conexion.php";?>
<?php
    mysqli_select_db($conexion, "productosbd");
    $id = $_POST["id"];
    $id_sede = $_POST["id_sede"];
    /*$talla = $_POST["talla"];*/
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $salario = $_POST["salario"];
    $antiguedad = $_POST["antiguedad"];
    $apellidos = $_POST['apellidos'];
   

    $insertar = "INSERT empleados (id, id_sede, telefono, direccion, salario, antiguedad, apellidos) VALUES ($id, $id_sede, $telefono, '$direccion', $salario , $antiguedad, '$apellidos')";
    //echo $insertar;
    mysqli_query($conexion, $insertar);
    header("Location:alta_ok.php");?>