<?php 
include('conexion.php');

// Obtener los datos del formulario u otras fuentes
$usua_id =  $_POST['id'];
$usua =  $_POST['usuario'];

$prod_id = $_POST['producto']; // Reemplaza con el valor correcto
$cantidad = $_POST['cantidad']; 
// Llamar al stored procedure
$sql = "CALL InsertarCarrito(?, ?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $usua_id, $prod_id, $cantidad);

if ($stmt->execute()) {
    header("Location: ../PagP_usuario_registrado.php?usuario=$usua");
} else {
    echo "Error al insertar en el carrito: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>