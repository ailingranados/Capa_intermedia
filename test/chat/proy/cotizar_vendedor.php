
<!-- Ailin Elizabeth Granados Cantu
Capa intermedia
7-sep-2023 -->

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <title>Suberbia</title>


    <!--<link rel="stylesheet" type="text/css" href="../css/chatstyle.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/chatstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/barraSuperior.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../../../CSS/Todas_las_paginas.css">
   
    <!-- iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    

      <!-- Boostrap links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    /* Estilos básicos para el chat y la bandeja de chats */
    /* body {font-family: Arial, Helvetica, sans-serif;} */
   
    /*
    body {
        font-family: Arial, sans-serif;
    }
    */
    /* html{
background: var(--gris-bisonte);
background: radial-gradient(circle, var(--azul-bisonte) 0%, var(--rojo-bisonte) 100%);
} */


    .chat-sidebar {
        width: 30%;
        background-color: #f0f0f0;
        padding: 20px;
    }

    .chat-main {
        flex-grow: 1;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
    }

    .chat-list {
        list-style: none;
        padding: 0;
    }

    .chat-list-item {
        padding: 10px 0;
        border-bottom: 1px solid #ccc;
        cursor: pointer;
    }

    .chat-list-item:last-child {
        border-bottom: none;
    }

    .chat-message {
        background-color: #e2e2e2;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .chat-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .send-button {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #de638e;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100px;
        
    }
    .chat-icon {
        margin-right: 10px; /* Espacio entre la imagen y el texto */
        vertical-align: middle; /* Alinea verticalmente la imagen con el texto */
    
        /* display: block; */
        width: 30px;/* Ajusta el ancho según tus necesidades */
        height: 30px;/* Ajusta la altura según tus necesidades */
        
        /* position: relative; */
        background-color: #E4E8F0;
        border-radius: 50%;
    }
    

</style>

<?php
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $usuario2 = $_GET['id_persona'];
   // echo "Usuario: " . $usuario;
} else {
    echo "No se recibió un nombre de usuario.";
}
?>

<?php
    // Realizar la conexión a la base de datos
    include('../../../Funcion/conexion.php');

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


</nav>

<nav class="barra_acceso_rapido">

  

    <ul>
    <?php 
         echo " <li><a href='../../../Perfil.php?usuario=$usuario'>Perfil</a></li>";
        if($Role == 3){
            echo "<li><a href='../../../Inventario.php?usuario=$usuario'>Inventario</a></li>";
            echo "<li><a href='../../../Registro_Productos.php?usuario=$usuario'>Crear producto</a></li>";

           // echo "<li><a href='Registro_Productos.php'>Crear producto</a></li>";
        }else{
            echo " <li><a href='../../../Compras.php?usuario=$usuario'>Compras</a></li>
            <li><a href='../../../Carrito.php?usuario=$usuario'>Carrito</a></li>
            <li><a href='../../../PagP_usuario_registrado.php?usuario=$usuario'>Pagina principal</a></li>";

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
      $urlImagen = "../../../Funcion/mostrar2.php?id=$nombreUsuarioURL";

       // Muestra la imagen
        echo "<img src='$urlImagen' alt='Imagen desde la base de datos' style='width:40px;' class='rounded-pill'>";
    } else {
         echo "No se ha especificado un nombre de usuario.";
    }
    ?>
    



        <!--<img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="rounded-pill"> -->
        <li> <a href="Inicio_sesion.html"><?php echo isset($usuario) ? $usuario : ''; ?></a></li>
 
    </ul>
</nav>

<body style="width: 100%; height: 100%;" class="imagen-gatitos">

      <div class="container p-5 my-5 wrapper-sin-fondo" style="min-height: 80%;">
        
        <div class="chat-container">
        
       
          <div class="chat-main">
              
              <div id="chat-content">
                  <!-- Contenido del chat actual -->
              </div>
              <div class="usuario-seleccionado">
                  <div class="avatar ">
                  <?php 
          include('../../../Funcion/conexion.php');
          $sqlConsulta3 = "SELECT 
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
          u.Usua_ID = $usuario2";




// Consulta para obtener información del usuario 'geralt'



               

$resultConsulta3 = $conn->query($sqlConsulta3);

