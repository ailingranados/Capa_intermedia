<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Imágenes</title>
</head>
<body>

<?php
    // Include your database connection code here
    include('../Funcion/conexion.php');

    // Consulta para obtener todas las imágenes de la tabla Media
    $sql = "SELECT * FROM Media where TiMe_ID = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $nombreArchivo = $row['Medi_Nombre_Archivo'];
            $id = $row['Medi_ID'];
            $imagenContenido = base64_encode($row['Medi_Archivo']); // asumiendo que la imagen se almacena en la base de datos como un blob

            // Muestra la imagen
            echo "<div>";
            echo "<p>Nombre de Archivo: $nombreArchivo</p>";
            $nombreUsuario =$row['Medi_ID']; // Esto es un ejemplo, debes obtener el nombre de usuario de acuerdo a tu lógica
            //echo $idd;
            echo "<p>Nombre de Archivo: $id</p>";
           if ($nombreUsuario) {
           // Escapa el nombre de usuario para asegurarte de que sea seguro para la URL
               $nombreUsuarioURL = urlencode($nombreUsuario);
           
              // Genera la URL de la imagen con el nombre de usuario como parámetro
             $urlImagen = "mostrar2.php?id=$nombreUsuarioURL";
       
              // Muestra la imagen
              //echo"<img src='IMAGENES/gato_asustado.jpg' style='width:100%'>";
               echo "<img src='$urlImagen'alt='$nombreArchivo' style='width:300px;height:300px;'>";
           } else {
                echo "No se ha especificado un nombre de usuario.";
           }
            //echo "<img src='data:image/*;base64,$imagenContenido' alt='$nombreArchivo' style='width:300px;height:300px;'>";
            echo "</div>";
        }
    } else {
        echo "No se encontraron imágenes.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
?>

</body>
</html>
