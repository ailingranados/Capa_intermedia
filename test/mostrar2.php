<?php


include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Consulta para obtener la información del usuario y su rol
    $sqlSelectUsuario = "SELECT Medi_ID, Prod_ID ,
    TiMe_ID ,
    Medi_Nombre_Archivo ,
    Medi_Archivo  from Media where Medi_ID = $idUsuario ";
    $result = $conn->query($sqlSelectUsuario);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Aquí puedes acceder a los campos del usuario y su rol
        // Por ejemplo: $row['Usua_Nombre'], $row['Role_Nombre']
        $nombreImagen = $row['Medi_ID'];
        $imagenContenido = $row['Medi_Archivo'];
        // Mostrar la imagen
        header("Content-type: image/*");
        echo $imagenContenido;

        // Puedes realizar alguna acción con los datos obtenidos
        // ...

    } else {
        echo "No se encontró ningún usuario con ese ID.";
    }
} else {
    echo "No se especificó un ID de usuario.";
}

// Cerrar la conexión
$conn->close();




?>
