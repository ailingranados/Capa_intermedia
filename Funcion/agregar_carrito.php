<?php 
include('conexion.php');

// Obtener los datos del formulario u otras fuentes
$usua_id =  $_GET['id'];
$usua =  $_GET['usuario'];

$prod_id = $_GET['producto']; // Reemplaza con el valor correcto

// Llamar al stored procedure
$sql = "CALL InsertarCarrito(?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usua_id, $prod_id);

if ($stmt->execute()) {
    header("Location: ../PagP_usuario_registrado.php?usuario=$usua");
} else {
    echo "Error al insertar en el carrito: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>