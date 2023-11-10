<?php
include('../Funcion/conexion.php');

// Procesar la subida del video
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Procesar la subida del video
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $videoArchivo = file_get_contents($_FILES["video"]["tmp_name"]); // Obtener el contenido del archivo de video

    // Insertar datos en la tabla Videos
    $sql = "INSERT INTO Videos (Video_Nombre, Video_Descripcion, Video_Archivo) VALUES ('$nombre', '$descripcion', ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $videoArchivo);

    if ($stmt->execute()) {
        echo "El video se subió correctamente.";
        header("Location: ver.php");
    } else {
        echo "Error al subir el video: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
