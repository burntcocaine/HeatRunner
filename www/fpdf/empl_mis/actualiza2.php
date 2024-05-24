<head>
<title>Actualizar empleados</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS v5.2.1 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

<link rel ="icon" type="image/x-icon" href="favicon.ico">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<?php 

include "../conexion.php";

mysqli_Select_db($conexion, "productosbd");
$empleadoactualizar = $_GET["id"];
$seleccionar = "SELECT * FROM empleados WHERE id='$empleadoactualizar'";
$registros = mysqli_Query($conexion, $seleccionar);
$registro = mysqli_fetch_row($registros);
?>

<div class="container my-5">
    <div class="row">
        <div class="col text-center">

            <div class="card">
                <div class="card-header display-6">
                    Actualización de empleados
                </div>                
            </div>

            <div class="row mt-3 justify-content-md-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> 
                            Ingresar datos:
                        </div>
                        <form class="p-4" method="POST" action="actualiza3.php" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                          <label for="" class="form-label">id</label>
                          <input type="number"
                            class="form-control" name="identificador" id="identificador" autofocus required value="<?php echo $registro[0];?>" aria-describedby="helpId" placeholder="Introduce el id">
                          <small id="helpId" class="form-text text-muted">id</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">id_sede</label>
                          <input type="number"
                            class="form-control" name="id_sede" id="id_sede"  required value="<?php echo $registro[1];?>" aria-describedby="helpId" placeholder="Introduce id_sede">
                          <small id="helpId" class="form-text text-muted">id_sede</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">telefono</label>
                          <input type="number"
                            class="form-control" name="telefono" id="telefono"  required value="<?php echo $registro[2];?>" aria-describedby="helpId" placeholder="Introduce el telefono">
                          <small id="helpId" class="form-text text-muted">telefono</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">direccion</label>
                          <input type="text" class="form-control" name="direccion" id="direccion" required value="<?php echo $registro[3];?>" aria-describedby="helpId" placeholder="Introduce la direccion">
                          <small id="helpId" class="form-text text-muted">direccion</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">salario</label>
                          <input type="number" class="form-control" name="salario" id="salario" required value="<?php echo $registro[4];?>" aria-describedby="helpId" placeholder="Introduce el salario">
                          <small id="helpId" class="form-text text-muted">salario</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">antiguedad</label>
                          <input type="number" class="form-control" name="antiguedad" id="antiguedad" required value="<?php echo $registro[5];?>" aria-describedby="helpId" placeholder="Introduce la antiguedad">
                          <small id="helpId" class="form-text text-muted">antiguedad</small>
                        </div>

                        <div class="mb-3">
                          <label for="" class="form-label">apellidos</label>
                          <input type="text" class="form-control" name="apellidos" id="apellidos" required value="<?php echo $registro[6];?>" aria-describedby="helpId" placeholder="Introduce el apellido">
                          <small id="helpId" class="form-text text-muted">apellidos</small>
                        </div>
                      


                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                        </div>

                        

                        </form>

                    </div>
                </div>

            <a href="actualiza.php"> <i class="bi-arrow-return-left px-3" style="font-size: 4rem; color:black;"></i> </a>
        </div>  
    </div>
</div>




<?php 
include "../footer.php"
?>
