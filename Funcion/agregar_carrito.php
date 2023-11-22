<?php
include('conexion.php');

// Obtener los datos del formulario u otras fuentes
$usua_id = $_POST['id'];
$usua = $_POST['usuario'];
$prod_id = $_POST['producto']; // Reemplaza con el valor correcto
$cantidad = $_POST['cantidad'];

// Verificar si la cantidad es un número entero
if (!ctype_digit($cantidad)) {
    echo "La cantidad ingresada no es un número entero.";
    exit;
}

// Convertir la cantidad a un entero
$cantidad = (int)$cantidad;

// Verificar si la cantidad es negativa
if ($cantidad < 0) {
    echo "La cantidad ingresada no puede ser negativa.";
    exit;
}

// Verificar si la cantidad es mayor que la existencia
$sql_verificar_existencia = "SELECT PrIn_Existencia FROM Producto_Info WHERE Prod_ID = ?";
$stmt_verificar_existencia = $conn->prepare($sql_verificar_existencia);
$stmt_verificar_existencia->bind_param("i", $prod_id);
$stmt_verificar_existencia->execute();
$stmt_verificar_existencia->bind_result($existencia);
$stmt_verificar_existencia->fetch();
$stmt_verificar_existencia->close();

if ($cantidad > $existencia) {
    echo "La cantidad ingresada es mayor que la existencia disponible.";
    exit;
}

// Llamar al stored procedure
$sql_insertar_carrito = "CALL InsertarCarrito(?, ?, ?)";
$stmt_insertar_carrito = $conn->prepare($sql_insertar_carrito);
$stmt_insertar_carrito->bind_param("iii", $usua_id, $prod_id, $cantidad);

if ($stmt_insertar_carrito->execute()) {
    header("Location: ../PagP_usuario_registrado.php?usuario=$usua");
} else {
    echo "Error al insertar en el carrito: " . $stmt_insertar_carrito->error;
}

$stmt_insertar_carrito->close();
$conn->close();
?>
