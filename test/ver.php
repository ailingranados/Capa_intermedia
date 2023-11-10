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
    $sql = "SELECT Video_ID, Video_Nombre, Video_Descripcion, Video_Archivo FROM Videos ORDER BY Fecha_Subida DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $videoID = $row["Video_ID"];
            $videoNombre = $row["Video_Nombre"];
            $videoDescripcion = $row["Video_Descripcion"];
            $videoArchivo = $row["Video_Archivo"];

            // Mostrar información de cada video
            echo "<p><strong>Nombre del Video:</strong> $videoNombre</p>";
            echo "<p><strong>Descripción:</strong> $videoDescripcion</p>";

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
