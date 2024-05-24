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

    <main>
        <div class="menu-temperaturas">
            <?php include 'menu_temperaturas.php'; ?>
            <?php
            // Mostrar la temperatura de cada sensor disponible
            foreach ($sensores as $nombreSensor => $temperatura) {
                $nombreBonito = isset($nombresBonitos[$nombreSensor]) ? $nombresBonitos[$nombreSensor] : $nombreSensor;
                echo '<li><span class="nombre-habitacion">' . $nombreBonito . ':</span><span class="temperatura">' . $temperatura . '°C</span></li>';
            }
            ?>
        </div>

        <div class="plano-casa">
            <div class="vivienda-container">
                <div class="vivienda">
                    <!-- Coloca los enlaces a las diferentes páginas para cada habitación -->
                    <a href="cocina.php" id="cocina-link"><div id="cocina-room" class="room cocina" style="background-color: <?php echo $colores['Cocina']; ?>;">Cocina</div></a>
                    <a href="entrada.php" id="entrada-link"><div id="entrada-room" class="room entrada" style="background-color: <?php echo $colores['Entrada']; ?>;">Entrada</div></a>
                    <a href="salon.php" id="salon-link"><div id="salon-room" class="room salon" style="background-color: <?php echo $colores['Salon']; ?>;">Salón</div></a>
                    <a href="habitacion1.php" id="habitacion1-link"><div id="habitacion1-room" class="room habitacion1" style="background-color: <?php echo $colores['habitacion1-room']; ?>;">Habitación 1</div></a>
                    <a href="habitacion2.php" id="habitacion2-link"><div id="habitacion2-room" class="room habitacion2" style="background-color: <?php echo $colores['habitacion2-room']; ?>;">Habitación 2</div></a>
                    <a href="dormitorio.php" id="dormitorio-link"><div id="dormitorio-room" class="room dormitorio" style="background-color: <?php echo $colores['dormitorio-room']; ?>;">Dormitorio</div></a>
                    <a href="balcon.php" id="balcon-link"><div id="balcon-room" class="room balcon" style="background-color: <?php echo $colores['Balcon']; ?>;">Balcón</div></a>
                    <a href="bano.php" id="bano-link"><div id="bano-room" class="room bano" style="background-color: <?php echo $colores['bano-room']; ?>;">Baño</div></a>
                    <a href="hall.php" id="hall-link"><div id="hall-room" class="room hall" style="background-color: <?php echo $colores['Hall']; ?>;">Hall</div></a>
                </div>
            </div>
        </div>

        <div class="controles-vivienda">
            <div class="escala-temperatura">
                <h2>Escala de temperatura</h2>
                <ul>
                    <li><span class="color" style="background-color:#FF0000;"></span>30°C o más</li>
                    <li><span class="color" style="background-color:#FFA500;"></span>25°C - 29°C</li>
                    <li><span class="color" style="background-color:#FFFF00;"></span>20°C - 24°C</li>
                    <li><span class="color" style="background-color:#C0C0C0;"></span>15°C - 19°C</li>
                    <li><span class="color" style="background-color:#808080;"></span>10°C o menos</li>
                </ul>
            </div>
            <div class="desactivar">
                <h2>Desactivar habitaciones</h2>
                <button class="desact" id="btnCocina">Cocina</button>
                <button class="desact" id="btnEntrada">Entrada</button>
                <button class="desact" id="btnSalon">Salón</button>
                <button class="desact" id="btnHabitacion1">Habitación 1</button>
                <button class="desact" id="btnHabitacion2">Habitación 2</button>
                <button class="desact" id="btnDormitorio">Dormitorio</button>
                <button class="desact" id="btnBalcon">Balcón</button>
                <button class="desact" id="btnBano">Baño</button>
                <button class="desact" id="btnHall">Hall</button>
            </div>
            <div class="control-ac">
                <h2>Control de Aire Acondicionado</h2>
                <button class="ac-control" id="btnActivarAC">Activar A/C</button>
                <button class="ac-control" id="btnDesactivarAC">Desactivar A/C</button>
            </div>
            <div class="control-temperatura">
                <h2>Control de Temperatura</h2>
                <input type="range" id="sliderTemperatura" min="10" max="30" value="20" step="1">
                <span id="valorTemperatura">20°C</span>
                <button class="aplicar-cambios" id="btnAplicarCambios">Aplicar Cambios</button>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h2>Contacto</h2>
                <p>Dirección: Calle Falsa 123, Ciudad, País</p>
                <p>Teléfono: +123 456 789</p>
                <p>Email: contacto@heatrunner.com</p>
            </div>
            <div class="footer-section">
                <h2>Navegación</h2>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="about.html">Sobre Nosotros</a></li>
                    <li><a href="services.html">Servicios</a></li>
                    <li><a href="contact.html">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h2>Síguenos</h2>
                <ul class="social-links">
                    <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
                    <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
                    <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
                    <li><a href="https://linkedin.com" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 HeatRunner. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script type="text/javascript">
        window.roomColors = <?php echo json_encode($colores); ?>;
    </script>
    <script type="text/javascript" src="vivienda.js"></script>
</body>
</html>
