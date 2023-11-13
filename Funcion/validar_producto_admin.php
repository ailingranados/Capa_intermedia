
<?php
include('conexion.php');

if (isset($_GET['usuario'])) {
    // Obtén el ID de usuario desde la URL
    $usuario = $_GET['usuario'];
    $producto = $_GET['producto'];


    // Llama al procedimiento almacenado para activar el usuario
    $sqlActivarUsuario = "CALL ValidarProducto($producto)";
    if ($conn->query($sqlActivarUsuario) === TRUE) {
        header("Location: ../admin.php?usuario=$usuario");
    } else {
        echo "Error al activar el usuario: " . $conn->error;
    }
} else {
    echo "No se especificó un ID de usuario.";
}

$conn->close();
?>
