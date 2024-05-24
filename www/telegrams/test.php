<!DOCTYPE html>
<html>
<head>
    <title>Lecturas de Temperatura</title>
</head>
<body>
    <h1>Lecturas de Temperatura</h1>
    <?php

$archivo = fopen("/var/www/html/telegrams/ETS_LOGS.csv", "r");

if ($archivo) {
    echo "<table border='1'>\n";

  
    // Leer e imprimir las filas restantes
    while (($datos = fgetcsv($archivo, 1000, ";")) !== false) {
        echo "<tr>\n";
        foreach ($datos as $indice => $dato) {
            if ($indice == 1) {
                // Aislar lo que no coincida con el formato de fecha y hora
                if (!preg_match("/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$/", $dato)) {
                    echo "<td>" . htmlspecialchars($dato) . "</td>\n";
                } else {
                    echo "<td></td>\n"; // Dejar vacío si coincide con el formato
                }
            } elseif ($indice == 7) {
                // Mostrar solo los números con formato xx,x y xx
                if (preg_match('/^\d{1,2}(,\d)?/', $dato)) {
                    // Extraer solo la parte numérica
                    $numero = preg_replace('/[^\d,]/', '', $dato);
                    echo "<td>" . htmlspecialchars($numero) . "</td>\n";
                } else {
                    echo "<td>ss</td>\n"; // Mostrar 'ss' si no coincide con el formato
                }
            } else {
                echo "<td>" . htmlspecialchars($dato) . "</td>\n";
            }
        }
        echo "</tr>\n";
    }

    echo "</table>\n";
    fclose($archivo);
} else {
    echo "No se pudo abrir el archivo.<br />\n";
}
?>

</body>
</html>
