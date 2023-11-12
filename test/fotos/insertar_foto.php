<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    include('../conexion.php');

    // Recuperar datos del formulario
    $nombre = $_POST['nombre'];
    $archivoTmp = $_FILES['archivo']['tmp_name'];


    $nombreImagen = $_FILES['archivo']['name'];
    $tamañoImagen = $_FILES['archivo']['size'];
    $tipoImagen = $_FILES['archivo']['type'];
    $tempImagen = $_FILES['archivo']['tmp_name'];

    
    if (!empty($nombre) && !empty($archivoTmp)) {
        $archivoContenido = file_get_contents($archivoTmp);

        $imagenContenido = addslashes(file_get_contents($tempImagen));


        $sql = "INSERT INTO Fotos_1 (Foto_Nombre, Foto_Archivo) VALUES ('$nombre', '$imagenContenido')";

        if ($conn->query($sql) === TRUE) {
            //echo "Registro insertado correctamente.";

        }else {
            echo "Error al insertar la foto: " . $conn->error;
        }
    
        /*

        // Consulta para insertar la foto en la tabla Fotos
        $sql = "INSERT INTO Fotos_1 (Foto_Nombre, Foto_Archivo) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param('ss', $nombre, $imagenContenido);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Foto insertada correctamente.";
        } else {
            echo "Error al insertar la foto: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        */
        $conn->close();
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
?>
