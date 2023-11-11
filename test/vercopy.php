<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Videos</title>
</head>
<body>
    <h2>Videos Subidos</h2>

    <?php
    // Conexión a la base de datos (ajusta los detalles según tu configuración)
    include('conexion.php');

    // Obtener todos los videos
    $sql = "SELECT Medi_Nombre_Archivo ,
    Medi_Archivo  FROM Media ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //$videoID = $row["Video_ID"];
            $videoNombre = $row["Medi_Nombre_Archivo"];
           // $videoDescripcion = $row["Video_Descripcion"];
            $videoArchivo = $row["Medi_Archivo"];

            // Mostrar información de cada video
            echo "<p><strong>Nombre del Video:</strong> $videoNombre</p>";
           // echo "<p><strong>Descripción:</strong> $videoDescripcion</p>";

            // Mostrar el video
            echo '<video width="640" height="360" controls>';
            echo '<source src="data:video/mp4;base64,' . base64_encode($videoArchivo) . '" type="video/mp4">';
            echo 'Tu navegador no soporta el elemento de video.';
            echo '</video>';

            echo '<hr>'; // Separador entre videos
        }
    } else {
        echo "<p>No hay videos disponibles.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
