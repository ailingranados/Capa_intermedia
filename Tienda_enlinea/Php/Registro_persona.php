
<!-- Ailin Elizabeth Granados Cantu
Capa intermedia
7-sep-2023 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Suberbia</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="../validaciones/try.js"></script>
<!-- Boostrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Archivo diseño de pagina en css  -->
  <link rel="stylesheet" type="text/css" href="../Estilos/Diseño.css">

<!-- Archivo de java script para el comportamiento del codigo -->
      <!-- <script src="Logica.js"></script> -->
</head>


<body class="degradado" style="width: 100%; height: 100%;">
  <nav class="navbar navbar-expand-sm sticky-top">
    <div class="container-fluid">
      <!-- <a class="navbar-brand" href="#">Logo</a> -->
      <img src="../IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="rounded-pill">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="Landing_page.php">landing page</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Pagina_inicio.php">Inicio</a>
          </li>
       

        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Search">
          <button class="btn " type="button">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- degradado con datos para registro-->
    
      <div class="container p-5 my-5 contenedor-forms">
        
        <form  action="../Funcion/procesar_registro.php" method="post" enctype="multipart/form-data">
          <!--PEDIMOS LOS DATOS DE REGISTRO-->
          <!-- nombre y apellidos -->
          <div class="input-group ">
           
           <input type="text" class="form-control" placeholder="Nombre" name="Nombre">
          

         </div>
          <div class="input-group ">
           
    
            <input type="text" class="form-control" placeholder="Apellido Paterno" id="Apellidop" name="Apellidop">
            <input type="text" class="form-control" placeholder="Apellido Materno" id="ApellidoM" name="ApellidoM">

          </div>

          <!-- email -->
          <div class="col form-floating mt-3 mb-3 ">
            <input type="email" class="form-control" id="email" name="email" required autofocus>
            <label for="email">Email:</label>
          </div>

          <!-- Telefono -->
          <div class="col form-floating mt-3 mb-3 ">
            <input type="text" class="form-control" id="telefono" name="telefono" required autofocus>
            <label for="telefono">Telefono:</label>
          </div>
          <!-- usuario -->
          <div class="col form-floating mt-3 mb-3 ">
            <input type="text" class="form-control" id="username" name="usuario" required>
            <label for="usuario">Usuario:</label>
          </div>

       <!-- contraseña -->
        <div class="col form-floating mt-3 mb-3">
          <input type="password" class="form-control" id="password" name="pswd" required>
          <label for="pwd">Password</label>
        </div>
       
        <!-- Fecha de nacimiento -->
        <div class="col form-floating mt-3 mb-3">
          <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
          <label for="fecha_nac">Fecha de nacimiento</label>
        </div>
        <?php
          // Realizar la consulta a la base de datos
          include('../Funcion/conexion.php');  // Incluye el archivo de conexión

          $sql = "SELECT Role_ID, Role_Nombre FROM Roles";
          $result = $conn->query($sql);
        ?>

         <!-- Elegir de una lista, tipo de usuario -->
         <label for="rol" class="form-label">Elige tu tipo de cuenta</label>
         <select class="form-select" id="rol" name="rol-usuario">
          <?php
           // Verificar si se obtuvieron resultados
           if ($result->num_rows > 0) {
          // Iterar sobre los resultados y generar las opciones del select
           while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["Role_ID"] . "'>" . $row["Role_Nombre"] . "</option>";
           }
           } else {
           echo "<option value=''>No hay opciones disponibles</option>";
           }
           ?>
         <!--
           <option>Cliente</option>
           <option>Vendedor</option>
           <option>Administrador*</option>
           -->
         </select>

         <?php
         // Cerrar la conexión
         $conn->close();
         ?>

         <!-- Elegir de una lista, tipo privacidad -->
         <label for="rol" class="form-label">Elige tu tipo de usuario</label>
         <select class="form-select" id="rol2" name="rol-usuario2">
           <option value = 1>Publico</option>
           <option value = 0>Privado</option>
           
         </select>

          <!-- Elegir de una lista, Genero -->
          <label for="rol" class="form-label">Genero</label>
          <select class="form-select" id="genero" name="genero">
            <option>Femenino</option>
            <option>Masculino</option>
            <option>No-binario</option>
            <option>Prefiero no especificar</option>
          </select>

               
        <!-- imagen de usuario -->
        <div class="col form-floating mt-3 mb-3">
          <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" onchange="mostrarImagen(event)">
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
          <input type="submit" class="btn button_pink" value="REGISTRAR"><br>

        </form> 
      </div>
    
 
</body>

<!-- Barra de informacion al final de la pagina -->
<footer>
    © 2023 Tu Empresa. Todos los derechos reservados.
</footer>

</html>
