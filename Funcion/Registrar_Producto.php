<?php

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $productoNombre = $_POST['nombre'];
    $productoPrecio = $_POST['precio'];
    $productoCotizable = isset($_POST['cotizable']) ? 1 : 0;
    $productoEstatus = 1; // Puedes ajustar esto según tus necesidades
    $usuario = $_POST['usuario']; // ID del usuario obtenido previamente
    $usuarioID = $_POST['usuarioid'];
    $categoriaID = $_POST['categoria']; 
    $descripcion = $_POST['descripcion'];
    $existencia = $_POST['disponible'];
   // $validado = isset($_POST['validado']) ? 1 : 0;
    $validado =1;
    //imagenes
    $nombreImagen = $_FILES['producto_1']['name'];
    $tamañoImagen = $_FILES['producto_1']['size'];
    $tipoImagen = $_FILES['producto_1']['type'];
    $tempImagen = $_FILES['producto_1']['tmp_name'];
  

    $nombreImagen2 = $_FILES['producto_2']['name'];
    $tamañoImagen2 = $_FILES['producto_2']['size'];
    $tipoImagen2 = $_FILES['producto_2']['type'];
    $tempImagen2 = $_FILES['producto_2']['tmp_name'];
    
    //video
    $videoNombre = $_FILES['producto_3']['name'];
    $videoArchivo = file_get_contents($_FILES["producto_3"]["tmp_name"]); // Obtener el contenido del archivo de video

    $tiempoImagenID = 1;
    $tiempoVideoID = 2;

    // Realizar la conexión a la base de datos
    include('conexion.php');
    $imagenContenido = addslashes(file_get_contents($tempImagen));
    $imagenContenido2 = addslashes(file_get_contents($tempImagen2));
    $sql = "CALL Insertarproducto('$productoNombre', $productoPrecio, $productoCotizable, $productoEstatus, $usuarioID, $categoriaID, '$descripcion', $existencia, $validado, '$videoNombre', ? , '$nombreImagen', '$imagenContenido', '$nombreImagen2','$imagenContenido2')";
    
    $stmt = $conn->prepare($sql);
   
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

    $stmt->bind_param("s", $videoArchivo);
    if ($stmt->execute()) {
        echo "El video se subió correctamente.";
        //header("Location: ver.php");
        header("Location: ../Inventario.php?usuario=$usuario");
    } else {
        echo "Error al subir el video: " . $stmt->error;
    }

    $stmt->close();
    /*
    if ($conn->query($sql) === TRUE) {
        echo "Producto insertado con éxito.";
        header("Location: ../Inventario.php?usuario=$usuario");
    }else{
        echo "Error al insertar el producto: " . $conn->error;
        //echo $sql;

    }
  */
    // Cerrar la conexión y liberar recursos
    $conn->close();
}


/*
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $productoNombre = $_POST['nombre'];
    $productoPrecio = $_POST['precio'];
    $productoCotizable = isset($_POST['cotizable']) ? 1 : 0;
    $productoEstatus = 1; // Puedes ajustar esto según tus necesidades
    $usuario = $_POST['usuario']; // ID del usuario obtenido previamente
    $usuarioID = $_POST['usuarioid'];
    $categoriaID = $_POST['categoria']; 
    $descripcion = $_POST['descripcion'];
    $existencia = $_POST['disponible'];
    $validado = isset($_POST['validado']) ? 1 : 0;

    // Datos relacionados con las imágenes y videos
    $imagen1Nombre = $_FILES['producto_1']['name'];
    $imagen1Archivo = file_get_contents($_FILES['producto_1']['tmp_name']);

    $imagen2Nombre = $_FILES['producto_2']['name'];
    $imagen2Archivo = file_get_contents($_FILES['producto_2']['tmp_name']);

    $videoNombre = $_FILES['producto_3']['name'];
    $videoArchivo = file_get_contents($_FILES['producto_3']['tmp_name']);

    $tiempoImagenID = 1;
    $tiempoVideoID = 2;

    // Realizar la conexión a la base de datos
    include('conexion.php');
    $sql = "CALL InsertarProductoConMedia(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    
    // Asociar parámetros
    $stmt->bind_param("sbiiisiisbbsbbii", $productoNombre, $productoPrecio, $productoCotizable, $productoEstatus, $usuarioID, $categoriaID, $descripcion, $existencia, $validado, $imagen1Nombre, $imagen1Archivo, $imagen2Nombre, $imagen2Archivo, $videoNombre, $videoArchivo, $tiempoImagenID, $tiempoImagenID, $tiempoVideoID);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Producto insertado con éxito.";
    } else {
        echo "Error al insertar el producto: " . $stmt->error;
    }
    
    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
    


    $sql = "CALL InsertarProductoConMedia('$productoNombre', $productoPrecio, $productoCotizable, $productoEstatus, $usuarioID, $categoriaID, '$descripcion', $existencia, $validado, '$imagen1Nombre', '$imagen1Archivo', '$imagen2Nombre', '$imagen2Archivo', '$videoNombre', '$videoArchivo', $tiempoImagenID, $tiempoImagenID, $tiempoVideoID)";

    if ($conn->query($sql) === TRUE) {
        echo "Producto insertado con éxito.";
    }else{
        echo "Error al insertar el producto: " . $conn->error;;

    }
  
    // Cerrar la conexión y liberar recursos
    
    $conn->close();
    
}
*/
?>
