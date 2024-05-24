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

while ($fila = mysqli_fetch_assoc($resultado)) {
    $sensores[$fila['NombreSensor']] = $fila['ValorLectura'];
}

// Calcular la temperatura media para el salón
$temperaturaMediaSalon = obtenerTemperaturaMedia([$sensores['Salon1'], $sensores['Salon2']]);
$colorSalon = obtenerColorPorTemperatura($temperaturaMediaSalon);


function obtenerColorPorTemperatura($temperatura) {
    if ($temperatura >= 30) {
        return '#FF0000'; // Rojo
    } elseif ($temperatura >= 25) {
        return '#FFA500'; // Naranja
    } elseif ($temperatura >= 20) {
        return '#FFFF00'; // Amarillo
    } elseif ($temperatura >= 15) {
        return '#C0C0C0'; // Plata
    } else {
        return '#808080'; // Gris
    }
}


function obtenerTemperaturaMedia($temperaturas) {
    return array_sum($temperaturas) / count($temperaturas);
}
?>
