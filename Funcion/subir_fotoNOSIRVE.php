<?php
include('conexion.php');  // Incluye el archivo de conexión

if (isset($_POST['submit'])) {
    $nombre = $_FILES['foto']['name'];
    $foto = file_get_contents($_FILES['foto']['tmp_name']);

    $stmt = $conn->prepare("INSERT INTO Fotos (Nombre, Foto) VALUES (?, ?)");
    $stmt->bind_param("sb", $nombre, $foto);

    if ($stmt->execute()) {
        echo "Fotografía subida exitosamente.";
    } else {
        echo "Error al subir la fotografía: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
