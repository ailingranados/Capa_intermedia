<?php

if (isset($_POST['mensaje'])) {
    include('conexion.php');  // Incluye el archivo de conexión

    $mensaje = $_POST['mensaje'];
    $usuario = $_POST['usuario'];
    $vendedor = $_POST['vendedor'];
    $id_usuario = $_POST['id_usuario'];

    
    // Aquí puedes hacer lo que necesites con el mensaje y las variables de usuario
    // ...
    //echo "Mensaje recibido: $mensaje de $usuario a $usuario2";
    $stmt = $conn->prepare("CALL InsertarChat(?, ?, ?)");
    $stmt->bind_param("iss", $id_usuario, $vendedor, $mensaje);

    // Definir los valores de los parámetros (reemplazar con valores reales)
   

    // Ejecutar el stored procedure
    $stmt->execute();

    // Verificar si la operación fue exitosa
    if ($stmt->affected_rows > 0) {
       // echo "Operación exitosa. Mensaje insertado correctamente.";
        header("Location: ../test/chat/proy/cotizar_vendedor.php?id_persona=$vendedor&usuario=$usuario");

    } else {
        echo "Error al insertar el mensaje.";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();

}
?>
