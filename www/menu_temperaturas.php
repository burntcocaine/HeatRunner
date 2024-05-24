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

// Array de mapeo para nombres bonitos
$nombresBonitos = [
    'habitacion1-room' => 'Habitación 1',
    'habitacion2-room' => 'Habitación 2',
    'bano-room' => 'Baño',
    'dormitorio-room' => 'Dormitorio',
    'salon1-room' => 'Salón 1',
    'salon2-room' => 'Salón 2'
];






// Calcular la temperatura media para el salón
$temperaturaMediaSalon = obtenerTemperaturaMedia([$sensores['salon1-room'], $sensores['salon2-room']]);
?>