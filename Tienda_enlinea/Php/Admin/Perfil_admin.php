
<!-- Ailin Elizabeth Granados Cantu
Capa intermedia
7-sep-2023 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Suberbia</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Archivo diseño de pagina en css -->
    <link rel="stylesheet" type="text/css" href="../../Estilos/Diseño.css">

    <!-- Archivo de JavaScript para el comportamiento del código -->
    <script src="Logica.js"></script>

    <style>
      .col {
        text-align: center;
        height: 90%;
        width: 70%;
        /* background-color: white; */
        margin-left: 10px;
        margin-right: 10px;
      }
  
      .row {
        height: 200px;
        width: flex;
        margin: 3%;
      }
    </style>

<?php
// Obtén el valor de usuario pasado en la URL
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    echo "Usuario: " . $usuario;
} else {
    echo "No se recibió un nombre de usuario.";
}
?>



       <?php
    // Realizar la conexión a la base de datos
    include('../../Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
    $sqlConsulta = "SELECT 
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
                        u.Usua_Nombre = '$usuario'";

    $resultConsulta = $conn->query($sqlConsulta);

    if ($resultConsulta->num_rows > 0) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        $row = $resultConsulta->fetch_assoc();

        // Asignar los valores a variables para usar en el HTML
        $usuaNombre = $row["Usua_Nombre"];
        $usuaContra = $row["Usua_Contra"];
        $Role = $row["Role_ID"];
        $nombre = $row["UsIn_Nombre"];
        $apellidop = $row["UsIn_ApellidoPa"];
        $apellidom = $row["UsIn_ApellidoMa"];
        $pubpriv = $row["Usua_PubPriv"];
        $sexo = $row["UsIn_Sexo"];
        $telefono = $row["UsIn_Telefono"];
        $correo = $row["UsIn_Correo"];
        $fecha = $row["UsIn_Fecha_Nac"];
        // ... Continuar con los demás campos ...
    } else {
        echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
</head>
<body class="degradado" style="width: 100%; height: 100%;">

  <nav class="navbar navbar-expand-sm sticky-top">
    <div class="container-fluid">
      <!-- <a class="navbar-brand" href="#">Logo</a> -->
      <img src="../../IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="rounded-pill">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link" href="Pagina_inicio.php?usuario=<?php echo urlencode($usuario); ?>">Tienda</a>
          </li>
          <li class="nav-item">
         <a class="nav-link" href="Perfil_admin.php?usuario=<?php echo urlencode($usuario); ?>">Perfil</a>
          </li>

          <li class="nav-item">
         <a class="nav-link" href="Modificar_persona.php?usuario=<?php echo urlencode($usuario); ?>">Modificar Perfil</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../Landing_page.php">Salir</a>
          </li>


        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Search">
          <button class="btn " type="button">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <br>
  <div class="info-bar">
   
    <!-- Contenido de la barra de información -->
    <img src="../../IMAGENES/gato_enojado.jpg" class="img_usuario">
    <p style="color: #f2f2f2;">-----</p>
    <h2>Administrador <?php echo isset($usuario) ? $usuario : ''; ?></h2>
    <p style="color: #f2f2f2;">-----</p>
    </ul>
  </div>
<br><br><br>
<div class="data-column">
  <!-- Contenido de la columna de datos -->
  <h1 style="color: palevioletred;">Productos aprobados</h1>
</div>


<section class="fila_ventas">
  <div class="row">
    <div class="col info-bar">
      <p> 1</p>
    </div>
    <div class="col info-bar">
     
      <p> 2</p>
    </div>
    <div class="col info-bar">
      <p> 3</p>

    </div>
    <div class="col info-bar">
     
      <p> 4</p>
    </div>
    <div class="col info-bar ">
      
      <p> 5</p>
    </div>
    <button class="btn button_pink info-bar" type="button"> Ver mas productos</button>

  </div>

  <div class="clearfix"></div>

  <!-- Barra de informacion al final de la pagina -->
  <footer>
    © 2023 Tu Empresa. Todos los derechos reservados.
  </footer>
</body>
</html>
