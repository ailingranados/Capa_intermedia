<?php
include('conexion.php');


$sqlConsulta = "SELECT 
                u.Usua_ID,
                u.Usua_Nombre,
                r.Role_Nombre,
                ui.UsIn_Foto
            FROM 
                Usuario u
            JOIN 
                Usuario_Info ui ON u.Usua_ID = ui.Usua_ID
                JOIN Roles r ON u.Role_ID = r.Role_ID
            WHERE
                u.Usua_Estatus = 1";

$resultConsulta = $conn->query($sqlConsulta);

if ($resultConsulta->num_rows > 0) {
    while ($row = $resultConsulta->fetch_assoc()) {
        echo '<div class="fila_ventas">';
        //echo '<img src="' . $row['UsIn_Foto'] . '" alt="Imagen usuario">';

       // Obtén el nombre de usuario de alguna manera
       $nombreUsuario = $row['Usua_ID']; // Esto es un ejemplo, debes obtener el nombre de usuario de acuerdo a tu lógica
       //echo $idd;
       if ($nombreUsuario) {
        // Escapa el nombre de usuario para asegurarte de que sea seguro para la URL
        $nombreUsuarioURL = urlencode($nombreUsuario);
    
       // Genera la URL de la imagen con el nombre de usuario como parámetro
         $urlImagen = "../../Funcion/mostrar2.php?id=$nombreUsuarioURL";

       // Muestra la imagen

       $usuario = $row['Usua_Nombre'];
        //echo "<img src='$urlImagen' alt='imagen no disponible '>";
        echo '<img src="' . $urlImagen . '" alt="Imagen usuario">';

        echo '<span>' . $row['Usua_ID'] . '</span>';
        echo '<span>' . ' ' . '</span>';
        echo '<span>' . $row['Usua_Nombre'] . '</span>';
        echo '<span>' . ' ' . '</span>';
        echo '<span>' . $row['Role_Nombre'] . '</span>';

        //echo '<a href="../../Funcion/activar_persona.php?usuario=' $nombreUsuario '" class="btn button_pink">Dar de alta</a>';
        echo '<a href="../../Funcion/desactivar_persona.php?usuario=' . $nombreUsuario . '" class="btn button_pink">Dar de baja</a>';

        echo '</div>';
    } else {
         echo "No se ha especificado un nombre de usuario.";
    }




        
    }
} else {
    //echo "No se encontraron usuarios dados de baja.";
}

$conn->close();
?>
