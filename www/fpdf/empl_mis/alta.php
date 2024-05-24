<?php 
/* *********************************************************************** */
/* *********************  ******************  **************************** */
/* **************** Listado de productos en la BD ************************ */
/* *********************************************************************** */
session_start();
$usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
      header("Location: index.php");
        exit;
    }

include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Administracion BD Productos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/uniform.default.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/select2.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/bootstrap.datepicker.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/compiled/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=OpenSans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel ="icon" type="image/x-icon" href="favicon.ico">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
    <!-- navbar -->
<header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">            
            <a class="navbar-brand" href="menu.php">
            <img src="/imagenes/logosolo.png" class="logo" alt="logo" width="65" height="65" />Foundation Administracion
            </a>
        </div>
        <ul class="nav navbar-nav pull-right hidden-xs">                       
            <li class="notification-dropdown hidden-xs hidden-sm">
                <a href="#" class="trigger">
                    <i class="icon-user"></i>
                </a>
                <div class="pop-dialog">                    
                </div>
            </li>
            <li class="dropdown open">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    Bienvenido<?php echo ": ".$_SESSION['NombreCompleto']."<br>"."con DNI: ".$_SESSION['dni'] ?>
                </a>                
            </li>             
            <li class="settings hidden-xs hidden-sm">
                <a href="../cerrarSesion.php" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>


</header>

<div class="container my-5">
    <div class="row">
        <div class="col text-center">

            <div class="card">
                <div class="card-header display-6">
                    Alta de un empleados
                </div>                
            </div>

            <div class="row mt-3 justify-content-md-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> 
                            Ingresar datos:
                        </div>
                        <form class="p-4" method="POST" action="registrar.php" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                          <label for="" class="form-label">id</label>
                          <input type="number"
                            class="form-control" name="id" id="id" autofocus required aria-describedby="helpId" placeholder="Introduce el ID">
                          <small id="helpId" class="form-text text-muted">id</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">id_sede</label>
                          <input type="number"
                            class="form-control" name="id_sede" id="id_sede"  required aria-describedby="helpId" placeholder="Introduce id_sede">
                          <small id="helpId" class="form-text text-muted">id_sede</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">telefono</label>
                          <input type="number"
                            class="form-control" name="telefono" id="telefono" required aria-describedby="helpId" placeholder="Introduce el telefono">
                          <small id="helpId" class="form-text text-muted">telefono</small>
                        </div>
                      
                        <div class="mb-3">
                          <label for="" class="form-label">direccion</label>
                          <input type="text"
                            class="form-control" name="direccion" id="direccion" required aria-describedby="helpId" placeholder="Introduce la direccion">
                          <small id="helpId" class="form-text text-muted">direccion</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">salario</label>
                          <input type="number"
                            class="form-control" name="salario" id="salario"  required aria-describedby="helpId" placeholder="Introduce el salario">
                          <small id="helpId" class="form-text text-muted">salario</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">antiguedad</label>
                          <input type="number"
                            class="form-control" name="antiguedad" id="antiguedad" required aria-describedby="helpId" placeholder="Introduce la antiguedad">
                          <small id="helpId" class="form-text text-muted">antiguedad</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">apellidos</label>
                          <input type="text"
                            class="form-control" name="apellidos" id="apellidos" required aria-describedby="helpId" placeholder="Introduce los apellidos">
                          <small id="helpId" class="form-text text-muted">apellidos</small>
                        </div>
                      

                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary" value="Dar de alta">
                        </div>

                        

                        </form>

                    </div>
                </div>

            <a href="http://www.foundation.asix/empleados/empleados.php"> <i class="bi-arrow-return-left px-3" style="font-size: 4rem; color:black;"></i> </a>
        </div>  
    </div>
</div>




<?php 
include "../footer.php"
?>
