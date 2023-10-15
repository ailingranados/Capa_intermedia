<!DOCTYPE html>
<html>
<head>
    <title>Mostrar Fotografía</title>
</head>
<body>
    <h1>Mostrar Fotografía</h1>

    <!-- Formulario para subir la fotografía -->
    <form action="archivos.php" method="post" enctype="multipart/form-data">
        <label for="foto">Selecciona una fotografía:</label>
        <input type="file" name="foto" id="foto">
        <br><br>
        <input type="submit" value="Subir Foto" name="submit">
    </form>

    <hr>

    <!-- Mostrar la última fotografía subida -->
    <h2>Última fotografía subida:</h2>
    <?php
    include('conexion.php');  // Incluye el archivo de conexión


    // Obtener la última fotografía subida
    $sql = "SELECT Nombre, Foto FROM Fotos ORDER BY Foto_ID DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['Nombre'];
        $imagen = base64_encode($row['Foto']);
        echo "<h3>Nombre: $nombre</h3>";
        echo "<img src='data:image/jpg;base64,$imagen' alt='Fotografía'>";
    } else {
        echo "No hay fotografías disponibles.";
    }

    $conn->close();
    ?>
    <img src='data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>' alt='Fotografía'>

</body>
</html>
