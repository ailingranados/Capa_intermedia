
<!-- Ailin Elizabeth Granados Cantu
Capa intermedia
7-sep-2023 -->

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devide-width, initial-scale=1.0">
    <title>Suberbia</title>
    <link rel="stylesheet" href="CSS/Todas_las_paginas.css">
   
    <!-- iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- script de validacion de contraseña -->
    <script defer src="validacion.js"></script>
      <!-- Boostrap links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<?php
  if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario2'];
    $usuario2 = $_GET['usuario'];
    //echo "Usuario: " . $usuario;
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
                        u.Usua_ID = $usuario";

    $resultConsulta = $conn->query($sqlConsulta);

    if ($resultConsulta->num_rows > 0) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        $row = $resultConsulta->fetch_assoc();

        // Asignar los valores a variables para usar en el HTML
        $usuaNombre = $row["Usua_Nombre"];
        $usuaContra = $row["Usua_Contra"];
        $estado = $row["Usua_Estatus"];
        $Role = $row["Role_ID"];
        $NRole = $row["Role_Nombre"];
        $nombre = $row["UsIn_Nombre"];
        $apellidop = $row["UsIn_ApellidoPa"];
        $apellidom = $row["UsIn_ApellidoMa"];
        $pubpriv = $row["Usua_PubPriv"];
        $sexo = $row["UsIn_Sexo"];
        $telefono = $row["UsIn_Telefono"];
        $correo = $row["UsIn_Correo"];
        $fecha = $row["UsIn_Fecha_Nac"];
        
        // Obtener la imagen en formato blob y convertirla a una URL de datos
        $imagenBlob = $row["UsIn_Foto"];
        $imagenURL = 'data:image/jpeg;base64,' . base64_encode($imagenBlob);


        
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
      <img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="img-usuario-navegacion">
      <li><a href="Perfil_usuario_publico.html">Usuario</a></li>

    </ul>
</nav>

<body style="width: 100%; height: 100%;"  class="imagen-gatitos">
 
 
      <div class="container p-5 my-5 " style="max-width: 50%;">
        
        <div class="wrapper-registro">

        <form id="form" action="Funcion/editar_persona_individual.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="usuario2" value="<?php echo $usuario2; ?>">
        <input type="hidden" name="rolillo" value="<?php echo $Role; ?>">

        <div class="input-group ">
           
           <input type="text" class="form-control" placeholder="Nombre" name="Nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>" >
          

         </div>
          <div class="input-group ">
           
    
            <input type="text" class="form-control" placeholder="Apellido Paterno" id="Apellidop" name="Apellidop" value="<?php echo isset($apellidop) ? $apellidop : ''; ?>" >
            <input type="text" class="form-control" placeholder="Apellido Materno" id="ApellidoM" name="ApellidoM" value="<?php echo isset($apellidom) ? $apellidom : ''; ?>">

          </div>

          <!-- email -->
          <div class="col form-floating mt-3 mb-3 ">
            <input type="email" class="form-control" id="email" name="email" required autofocus value="<?php echo isset($correo) ? $correo : ''; ?>">
            <label for="email">Email:</label>
          </div>

          <!-- Telefono -->
          <div class="col form-floating mt-3 mb-3 ">
            <input type="text" class="form-control" id="telefono" name="telefono" required autofocus value="<?php echo isset($telefono) ? $telefono : ''; ?>">
            <label for="telefono">Telefono:</label>
          </div>
          <!-- usuario -->
          <div class="col form-floating mt-3 mb-3 ">
            <input type="text" class="form-control" id="usuario" name="usuario" required value="<?php echo isset($usuaNombre) ? $usuaNombre : ''; ?>" readonly> 
             <label for="usuario">Usuario:</label>
           </div>


       <!-- contraseña -->
        <div class="col form-floating mt-3 mb-3">
          <input type="password" class="form-control" id="pwd" name="pswd" required value="<?php echo isset($usuaContra) ? $usuaContra : ''; ?>">
          <label for="pwd">Password</label>
        </div>

        <!-- Fecha de nacimiento -->
        <div class="col form-floating mt-3 mb-3">
          <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required value="<?php echo isset($fecha) ? $fecha : ''; ?>">
          <label for="fecha_nac">Fecha de nacimiento</label>
        </div>
         <!--  tipo Rol -->
        <div class="col form-floating mt-3 mb-3 ">
            <input type="text" class="form-control" id="rol" name="rol-usuario" required value="<?php echo isset($NRole) ? $NRole : ''; ?>" readonly> 
             <label for="usuario">Rol:</label>
           </div>



         <!-- Elegir de una lista, tipo privacidad -->
         <label for="rol" class="form-label">Elige tu tipo de usuario</label>
         <select class="form-select" id="rol2" name="rol-usuario2">
           <option value = 1>Publico</option>
           <option value = 0>Privado</option>
           
         </select>

       <!-- Elegir de una lista, Genero -->
        <label for="genero" class="form-label">Género</label>
           <select class="form-select" id="genero" name="genero">
            <option value="Femenino" <?php echo ($sexo === 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
            <option value="Masculino" <?php echo ($sexo === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
            <option value="No-binario" <?php echo ($sexo === 'No-binario') ? 'selected' : ''; ?>>No-binario</option>
            <option value="Prefiero no especificar" <?php echo ($sexo === 'Prefiero no especificar') ? 'selected' : ''; ?>>Prefiero no especificar</option>
          </select>

               
        <!-- imagen de usuario -->
        <div class="col form-floating mt-3 mb-3">
          <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required onchange="mostrarImagen(event)" value="<?php echo isset($imagenURL) ? $imagenURL : ''; ?>">
          <label for="imagen">Imagen</label>
        </div>
        <img id="imagenMostrada" src="#" alt="Vista previa de la imagen" style="display: none; max-width: 100%; height: auto;">

        <script> 
         function mostrarImagen(event) {
         const input = event.target;
         const imgMostrada = document.getElementById('imagenMostrada');

          // Asegúrate de que se haya seleccionado un archivo
          if (input.files && input.files[0]) {
           const reader = new FileReader();

          reader.onload = function(e) {
            imgMostrada.src = e.target.result;
            imgMostrada.style.display = 'block';  // Muestra la imagen
          };

           reader.readAsDataURL(input.files[0]);  // Lee el archivo como una URL de datos
          }
          }

          </script>

          <!-- Boton de submit -->
          <br>
          <input type="submit" class="btn button_pink" value="Modificar"><br>

        </form> 
        <?php 
        if($estado == 1){
          echo "<a href='Funcion/desactivar_persona_admin.php?usuario=". $usuaNombre ."&usuario2=".$usuario2."' id='registroLink'>Dar de baja</a>";

        }else{
          echo "<a href='Funcion/activar_persona_admin.php?usuario=". $usuario ."&usuario2=".$usuario2."' id='registroLink'>Dar de Alta</a>";

        }
        ?>
        

      </div>
      </div>
    
</body>

<!-- Barra de informacion al final de la pagina -->
<footer class="wrapper-footer">
    © 2023 Suberbia. Todos los derechos reservados.
</footer>

</html>
