<?php
include('conexion.php');  // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $password = $_POST['pswd'];
    $fecha_nac = $_POST['fecha_nac'];
    $privacidad = isset($_POST['privado']) && $_POST['privado'] === 'Privado' ? 1 : 0;  // Corrección del campo privado
    $genero = $_POST['genero'];
    $rol_usuario = $_POST['rol-usuario'];

   
    if($privacidad == 'Publico'){
        $privacidad1 = 1;
    }else{
        $privacidad1 = 0;
    }
   
    // Captura otros datos del formulario según corresponda
    $rol_usuario = $_POST['rol-usuario'];
    echo "Rol de usuario seleccionado: " . $rol_usuario. $privacidad;  // Imprime el valor seleccionado


    // Llamada al procedimiento almacenado
    $sql = "CALL InsertarUsuario('$usuario', '$password', 1, 1, 'Usuario', '$nombre', '$apellido', '', '$genero', '', '$email', '', '$fecha_nac', NOW(), 1)";

    if ($conn->query($sql) === TRUE) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar registro: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>

