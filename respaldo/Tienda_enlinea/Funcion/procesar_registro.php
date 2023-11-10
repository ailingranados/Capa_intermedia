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
    $nombreImagen = $_FILES['imagen']['name'];
    $tamañoImagen = $_FILES['imagen']['size'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tempImagen = $_FILES['imagen']['tmp_name'];

    if ($tamañoImagen <= 1048576) { // Tamaño máximo de 1 MB

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
    $imagenContenido = addslashes(file_get_contents($tempImagen));

    // Llamada al procedimiento almacenado
    $sql = "CALL InsertarUsuario('$usuario', '$password', $rol_usuario2, 1, $rol_usuario, '$nombre', '$apellidop', '$apellidom', '$genero', '$telefono', '$email', '$imagenContenido', '$fecha_nac', NOW(), 1)";

    if ($conn->query($sql) === TRUE) {
        //echo "Registro insertado correctamente.";
        if($rol_usuario == 1){ //Admin
            //
            header("Location: ../Php/Admin/Perfil_admin.php?usuario=$usuario");

        }if($rol_usuario == 2){ //usuario
            if($rol_usuario2 == 1){ //publico
                //
                header("Location: ../Php/Usuario/Perfil_usuario_publico.php?usuario=$usuario");
    
            }else{//privado
                header("Location: ../Php/Usuario_Privado/Perfil_usuario_privado.php?usuario=$usuario");

            }
            

        }if($rol_usuario == 3){ //vendedor
            //
            header("Location: ../php/Vendedor/Perfil_vendedor.php?usuario=$usuario");

        }


       
    } else {
        echo "Error al insertar registro: " . $conn->error;
    }
} else {
    echo "Tamaño de la imagen demasiado grande. El tamaño máximo permitido es 1 MB.";
}
  }
}

// Cerrar la conexión
$conn->close();
?>

