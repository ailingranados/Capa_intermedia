<?php
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Realizar la conexión a la base de datos (asegúrate de incluir el archivo de conexión)
        include('conexion.php');

        // Obtener los valores del formulario
        $caliValor = $_POST['cali_valor'];
        $comentario = $_POST['username'];
        $usuaID = $_POST['usuario_id'];
        $prodID = $_POST['pructo_id'];
        $usuario = $_POST['usuario'];

        // Llamar al stored procedure
        $sqlProcedure = "CALL InsertarCalificacionYComentario($caliValor, '$comentario', $usuaID, $prodID)";
        $resultProcedure = $conn->query($sqlProcedure);

        // Verificar si el stored procedure se ejecutó correctamente
        if ($resultProcedure) {
            header("Location: ../Producto.php?usuario=$usuario&prod_id=$prodID");
        } else {
            echo "Error al insertar comentario y calificación: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    }
?>
