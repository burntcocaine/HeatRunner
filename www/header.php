<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeatRunner</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <?php
    include_once('conexion.php');
    include_once('obtener_colores.php'); // Asegúrate de que este script calcule y devuelva $colores como un array asociativo

    $sql = "
        SELECT s.NombreSensor, l.ValorLectura, l.FechaLectura
        FROM Sensores s
        JOIN (
            SELECT IdSensor, MAX(FechaLectura) as MaxFecha
            FROM Lecturas
            GROUP BY IdSensor
        ) as max_l
        ON s.Sensor = max_l.IdSensor
        JOIN Lecturas l
        ON s.Sensor = l.IdSensor AND l.FechaLectura = max_l.MaxFecha
    ";

    $resultado = mysqli_query($conexion, $sql);
    $sensores = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $sensores[$fila['NombreSensor']] = $fila['ValorLectura'];
    }

    // Asegúrate de que obtener_colores.php calcule $colores basándose en los sensores disponibles.
    // Añade un color gris por defecto para cualquier habitación sin sensor.
    $colores = [
        'habitacion1-room' => isset($sensores['habitacion1-room']) ? obtenerColorPorTemperatura($sensores['habitacion1-room']) : '#808080',
        'habitacion2-room' => isset($sensores['habitacion2-room']) ? obtenerColorPorTemperatura($sensores['habitacion2-room']) : '#808080',
        'bano-room' => isset($sensores['bano-room']) ? obtenerColorPorTemperatura($sensores['bano-room']) : '#808080',
        'dormitorio-room' => isset($sensores['dormitorio-room']) ? obtenerColorPorTemperatura($sensores['dormitorio-room']) : '#808080',
        'Salon' => isset($colorSalon) ? $colorSalon : '#808080',
        // Añade aquí cualquier otra habitación que necesites con un color por defecto
        'Cocina' => 'grey',
        'Entrada' => 'grey',
        'Balcon' => 'grey',
        'Hall' => 'grey'
    ];
    ?>

    <header>
        <h1>Heat Runner</h1>
        <nav>
            <div class="nav-left">
                <a href="#" class="back-btn"><i class="fas fa-arrow-left"></i></a>
            </div>
            <div class="nav-right">
                <div class="user-info">
                    <div class="avatar-container">
                        <img src="../imagenes/heat_logo.jpg" class="avatar">
                    </div>
                    <span class="username">
                        <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado'; ?>
                    </span>
                    <span class="separator">|</span>
                    <form action="cerrarSesion.php" method="post" style="display:inline;">
                        <button type="submit" class="logout-btn">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>