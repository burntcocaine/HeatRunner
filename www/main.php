<main>
        <div class="menu-temperaturas">
            <?php include 'menu_temperaturas.php'; ?>
            <?php
            // Mostrar la temperatura de cada sensor disponible
            foreach ($sensores as $nombreSensor => $temperatura) {
                $nombreBonito = isset($nombresBonitos[$nombreSensor]) ? $nombresBonitos[$nombreSensor] : $nombreSensor;
                echo '<li><span class="nombre-habitacion">' . $nombreBonito . ':</span> <span class="temperatura">' . $temperatura . '°C</span></li>';
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
    </main>