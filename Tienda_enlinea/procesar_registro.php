<?php
include('conexion.php');  // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $nombre = $_POST['Nombre'];
    $usuario = $_POST['usuario'];


    $check_query = "SELECT * FROM usuario WHERE Usua_Nombre='$usuario'";
$result = $conn->query($check_query);

if ($result->num_rows > 0) {
    // El nombre de usuario ya existe, puedes mostrar un mensaje de error
    echo "El nombre de usuario ya está en uso. Por favor, elige otro nombre de usuario.";
} else {
    

    $apellidop = $_POST['Apellidop'];
    $apellidom = $_POST['ApellidoM'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    
    $password = $_POST['pswd'];
    $fecha_nac = $_POST['fecha_nac'];
   // $privacidad = isset($_POST['privado']) && $_POST['privado'] === 'Privado' ? 1 : 0;  // Corrección del campo privado
    $genero = $_POST['genero'];
    //$rol_usuario = $_POST['rol-usuario'];
    if (isset($_POST["rol-usuario"])) {
        $rol_usuario = $_POST["rol-usuario"];
        //echo "El valor seleccionado es: " . $rol_usuario;
    } else {
        echo "No se ha seleccionado ningún valor.";
    }

    if (isset($_POST["rol-usuario2"])) {
        $rol_usuario2 = $_POST["rol-usuario2"];
        //echo "El valor seleccionado es: " . $rol_usuario;
    } else {
        echo "No se ha seleccionado ningún valor.";
    }
   /*
    if($privacidad == 'Publico'){
        $privacidad1 = 1;
    }else{
        $privacidad1 = 0;
    }
   */

    // Captura otros datos del formulario según corresponda
   /* $rol_usuario = $_POST['rol-usuario'];
    echo "Rol de usuario seleccionado: " . $rol_usuario. $privacidad;  // Imprime el valor seleccionado
   */

    // Llamada al procedimiento almacenado
    $sql = "CALL InsertarUsuario('$usuario', '$password', $rol_usuario2, 1, $rol_usuario, '$nombre', '$apellidop', '$apellidom', '$genero', '$telefono', '$email', '', '$fecha_nac', NOW(), 1)";

    if ($conn->query($sql) === TRUE) {
        //echo "Registro insertado correctamente.";
        header("Location: Modificar_persona.php?usuario=$usuario");
    } else {
        echo "Error al insertar registro: " . $conn->error;
    }
}
}

// Cerrar la conexión
$conn->close();
?>

