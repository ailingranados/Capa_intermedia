<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Fotos</title>
</head>
<body>

<?php
    // Include your database connection code here
    include('../conexion.php');

    // Consulta para obtener todas las fotos de la tabla Fotos
    $sql = "SELECT * FROM Fotos_1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombre = $row['Foto_Nombre'];
            $id = $row['Prod_ID'];
            $archivoContenido = base64_encode($row['Foto_Archivo']); // asumiendo que la imagen se almacena en la base de datos como un blob

            // Mostrar la foto
            echo "<div>";
            echo "<p>Nombre de la Foto: $nombre</p>";
            echo "<p>id de la Foto: $id</p>";
            echo "<img src='data:image/*;base64,$archivoContenido' alt='$nombre' style='width:300px;height:300px;'>";
            echo "</div>";
        }
    } else {
        echo "No se encontraron fotos.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
?>

</body>
</html>
