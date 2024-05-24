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

        // Leer e imprimir la primera fila como encabezados
        if (($encabezados = fgetcsv($archivo, 1000, ";")) !== false) {
            echo "<tr>\n";
            foreach ($encabezados as $encabezado) {
                echo "<td>" . htmlspecialchars($encabezado) . "</td>\n";
            }
            echo "</tr>\n";
        }

        // Leer e imprimir las filas restantes
        while (($datos = fgetcsv($archivo, 1000, ";")) !== false) {
            echo "<tr>\n";
            foreach ($datos as $dato) {
                echo "<td>" . htmlspecialchars($dato) . "</td>\n";
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
