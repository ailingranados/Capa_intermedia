<?php 
//recibimos los datos de la imagen

$nombre_imagen = $_FILES['foto']['name'];
$tipo_imagen = $_FILES['foto']['type'];
$tamagno_imagen = $_FILES['foto']['size'];
$temporal_imagen = $_FILES['foto']['tmp_name'];



// $foto = file_get_contents($_FILES['foto']['tmp_name']);

if($tamagno_imagen <= 1000000){
    if($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpg"|| $tipo_imagen=="image/png"|| $tipo_imagen=="image/gif"){
       //Ruta de la carpeta destino en servidor
        $carpeta_destino=$_SERVER['DOCUMENT_ROOT']. '/prueba';

        //movemos la imagen del directorio temporal al directorio escogido 

          
          move_uploaded_file($temporal_imagen, $carpeta_destino . $nombre_imagen);

        //move_uploaded_file($_FILES['foto']['tmp_name'], $carpeta_destino.$nombre_imagen);

    } else{
        echo "solo se pueden abrir imagenes jpg/jpeg/png/gif";
    }
} else{
    echo "El tamaño es demasiado grande";
}

include('conexion.php');  // Incluye el archivo de conexión
// Comprobamos si el archivo se movió correctamente
if (!file_exists($carpeta_destino . $nombre_imagen)) {
    echo "Error al mover la imagen.";
    exit();
}
$archivo_objetivo =fopen($carpeta_destino, $nombre_imagen, "r");

$contenido = fread($archivo_objetivo,$tamagno_imagen );
$contenido = addslashes($contenido);

fclose($archivo_objetivo);

$stmt = $conn->prepare("INSERT INTO Fotos (Nombre, Foto) VALUES (?, ?)");
$stmt->bind_param("sb", $nombre, $contenido);



?>