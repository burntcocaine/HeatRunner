<?php
include_once('conexion.php');

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
$colores = [];

while ($fila = mysqli_fetch_assoc($resultado)) {
    $sensores[$fila['NombreSensor']] = $fila['ValorLectura'];
}

// Calcular la temperatura media para el salón
$temperaturaMediaSalon = obtenerTemperaturaMedia([$sensores['salon1-room'], $sensores['salon2-room']]);
$colorSalon = obtenerColorPorTemperatura($temperaturaMediaSalon);

// Suponemos que cada sensor tiene un nombre como 'Salon1', 'Salon2', etc., y que necesitas colores para varios sensores
foreach ($sensores as $nombreSensor => $valor) {
    $colores[$nombreSensor] = obtenerColorPorTemperatura($valor);
}
$colores['salon-room'] = $colorSalon;

// Solo envía la respuesta JSON si se llama directamente
if (isset($_GET['json'])) {
    echo json_encode($colores);
}

function obtenerColorPorTemperatura($temperatura) {
    if ($temperatura >= 30) {
        return 'rgb(255, 0, 0)'; // Rojo
    } elseif ($temperatura >= 25) {
        return 'rgb(255, 165, 0)'; // Naranja
    } elseif ($temperatura >= 20) {
        return 'rgb(255, 255, 0)'; // Amarillo
    } elseif ($temperatura >= 15) {
        return 'rgb(192, 192, 192)'; // Plata
    } else {
        return 'rgb(128, 128, 128)'; // Gris
    }
}

function obtenerTemperaturaMedia($temperaturas) {
    return array_sum($temperaturas) / count($temperaturas);
}
?>
