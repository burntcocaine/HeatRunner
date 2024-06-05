<!DOCTYPE html>
<html>
<head>
    <title>Temperatura KNX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Temperatura Actual: <span id="temperature">Cargando...</span>°C</h1>

    <script>
        $(document).ready(function() {
            $.get('http://192.168.1.135:5000/get_temperature', function(data) {
                if (data.temperature) {
                    $('#temperature').text(data.temperature);
                } else {
                    $('#temperature').text('Error al obtener la temperatura');
                }
            });
        });
    </script>
</body>
</html>
