<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario']; // ID del usuario obtenido previamente
    $categoria = $_POST['categoriaid'];
    $categoriaNombre = $_POST['categoria'];
    $categoriaDescripcion = $_POST['desripcion'];
    
    // Realizar la conexión a la base de datos
    include('conexion.php');

  
        // Insertar en la tabla Categorias
        $sqlInsertCategoria = "call ModificarCategoriaNombreDesc($categoria, '$categoriaNombre', '$categoriaDescripcion')";

        if ($conn->query($sqlInsertCategoria) === TRUE) {
            header("Location: ../admin.php?usuario=$usuario");


        } else {
            echo "Error al crear la categoría: " . $conn->error;
        }
    

    // Cerrar la conexión
    $conn->close();
}
?>
