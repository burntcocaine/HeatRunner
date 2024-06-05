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
    <title>HeatRunner - Dormitorio</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/estilo_habitacion.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="contenido-principal">
        <div class="nombre-habitacion">
            <h2>Dormitorio</h2>
            <div class="plano-habitacion">
                <?php
                include_once('conexion.php');
                include_once('obtener_colores.php');

                // Consulta para obtener la lectura más reciente del sensor de dormitorio-room
                $sql = "
                    SELECT s.NombreSensor, l.ValorLectura, l.FechaLectura
                    FROM Sensores s
                    JOIN (
                        SELECT IdSensor, MAX(FechaLectura) as MaxFecha
                        FROM Lecturas
                        WHERE IdSensor = (SELECT Sensor FROM Sensores WHERE NombreSensor = 'dormitorio-room')
                        GROUP BY IdSensor
                    ) as max_l
                    ON s.Sensor = max_l.IdSensor
                    JOIN Lecturas l
                    ON s.Sensor = l.IdSensor AND l.FechaLectura = max_l.MaxFecha
                ";

                $resultado = mysqli_query($conexion, $sql);
                $fila = mysqli_fetch_assoc($resultado);
                $temperaturaDormitorio = $fila['ValorLectura'];
                $colorDormitorio = obtenerColorPorTemperatura($temperaturaDormitorio);
                ?>
                <div class="hab" style="background-color: <?php echo htmlspecialchars($colorDormitorio, ENT_QUOTES, 'UTF-8'); ?>;">Dormitorio</div>
                
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
                        // Obtener lecturas para dormitorio-room
                        $sqlDormitorio = "SELECT FechaLectura, ValorLectura FROM Lecturas WHERE IdSensor = (SELECT Sensor FROM Sensores WHERE NombreSensor = 'dormitorio-room') ORDER BY FechaLectura DESC";
                        $resultadoDormitorio = mysqli_query($conexion, $sqlDormitorio);
                        while ($fila = mysqli_fetch_assoc($resultadoDormitorio)) {
                            echo "<tr><td>" . htmlspecialchars($fila['FechaLectura'], ENT_QUOTES, 'UTF-8') . "</td><td>" . htmlspecialchars($fila['ValorLectura'], ENT_QUOTES, 'UTF-8') . "°C</td></tr>";
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
            const datosDormitorio = <?php
                $sqlDormitorio = "SELECT FechaLectura, ValorLectura FROM Lecturas WHERE IdSensor = (SELECT Sensor FROM Sensores WHERE NombreSensor = 'dormitorio-room') ORDER BY FechaLectura DESC";
                $resultadoDormitorio = mysqli_query($conexion, $sqlDormitorio);
                $datos = [];
                while ($fila = mysqli_fetch_assoc($resultadoDormitorio)) {
                    $datos[] = $fila;
                }
                echo json_encode($datos);
            ?>;

            const labels = datosDormitorio.map(d => new Date(d.FechaLectura).getHours() + ':00').reverse();
            const datos = datosDormitorio.map(d => d.ValorLectura).reverse();

            const ctx = document.getElementById('graficaTemperaturas').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Dormitorio',
                        data: datos,
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
    </script>
</body>
</html>
