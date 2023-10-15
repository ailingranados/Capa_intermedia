<?php
include('conexion.php');  // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password1 = $_POST['password'];

    $sql = "SELECT 
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
                u.Usua_Nombre = '$username' AND u.Usua_Contra = '$password1'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rol_usuario = $row["Role_ID"];
        $rol_usuario2 = $row["Usua_PubPriv"];
        $usuario = $row["Usua_Nombre"];
        
        if ($rol_usuario == 1) {
            header("Location: ../Php/Admin/Perfil_admin.php?usuario=$usuario");
        } elseif ($rol_usuario == 2) {
            if ($rol_usuario2 == 1) {
                header("Location: ../Php/Usuario/Perfil_usuario_publico.php?usuario=$usuario");
            } else {
                header("Location: ../Php/Usuario_Privado/Perfil_usuario_privado.php?usuario=$usuario");
            }
        } elseif ($rol_usuario == 3) {
            header("Location: ../Php/Vendedor/Perfil_vendedor.php?usuario=$usuario");
        }
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>
