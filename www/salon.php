<?php  
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit;
}
$usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeatRunner - Salón</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/estilo_habitacion.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="contenido-principal">
        <div class="nombre-habitacion">
            <h2 class="salon-centrado" id="toggle-view">Cambiar vista</h2>
            <div class="plano-habitacion">
                <?php
                include_once('conexion.php');
                include_once('obtener_colores.php');

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

                $temperaturaMediaSalon = obtenerTemperaturaMedia([$sensores['salon1-room'], $sensores['salon2-room']]);
                $colorSalon = obtenerColorPorTemperatura($temperaturaMediaSalon);
                ?>
                <div class="habitacion" id="habitacion" style="background-color: <?php echo htmlspecialchars($colorSalon, ENT_QUOTES, 'UTF-8'); ?>;">
                    <div id="temp-view-1" class="temp-view">Salon</div>
                    <div id="temp-view-2" class="temp-view temp-view-hidden">
                        <div class="half" style="background-color: <?php echo htmlspecialchars(obtenerColorPorTemperatura($sensores['salon1-room']), ENT_QUOTES, 'UTF-8'); ?>;">Salón 1</div>
                        <div class="half" style="background-color: <?php echo htmlspecialchars(obtenerColorPorTemperatura($sensores['salon2-room']), ENT_QUOTES, 'UTF-8'); ?>;">Salón 2</div>
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
                        $sqlSalon1 = "SELECT FechaLectura, ValorLectura FROM Lecturas WHERE IdSensor = 5 ORDER BY FechaLectura DESC";
                        $resultadoSalon1 = mysqli_query($conexion, $sqlSalon1);
                        $datosSalon1 = [];
                        while ($fila = mysqli_fetch_assoc($resultadoSalon1)) {
                            echo "<tr><td>" . htmlspecialchars($fila['FechaLectura'], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($fila['ValorLectura'], ENT_QUOTES, 'UTF-8') . "°C</td></tr>";
                            $datosSalon1[] = $fila;
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
                        $sqlSalon2 = "SELECT FechaLectura, ValorLectura FROM Lecturas WHERE IdSensor = 6 ORDER BY FechaLectura DESC";
                        $resultadoSalon2 = mysqli_query($conexion, $sqlSalon2);
                        $datosSalon2 = [];
                        while ($fila = mysqli_fetch_assoc($resultadoSalon2)) {
                            echo "<tr><td>" . htmlspecialchars($fila['FechaLectura'], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($fila['ValorLectura'], ENT_QUOTES, 'UTF-8') . "°C</td></tr>";
                            $datosSalon2[] = $fila;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="separator"></div>
        <div class="grafica-contenedor">
            <canvas id="graficaTemperaturas" class="grafica-temperaturas"></canvas>
        </div>
    </div>
    <?php include 'escala-temperatura.php'; ?>
    <?php include 'footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const salonView = document.getElementById('toggle-view');
            salonView.style.display = 'flex';
            salonView.style.alignItems = 'center';
            salonView.style.justifyContent = 'center';
            salonView.style.left= '50%';

            const datosSalon1 = <?php echo json_encode($datosSalon1); ?>;
            const datosSalon2 = <?php echo json_encode($datosSalon2); ?>;
            const labels = datosSalon1.map(d => new Date(d.FechaLectura).getHours() + ':00').reverse();
            const datos1 = datosSalon1.map(d => d.ValorLectura).reverse();
            const datos2 = datosSalon2.map(d => d.ValorLectura).reverse();

            const ctx = document.getElementById('graficaTemperaturas').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Salón 1',
                        data: datos1,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: false,
                        tension: 0.1
                    }, {
                        label: 'Salón 2',
                        data: datos2,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Hora del día'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Temperatura (°C)'
                            }
                        }
                    }
                }
            });
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
