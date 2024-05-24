<!DOCTYPE html>
<html>
<head>
    <title>Lecturas de Temperatura</title>
</head>
<body>
    <h1>Lecturas de Temperatura</h1>
   
    <?php
require '../vendor/autoload.php';

use Smalot\PdfParser\Parser;

$parser = new Parser();
$pdf = $parser->parseFile('./telegrams/ETS_LOGS.pdf');
$text = $pdf->getText();

// Split the text into columns using newline characters
$columns = explode("\n", $text);

// Loop through each column and insert the data into the database
foreach ($columns as $column) {
    // Split the column into an array using spaces
    $data = explode(" ", trim($column));

    // Extract the relevant information from the data array
    $timestamp = $data[0];
    $sourceName = $data[2];
    $destinationName = $data[4];
    $information = $data[6];
    $dataType = $data[8];
    $dpt = $data[10];
    $value = substr($information, strpos($information, "=") + 1, strpos($information, "|") - strpos($information, "=") - 1);

    // Establish the database connection
    $servername = "db";
    $username = "HeatRunner";
    $password = "sv.03/SNG";
    $dbname = "HeatRunner";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set the character set to UTF-8
    $conn->set_charset("utf8mb4");

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO telegramas_knx (timestamp, source_name, destination_name, information, data_type, dpt, value) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("sssssss", $timestamp, $sourceName, $destinationName, $information, $dataType, $dpt, $value);

    // Execute the query
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
</body>
</html>

</body>
</html>



</body>
</html>




