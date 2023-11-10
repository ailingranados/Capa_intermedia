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
    $imagenContenido = addslashes(file_get_contents($tempImagen));

    // Llamada al procedimiento almacenado ActualizarUsuario
    $sql = "CALL ActualizarUsuario('$usuario', '$password', $rol_usuario2, 1, '$nombre', '$apellidop', '$apellidom', '$genero', '$telefono', '$email', '$imagenContenido', '$fecha_nac', NOW(), 1)";

    if ($conn->query($sql) === TRUE) {
        //echo "Registro actualizado correctamente.";
        //header("Location: ../Php/Perfil_usuario_publico.php?usuario=$usuario");
        if($rol_usuario2 == 1){ //publico
            //
            header("Location: ../Php/Usuario/Perfil_usuario_publico.php?usuario=$usuario");

        }else{//privado
            header("Location: ../Php/Usuario_Privado/Perfil_usuario_privado.php?usuario=$usuario");

        }
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
