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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeatRunner - Salón</title>

    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/estilo_habitacion.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="contenido-principal">
        <div class="nombre-habitacion">
            <h2 class="salon-centrado" id="toggle-view">Salón</h2>
            <div class="plano-habitacion">
                <?php
                include_once('conexion.php');
                include_once('obtener_colores.php');

                // Consulta para obtener la lectura más reciente de cada sensor
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

                // Calcular la temperatura media para el salón
                $temperaturaMediaSalon = obtenerTemperaturaMedia([$sensores['salon1-room'], $sensores['salon2-room']]);
                $colorSalon = obtenerColorPorTemperatura($temperaturaMediaSalon);
                ?>
                <div class="habitacion" id="habitacion" style="background-color: <?php echo $colorSalon; ?>;">
                    <div id="temp-view-1" class="temp-view">Cambiar vista</div>
                    <div id="temp-view-2" class="temp-view temp-view-hidden">
                        <div class="half" style="background-color: <?php echo obtenerColorPorTemperatura($sensores['salon1-room']); ?>;">Salón 1</div>
                        <div class="half" style="background-color: <?php echo obtenerColorPorTemperatura($sensores['salon2-room']); ?>;">Salón 2</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator"></div>
        <div class="registros">
            <h2>Registros de temperatura</h2>
            <div class="contenedor-lecturas">
                <table class="tabla-lecturas">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Obtener lecturas para Salon1
                        $sqlSalon1 = "SELECT FechaLectura, ValorLectura FROM Lecturas WHERE IdSensor = 5 ORDER BY FechaLectura DESC";
                        $resultadoSalon1 = mysqli_query($conexion, $sqlSalon1);
                        while ($fila = mysqli_fetch_assoc($resultadoSalon1)) {
                            echo "<tr><td>{$fila['FechaLectura']}</td><td>{$fila['ValorLectura']}°C</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <table class="tabla-lecturas">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Obtener lecturas para Salon2
                        $sqlSalon2 = "SELECT FechaLectura, ValorLectura FROM Lecturas WHERE IdSensor = 6 ORDER BY FechaLectura DESC";
                        $resultadoSalon2 = mysqli_query($conexion, $sqlSalon2);
                        while ($fila = mysqli_fetch_assoc($resultadoSalon2)) {
                            echo "<tr><td>{$fila['FechaLectura']}</td><td>{$fila['ValorLectura']}°C</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Centrar el h2 al cargar la página
            const salonView = document.getElementById('toggle-view');
            salonView.style.display = 'flex';
            salonView.style.alignItems = 'center';
            salonView.style.justifyContent = 'center';
            salonView.style.left= '50%';
        });

        document.getElementById('toggle-view').addEventListener('click', function() {
            var view1 = document.getElementById('temp-view-1');
            var view2 = document.getElementById('temp-view-2');
            view1.classList.toggle('temp-view-hidden');
            view2.classList.toggle('temp-view-hidden');
            
            if (view1.style.display === 'none') {
                view1.style.display = 'flex';
                view2.style.display = 'none';
                var halves = view2.querySelectorAll('.half');
                for (var i = 0; i < halves.length; i++) {
                    halves[i].style.width = '50%';
                }
            } else {
                view1.style.display = 'none';
                view2.style.display = 'flex';
                var halves = view2.querySelectorAll('.half');
                for (var i = 0; i < halves.length; i++) {
                    halves[i].style.width = '100%';
                }
            }
        });
    </script>
</body>
</html>
