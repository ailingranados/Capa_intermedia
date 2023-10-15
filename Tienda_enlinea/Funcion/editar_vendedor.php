<?php
include('conexion.php');  // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $nombre = $_POST['Nombre'];
    $usuario = $_POST['usuario'];
    $apellidop = $_POST['Apellidop'];
    $apellidom = $_POST['ApellidoM'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['pswd'];
    $fecha_nac = $_POST['fecha_nac'];
    $genero = $_POST['genero'];
/*
    if (isset($_POST["rol-usuario"])) {
        $rol_usuario = $_POST["rol-usuario"];
    } else {
        echo "No se ha seleccionado ningún valor.";
        exit();  // Salir del script si no se ha seleccionado un rol de usuario
    }

    if (isset($_POST["rol-usuario2"])) {
        $rol_usuario2 = $_POST["rol-usuario2"];
    } else {
        echo "No se ha seleccionado ningún valor.";
        exit();  // Salir del script si no se ha seleccionado un tipo de usuario
    }
*/
    // Llamada al procedimiento almacenado ActualizarUsuario
    $sql = "CALL ActualizarUsuario_Vendedor('$usuario', '$password', 1, '$nombre', '$apellidop', '$apellidom', '$genero', '$telefono', '$email', '', '$fecha_nac', NOW(), 1)";

    if ($conn->query($sql) === TRUE) {
        //echo "Registro actualizado correctamente.";
        //header("Location: ../Php/Perfil_usuario_publico.php?usuario=$usuario");
        header("Location: ../php/Vendedor/Perfil_vendedor.php?usuario=$usuario");

        
    } else {
        echo "Error al actualizar registro: " . $conn->error;
    }

}

// Cerrar la conexión
$conn->close();
?>
