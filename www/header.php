<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeatRunner</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    
    <?php include 'menu_temperaturas.php'; ?>
    
    <header>
    <a href="vivienda.php" id=""><h1>Heat Runner</h1></a>
        <ul class="menu-temperaturas">
        <?php
        // Mostrar temperaturas de habitaciones con resultados
        if (isset($sensores['habitacion1-room'])) {
            echo '<li><span class="nombre-habitacion">Habitación 1:</span><span class="temperatura">' . $sensores['habitacion1-room'] . '°C</span></li>';
        }
        if (isset($sensores['habitacion2-room'])) {
            echo '<li><span class="nombre-habitacion">Habitación 2:</span><span class="temperatura">' . $sensores['habitacion2-room'] . '°C</span></li>';
        }
        if (isset($sensores['bano-room'])) {
            echo '<li><span class="nombre-habitacion">Baño:</span><span class="temperatura">' . $sensores['bano-room'] . '°C</span></li>';
        }
        if (isset($sensores['dormitorio-room'])) {
            echo '<li><span class="nombre-habitacion">Dormitorio:</span><span class="temperatura">' . $sensores['dormitorio-room'] . '°C</span></li>';
        }
        // Mostrar temperatura media del Salón
        echo '<li><span class="nombre-habitacion">Salón:</span><span class="temperatura">' . $temperaturaMediaSalon . '°C</span></li>';
        ?>
    </ul>
    </header>