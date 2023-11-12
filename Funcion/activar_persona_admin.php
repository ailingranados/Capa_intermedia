
<?php
include('conexion.php');

if (isset($_GET['usuario'])) {
    // Obtén el ID de usuario desde la URL
    $usuarioID = $_GET['usuario'];
    $usuario2 = $_GET['usuario2'];


    // Llama al procedimiento almacenado para activar el usuario
    $sqlActivarUsuario = "CALL ActivarUsuario($usuarioID)";
    if ($conn->query($sqlActivarUsuario) === TRUE) {
        header("Location: ../admin.php?usuario=$usuario2");
    } else {
        echo "Error al activar el usuario: " . $conn->error;
    }
} else {
    echo "No se especificó un ID de usuario.";
}

$conn->close();
?>
