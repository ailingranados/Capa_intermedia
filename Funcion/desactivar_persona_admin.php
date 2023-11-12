<?php
// Verifica si se ha enviado la variable 'usuario' por GET
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $usuario2 = $_GET['usuario2'];

    // Realiza la conexión a la base de datos
    include('conexion.php');

    // Llama al procedimiento almacenado 'DesactivarUsuario'
    $sqlProcedureCall = "CALL DesactivarUsuario('$usuario')";

    if ($conn->query($sqlProcedureCall) === TRUE) {
        header("Location: ../admin.php?usuario=$usuario2");
    } else {
        echo "Error al ejecutar el procedimiento: " . $conn->error;
    }

    // Cierra la conexión
    $conn->close();
} else {
    echo "No se recibió un nombre de usuario.";
}
?>
