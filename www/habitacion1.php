<?php  
	/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los v�deos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR M�S POCO QUE SEA".
	*/
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: index.php");
        exit;
    }
?> 

<?php include 'header.php'; ?>
<?php include 'main.php'; ?>



    <div class="contenido-principal">
        <div class="nombre-habitacion">
            <h2>Nombre de la Habitación</h2>
        </div>
        <div class="registros">
            <!-- Aquí se mostrarán los registros en el futuro -->
        </div>
    </div>

<?php include 'footer.php'; ?>

<?php session_destroy();  ?>