if ($resultConsulta3->num_rows > 0) {
   $row3 = $resultConsulta3->fetch_assoc();
    // Obtener el primer resultado (asumiendo que solo habrá uno)
    //$row2 = $resultConsulta2->fetch_assoc();
   
    $archivoContenido = base64_encode($row3['UsIn_Foto']); // asumiendo que la imagen se almacena en la base de datos como un blob
    //echo "<img src='data:image/*;base64,$archivoContenido' alt='$nombre' style='width:300px;height:300px;'>";
    $Nombre = $row3['Usua_Nombre'];
    $id_vendedor = $row3['Usua_ID'];

    

    echo "<img src='data:image/*;base64,$archivoContenido' alt='img' >
    <span class='estado-usuario enlinea'></span>
</div>
<div class='cuerpo'>
    <span>$Nombre</span>";



   
   
  
} else {
   // echo "No se encontraron resultados para el usuario '$usuario'.";
}

// Cerrar la conexión
$conn->close();?>
                      
                     <!-- <img src="../imagenes_usuarios/gatitochamba.jpg" alt="img" >
                      <span class="estado-usuario enlinea"></span>
                  </div>
                  <div class="cuerpo">
                      <span>Nombre de usuario</span> -->
                      <span>Usuario</span>
                      <a href="../../../seleccionar_cotizacion.php?usuario=<?php echo $usuario; ?>&usuario2=<?php echo $id_vendedor; ?>&usuario2nombre=<?php echo $Nombre; ?>">Cotizar</a>
                  </div>
                  <div class="opciones">
                    <!--
                      <ul>
                          <li>
                              <button type="button"><i class='bx bxs-video bx-flip-horizontal' ></i>
                          </li>
                          <li>
                              <button type="button"><i class='bx bxs-phone' ></i>
                          </li>
                      </ul>-->
                  </div>
              </div>
              <div class="panel-chat">
              <?php
                 // Realizar la consulta a la base de datos
                  include('../../../Funcion/conexion.php');  // Incluye el archivo de conexión
                  
                  

                  $sql = "SELECT Chat_Mensaje, Chat_Fecha, RemitenteID, Chat_ID
                  FROM Chat
                  WHERE (RemitenteID = $idd AND DestinatarioID = $id_vendedor)
                     OR (RemitenteID = $id_vendedor AND DestinatarioID = $idd)
                  ORDER BY Chat_Fecha asc";
                 $result = $conn->query($sql);
                ?>

                 <?php
                  // Verificar si se obtuvieron resultados
                 if ($result->num_rows > 0) {
                 // Iterar sobre los resultados y generar las opciones del select
                  while ($row = $result->fetch_assoc()) {
                  //echo "<option value='" . $row["Id"] . "'>" . $row["Nombre"] . "</option>";
                  if($row["RemitenteID"] == $idd){ //USUARIO LOGG DERECHA

                    $sql1 = "SELECT 
                        CONCAT(
                        TIMESTAMPDIFF(HOUR, Chat_Fecha, NOW()), ' horas ',
                        MOD(TIMESTAMPDIFF(MINUTE, Chat_Fecha, NOW()), 60), ' minutos'
                          ) AS diferencia_tiempo 
                          FROM Chat 
                           WHERE Chat_ID = " . $row["Chat_ID"];

                    $result1 = $conn->query($sql1);
                    
                    if ($result1->num_rows > 0) {
                        $row1 = $result1->fetch_assoc();
                        $diferenciaTiempo = $row1['diferencia_tiempo'];
                    
                        // Formatea la diferencia de tiempo según tus necesidades
                        // Por ejemplo, si quieres mostrar "hace X minutos"
                        
                        //echo "La diferencia de tiempo es: $diferenciaFormateada";
                    } else {
                       // echo "No se encontraron resultados.";
                    }
                                        
                    echo '
                    <div class="mensaje left">
                    <div class="cuerpo">
                         <img src="http://localhost/multimedia/png/user-foto-3.png" alt=""> 
                        <div class="texto">
                        '. $row["Chat_Mensaje"] .'
                            <span class="tiempo">
                                <i class= bx bx-time-five ></i>
                                '.$diferenciaTiempo.'
                                
                            </span>
                        </div>
                        <ul class="opciones-msj">
                            <li>
                                <button type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button">
                                    <i class="fas fa-share-square"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="avatar">';

                    
    // Obtén el nombre de usuario de alguna manera
     $nombreUsuario = $idd; // Esto es un ejemplo, debes obtener el nombre de usuario de acuerdo a tu lógica
     //echo $idd;
    if ($nombreUsuario) {
    // Escapa el nombre de usuario para asegurarte de que sea seguro para la URL
        $nombreUsuarioURL = urlencode($nombreUsuario);
    
       // Genera la URL de la imagen con el nombre de usuario como parámetro
      $urlImagen = "../../../Funcion/mostrar2.php?id=$nombreUsuarioURL";

       // Muestra la imagen
        echo "<img src='$urlImagen' alt=''  >";
    } else {
         echo "No se ha especificado un nombre de usuario.";
    }
  

                       // <img src="../img/user.jpeg" alt="img">
                       echo '
                    </div>
                </div>';

                  }if($row["RemitenteID"] == $id_vendedor){ //USUARIO ESCRITO IZQUIERDA


                    $sql1 = "SELECT 
                    CONCAT(
                    TIMESTAMPDIFF(HOUR, Chat_Fecha, NOW()), ' horas ',
                    MOD(TIMESTAMPDIFF(MINUTE, Chat_Fecha, NOW()), 60), ' minutos'
                      ) AS diferencia_tiempo 
                      FROM Chat 
                       WHERE Chat_ID = " . $row["Chat_ID"];

                    $result1 = $conn->query($sql1);
                    
                    if ($result1->num_rows > 0) {
                        $row1 = $result1->fetch_assoc();
                        $diferenciaTiempo = $row1['diferencia_tiempo'];
                    
                        // Formatea la diferencia de tiempo según tus necesidades
                        // Por ejemplo, si quieres mostrar "hace X minutos"
                        
                        //echo "La diferencia de tiempo es: $diferenciaFormateada";
                    } else {
                       // echo "No se encontraron resultados.";
                    }
                    
                    echo '
                    <div class="mensaje">
                    <div class="avatar">';
                     // Obtén el nombre de usuario de alguna manera
     $nombreUsuario = $id_vendedor; // Esto es un ejemplo, debes obtener el nombre de usuario de acuerdo a tu lógica
     //echo $idd;
    if ($nombreUsuario) {
    // Escapa el nombre de usuario para asegurarte de que sea seguro para la URL
        $nombreUsuarioURL = urlencode($nombreUsuario);
    
       // Genera la URL de la imagen con el nombre de usuario como parámetro
      $urlImagen = "../../../Funcion/mostrar2.php?id=$nombreUsuarioURL";

       // Muestra la imagen
        echo "<img src='$urlImagen' alt=''  >";
    } else {
         echo "No se ha especificado un nombre de usuario.";
    }
                        //<img src="../imagenes_usuarios/gatitochamba.jpg" alt="img">
                        echo '</div>
                    <div class="cuerpo">
                        
                        <div class="texto">
                            '. $row["Chat_Mensaje"] .'
                            
                            <span class="tiempo">
                                <i class= bx bx-time-five ></i>
                                '.$diferenciaTiempo.'
                            </span>
                        </div>

                    </div>
                </div> ';
                    
                  }



                  
                  

                  }
                }else {
                   //echo "<option value=''>No hay opciones disponibles</option>";
                }
                ?>

                  
                  <div class="panel-escritura" >
                      <form class="textarea" action="../../../Funcion/enviarm_vendedor.php" method="post">
                      <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                    <input type="hidden" name="vendedor" value="<?php echo $usuario2; ?>">
                    <input type="hidden" name="id_usuario" value="<?php echo $idd; ?>">
                    
                          <textarea placeholder="Escribir mensaje" name="mensaje"></textarea>
                          <button type="submit" class="enviar"> 
                         <i class='bx bxs-send'></i>
                        </button>
                      </form>
                  </div>
              </div>
          </div>
  
          
      </div>
      </div>

</body>

<!-- Barra de informacion al final de la pagina -->
<footer class="wrapper-footer">
    © 2023 Tu Empresa. Todos los derechos reservados.
</footer>

</html>
