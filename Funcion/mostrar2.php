<?php


include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Consulta para obtener la información del usuario y su rol
    $sqlSelectUsuario = "SELECT 
        u.Usua_ID,
        u.Usua_Nombre,
        u.Usua_Contra,
        u.Usua_PubPriv,
        u.Usua_Estatus,
        u.Role_ID,
        r.Role_Nombre,
        r.Role_Estatus,
        ui.UsIn_ID,
        ui.UsIn_Nombre,
        ui.UsIn_ApellidoPa,
        ui.UsIn_ApellidoMa,
        ui.UsIn_Sexo,
        ui.UsIn_Telefono,
        ui.UsIn_Correo,
        ui.UsIn_Foto,
        ui.UsIn_Fecha_Nac,
        ui.UsIn_Fecha_Creac,
        ui.UsIn_Estatus
    FROM 
        Usuario u
    JOIN 
        Roles r ON u.Role_ID = r.Role_ID
    JOIN 
        Usuario_Info ui ON u.Usua_ID = ui.Usua_ID
    WHERE
        u.Usua_ID = $idUsuario";

    $result = $conn->query($sqlSelectUsuario);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Aquí puedes acceder a los campos del usuario y su rol
        // Por ejemplo: $row['Usua_Nombre'], $row['Role_Nombre']
        $nombreImagen = $row['UsIn_Correo'];
        $imagenContenido = $row['UsIn_Foto'];
        // Mostrar la imagen
        header("Content-type: image/*");
        echo $imagenContenido;

        // Puedes realizar alguna acción con los datos obtenidos
        // ...

    } else {
        echo "No se encontró ningún usuario con ese ID.";
    }
} else {
    echo "No se especificó un ID de usuario.";
}

// Cerrar la conexión
$conn->close();




?>
