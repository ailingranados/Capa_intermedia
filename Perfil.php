
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
    <link rel="stylesheet" type="text/css" href="CSS/Diseño.css">
    <link rel="stylesheet" type="text/css" href="CSS/Todas_las_paginas.css">

    <!-- Archivo de JavaScript para el comportamiento del código -->
    <script src="Logica.js"></script>

    <?php
// Obtén el valor de usuario pasado en la URL
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
   // $prod_id = $_GET['prod_id'];
   // echo "Usuario: " . $usuario;
} else {
    echo "No se recibió un nombre de usuario.";
}
?>



       <?php
    // Realizar la conexión a la base de datos
    include('Funcion/conexion.php');

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
        $idd = $row["Usua_ID"];
        $usuaContra = $row["Usua_Contra"];
        $Role = $row["Role_ID"];
        $Role_nombre = $row["Role_Nombre"];
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


<nav class="nav_busqueda">
  <a href="Landing_page.html" style="text-decoration: none;"> <h1 class="Logo">Suberbia</h1> </a>
 
 
 <form class="Barra_busqueda">
   <input class="palabra_busqueda me-2" type="text" placeholder="Search">
   <button class="button_pink" type="button">Search</button>
 </form>
 
 </nav>
 
 <nav class="barra_acceso_rapido">
 
   <button class="boton_categoria" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
       
     </button>
 
     <ul>
     

        

     <?php 
         echo " <li><a href='Perfil.php?usuario=$usuario'>Perfil</a></li>";
         if($Role == 1){
          echo "<li><a href='admin.php?usuario=$usuario'>Administrador</a></li>";

         // echo "<li><a href='Registro_Productos.php'>Crear producto</a></li>";
      }
        if($Role == 3){
            echo "<li><a href='Inventario.php?usuario=$usuario'>Inventario</a></li>";
            echo "<li><a href='Registro_Productos.php?usuario=$usuario'>Crear producto</a></li>";

           // echo "<li><a href='Registro_Productos.php'>Crear producto</a></li>";
        }else{
            echo " <li><a href='Compras.php?usuario=$usuario'>Compras</a></li>
            <li><a href='Carrito.php?usuario=$usuario'>Carrito</a></li>
            <li><a href='PagP_usuario_registrado.php?usuario=$usuario'>Pagina principal</a></li>";

        }
        ?>
      
     </ul>
 
     <ul>
     <?php
    // Obtén el nombre de usuario de alguna manera
     $nombreUsuario = $idd; // Esto es un ejemplo, debes obtener el nombre de usuario de acuerdo a tu lógica
     //echo $idd;
    if ($nombreUsuario) {
    // Escapa el nombre de usuario para asegurarte de que sea seguro para la URL
        $nombreUsuarioURL = urlencode($nombreUsuario);
    
       // Genera la URL de la imagen con el nombre de usuario como parámetro
      $urlImagen = "Funcion/mostrar2.php?id=$nombreUsuarioURL";

       // Muestra la imagen
        echo "<img src='$urlImagen' alt='Imagen desde la base de datos' style='width:40px;' class='rounded-pill'>";
    } else {
         echo "No se ha especificado un nombre de usuario.";
    }
    ?>
    



        <!--<img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="rounded-pill"> -->
        <li> <a href="Inicio_sesion.php"><?php echo isset($usuario) ? $usuario : ''; ?></a></li>
     </ul>
 </nav>
   
