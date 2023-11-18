<?php
// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include('conexion.php');  // Incluye el archivo de conexión


    // Verifica la conexión
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    }
    $usuario = $_POST["usuario"];
    $usuario_id = $_POST["usuarioid"];

    // Obtiene los valores del formulario
    $nombre_lista = $_POST["username"];
    $lista_visible = isset($_POST["checkbox"]) ? 1 : 0; // Si el checkbox está marcado, el valor es 1; de lo contrario, es 0

    // Llama al stored procedure
    $stmt = $conn->prepare("CALL InsertarListaDeseos(?, ?, ?)");
    $stmt->bind_param("iss", $usua_ID_param, $liDe_Nombre_param, $liDe_Visible_param);

    // Parámetros del stored procedure
    $usua_ID_param = $usuario_id; // Ajusta esto según tu lógica
    $liDe_Nombre_param = $nombre_lista;
    $liDe_Visible_param = $lista_visible;

    // Ejecuta el stored procedure
    if ($stmt->execute()) {
        header("Location: ../Perfil.php?usuario=$usuario");
    } else {
        echo "Error al ejecutar el stored procedure: " . $stmt->error;
    } 


    // Cierra la conexión
    $stmt->close();
    $conn->close();
}
?>
