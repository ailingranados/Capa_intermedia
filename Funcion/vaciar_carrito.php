<?php 
include('conexion.php');

// Obtener los datos del formulario u otras fuentes
$usua_id =  $_GET['idusuario'];
$usua =  $_GET['usuario'];

//$prod_id = $_GET['id']; // Reemplaza con el valor correcto

// Llamar al stored procedure
$sql = "CALL VaciarCarrito(?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usua_id, $prod_id);

if ($stmt->execute()) {
    header("Location: ../Carrito.php?usuario=$usua");
} else {
    echo "Error al insertar en el carrito: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>