<?php 
include('conexion.php');

// Obtener los datos del formulario u otras fuentes
$lista =  $_POST['id'];
$usua =  $_POST['usuario'];

$prod_id = $_POST['producto']; // Reemplaza con el valor correcto
$cantidad = $_POST['cantidad']; 
// Llamar al stored procedure
$sql = "CALL InsertarProducto_lista(?, ?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $lista, $prod_id, $cantidad);

if ($stmt->execute()) {
    header("Location: ../Lista_agregar_productos.php?usuario=$usua&lista=$lista");
} else {
    echo "Error al insertar en el carrito: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>