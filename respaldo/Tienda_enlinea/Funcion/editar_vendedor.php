<?php
include('conexion.php');  // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $nombreImagen = $_FILES['imagen']['name'];
    $tamañoImagen = $_FILES['imagen']['size'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tempImagen = $_FILES['imagen']['tmp_name'];

    if ($tamañoImagen <= 1048576) { // Tamaño máximo de 1 MB
    $nombre = $_POST['Nombre'];
    $usuario = $_POST['usuario'];
    $apellidop = $_POST['Apellidop'];
    $apellidom = $_POST['ApellidoM'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['pswd'];
    $fecha_nac = $_POST['fecha_nac'];
    $genero = $_POST['genero'];
    $imagenContenido = addslashes(file_get_contents($tempImagen));

    // Llamada al procedimiento almacenado ActualizarUsuario
    $sql = "CALL ActualizarUsuario_Vendedor('$usuario', '$password', 1, '$nombre', '$apellidop', '$apellidom', '$genero', '$telefono', '$email', '$imagenContenido', '$fecha_nac', NOW(), 1)";

    if ($conn->query($sql) === TRUE) {
        //echo "Registro actualizado correctamente.";
        //header("Location: ../Php/Perfil_usuario_publico.php?usuario=$usuario");
        header("Location: ../php/Vendedor/Perfil_vendedor.php?usuario=$usuario");

        
    } else {
        echo "Error al actualizar registro: " . $conn->error;
    }
}else {
    echo "Tamaño de la imagen demasiado grande. El tamaño máximo permitido es 1 MB.";
}

}

// Cerrar la conexión
$conn->close();
?>
