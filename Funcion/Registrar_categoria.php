<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario']; // ID del usuario obtenido previamente
    $usuarioID = $_POST['usuarioid'];
    $categoriaNombre = $_POST['categoria'];
    $categoriaDescripcion = $_POST['desripcion'];
    
    // Realizar la conexión a la base de datos
    include('conexion.php');

    // Verificar si ya existe una categoría con el mismo nombre
    $sqlVerificarCategoria = "SELECT COUNT(*) AS count FROM Categorias WHERE Usua_ID = '$usuarioID' AND Cate_Nombre = '$categoriaNombre'";
    $result = $conn->query($sqlVerificarCategoria);
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        echo "Error: Ya existe una categoría con el mismo nombre para este usuario.";
    } else {
        // Insertar en la tabla Categorias
        $sqlInsertCategoria = "INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES ('$usuarioID', '$categoriaNombre', '$categoriaDescripcion', 1)";

        if ($conn->query($sqlInsertCategoria) === TRUE) {
            header("Location: ../PagP_usuario_registrado.php?usuario=$usuario");


        } else {
            echo "Error al crear la categoría: " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>