<body  class="imagen-gatitos">

  <div class="contenedor-padre">

  <div class=" contenedor-lateral">
    <!-- Contenido de la barra de información -->
    <div class="contenedor-listas">

      
    <?php 
     if($Role == 2){
    include('Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
    
    $sqlConsulta2 = "SELECT   LiDe_ID ,
    Usua_ID ,
    LiDe_Nombre ,
    LiDe_Visible,
    LiDe_Estatus  from Lista_Deseos
                    WHERE
                    Usua_ID = $idd";


                   

    $resultConsulta2 = $conn->query($sqlConsulta2);

    if ($resultConsulta2->num_rows > 0) {
      while ($row3 = $resultConsulta2->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
       
       
        $Nombre = $row3['LiDe_Nombre'];
        $id_lista = $row3['LiDe_ID'];


        echo "<div class='lista'>
        <img class='producto-imagen' src='IMAGENES/Suberbia.png' alt='cat'>
        <div class='lista-detalles'>
          <h3 class='lista-titulo'> <a href='Lista.php?usuario=$usuario&lista=$id_lista'>$Nombre</a> </h3>
          

        </div>
    </div>";


       
       
      }
    } else {
       // echo "No se encontraron resultados para el usuario '$usuario'.";
    }
    echo "<div class='lista'>
    <img class='producto-imagen' src='IMAGENES/Suberbia.png' alt='cat'>
    <div class='lista-detalles'>
      <h3 class='lista-titulo'> <a href='crear_lista.php?usuario=$usuario'>Crear lista</a> </h3>
      

    </div>
</div>";

    // Cerrar la conexión
    $conn->close();
  }
  if($Role == 3){
    include('Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
    //echo "<h3> Chats </h3>";
    $sqlConsulta2 = "SELECT Chat_ID ,
    Chat_Fecha ,
    RemitenteID ,
    DestinatarioID ,
    Chat_Mensaje ,
    Chat_Msg_Estatus,
    
    u.Usua_ID,
    u.Usua_Nombre,
    u.Usua_PubPriv,
    u.Usua_Estatus,
    u.Role_ID,
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
    
    from Chat
    JOIN
    Usuario u ON RemitenteID = u.Usua_ID
    JOIN
    Usuario_Info ui ON u.Usua_ID = ui.Usua_ID where DestinatarioID = $idd 
    group by RemitenteID";


                   

    $resultConsulta2 = $conn->query($sqlConsulta2);

    if ($resultConsulta2->num_rows > 0) {
      while ($row3 = $resultConsulta2->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
       
       
        $id_usuario = $row3['RemitenteID'];
        $nombre = $row3['Usua_Nombre'];
        //$foto = $row3['UsIn_Foto'];

        $archivoContenido = base64_encode($row3['UsIn_Foto']); // asumiendo que la imagen se almacena en la base de datos como un blob




        echo "<div class='lista'>
        <img class='producto-imagen' src='data:image/*;base64,$archivoContenido' alt='cat'>
        <div class='lista-detalles'>
          <h3 class='lista-titulo'> <a href='test/chat/proy/cotizar_vendedor.php?usuario=$usuario&id_persona=$id_usuario'> chat con $nombre</a> </h3>
          

        </div>
    </div>";


       
       
      }
    } else {
       // echo "No se encontraron resultados para el usuario '$usuario'.";
    }
    

    // Cerrar la conexión
    $conn->close();
  }
    ?>

      
      

      </div>


</div>



  <div class=" alineacion_perfil contenedor-lateral">
   
      <img src="<?php echo $urlImagen; ?>" class="img_usuario">

<!-- <br><br> -->
  <div class="columna-datos-usuarion">
    <!-- Contenido de la columna de datos -->
    <ul>
        <li><a href="Modificar_persona_usuario.php?usuario=<?php echo $usuario; ?>&usuario2=<?php echo $idd; ?>">Editar</a></li>
        </ul>
    <?php
    
    if ($Role == 2){
      
      if($pubpriv==0){
        echo "<h2>Este perfil es privado</h1>";
        echo "<p1>Nombre de usuario: $usuario</p1><br>";
        echo "<p2>Nombre: $nombre</p1><br>";
      }else{
        
        echo "<p1>Nombre de usuario: $usuario</p1><br>";
        echo "<p2>Nombre: $nombre</p1><br>";
        echo "<p3>Apellido Paterno: $apellidop</p1><br>";
        echo "<p4>Apellido Materno: $apellidom</p1><br>";
        echo "<p5>Rol: $Role_nombre</p1><br>";
        echo "<p6>Sexo: $sexo</p1><br>";
        echo "<p7>Telefono: $telefono</p1><br>";
        echo "<p8>Correo: $correo</p1><br>";
        echo "<p9>Fecha de nacimiento: $fecha</p1><br>";

      }
    }else{
      
      echo "<p1>Nombre de usuario: $usuario</p1><br>";
      echo "<p2>Nombre: $nombre</p1><br>";
      echo "<p3>Apellido Paterno: $apellidop</p1><br>";
      echo "<p4>Apellido Materno: $apellidom</p1><br>";
      echo "<p5>Rol: $Role_nombre</p1><br>";
      echo "<p6>Sexo: $sexo</p1><br>";
      echo "<p7>Telefono: $telefono</p1><br>";
      echo "<p8>Correo: $correo</p1><br>";
      echo "<p9>Fecha de nacimiento: $fecha</p1><br>";

    }

   
    ?>
   
  </div>
  </div>

</div>
</body>

  <!-- Barra de informacion al final de la pagina -->
  <footer class="wrapper-footer">
    © 2023 Suberbia. Todos los derechos reservados.
</footer>
</html>
