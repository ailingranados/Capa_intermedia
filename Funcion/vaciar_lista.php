<?php 
include('conexion.php');

// Obtener los datos del formulario u otras fuentes
$usua_id =  $_GET['idusuario'];
$usua =  $_GET['usuario'];

//$prod_id = $_GET['id']; // Reemplaza con el valor correcto

// Llamar al stored procedure
$sql = "CALL VaciarLista(?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usua_id);

if ($stmt->execute()) {
    header("Location: ../Lista.php?usuario=$usua&lista=$usua_id");
} else {
    echo "Error al insertar en el carrito: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>