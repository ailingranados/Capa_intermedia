<?php
include('conexion.php');  // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password1 = $_POST['password'];

    $sql = "  SELECT Usua_ID,
    Usua_Nombre,
    Usua_Contra,
    Usua_PubPriv,
    Usua_Estatus,
    Role_ID,
    Role_Nombre,
    Role_Estatus,
    UsIn_ID,
    UsIn_Nombre,
    UsIn_ApellidoPa,
    UsIn_ApellidoMa,
    UsIn_Sexo,
    UsIn_Telefono,
    UsIn_Correo,
    UsIn_Foto,
    UsIn_Fecha_Nac,
    UsIn_Fecha_Creac,
    UsIn_Estatus from Vista_Usuario
            WHERE
                Usua_Nombre = '$username' AND Usua_Contra = '$password1' AND Usua_Estatus = 1";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        


        
        $row = $result->fetch_assoc();
        $rol_usuario = $row["Role_ID"];
        $rol_usuario2 = $row["Usua_PubPriv"];
        $usuario = $row["Usua_Nombre"];


        
        if ($rol_usuario == 1) {  //Admin
            header("Location: ../admin.php?usuario=$usuario");
        } elseif ($rol_usuario == 2) { //Usuario
            if ($rol_usuario2 == 1) {
                header("Location: ../PagP_usuario_registrado.php?usuario=$username");
            } else {
                header("Location: ../PagP_usuario_registrado.php?usuario=$username");
            }
        } elseif ($rol_usuario == 3) { //Vendedor
            header("Location: ../Inventario.php?usuario=$username");
        }
        
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>
