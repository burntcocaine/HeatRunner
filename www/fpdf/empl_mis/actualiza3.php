<?php include "../conexion.php";?>
<?php
    
    $idm = $_POST["identificador"];
    //$nombreantiguo = $_GET["nombreimagen"];

    mysqli_select_db($conexion, "productosbd");
    $identificador = $_POST["identificador"];
    $id_sede = $_POST["id_sede"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $salario = $_POST["salario"];
    $antiguedad = $_POST["antiguedad"];
    $empleados = $_POST["empleados"];
    $apellidos = $_POST["apellidos"];
    //var_dump ($_FILES['imagen']);
    /*
    $directorioSubida = "imagenes/";
    $max_file_size="5120000";
    $extensionesValidas=array("jpg","png","gif");
    
    if($_FILES['imagen']['name'] != ""){
        $errores=0;
        $nombreArchivo = $_FILES['imagen']['name'];
        $filesize = $_FILES['imagen']['size'];
        $directorioTemp = $_FILES['imagen']['tmp_name'];
        $tipoArchivo = $_FILES['imagen']['type'];
        $arrayArchivo = pathinfo ($nombreArchivo);
        $extension = $arrayArchivo['extension'];

       
        if(!in_array($extension, $extensionesValidas)) {
            echo "Extensión no válida";
            $errores=1;
        }
        if($filesize > $max_file_size){
            echo "La imagen debe de tener un tamaño inferior";
            $errores= 1;
        }

        if ($errores == 0 ){

            $nombreCompleto = $directorioSubida.$nombreArchivo;
            //echo "Miguel: " . $nombreCompleto;
            move_uploaded_file($directorioTemp, $nombreCompleto);
        }
    }*/
    $insertar = "UPDATE empleados SET id=$identificador, id_sede='$id_sede', telefono='$telefono', direccion='$direccion', salario='$salario', antiguedad='$antiguedad', apellidos='$apellidos' WHERE id='$idm'";
    //echo $insertar;
    /*if($_FILES['imagen']['name'] != ""){
    }
    else{
        $insertar = "UPDATE cliente SET idcliente=$identificador, nombre='$nombre', ape_paterno = '$ape_paterno', edad = $edad, direccion = '$direccion', dni = '$dni' , telefono = $telefono WHERE idcliente='$idm'";
    }*/

    //echo $insertar
    mysqli_query($conexion, $insertar);
    header("Location:actualiza_ok.php");
    ?>
