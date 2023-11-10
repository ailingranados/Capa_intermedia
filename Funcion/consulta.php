<?php
include('conexion.php');

// Aquí puedes ejecutar consultas y trabajar con la conexión $conn
// Ejemplo de consulta
$sql = "SELECT * FROM usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Procesa los resultados
    while($row = $result->fetch_assoc()) {
        echo "Nombre: " . $row["Usua_Nombre"]. " - password: " . $row["Usua_Contra"]. "<br>";
    }
} else {
    echo "0 resultados";
}

// Cierra la conexión al finalizar
$conn->close();
?>
