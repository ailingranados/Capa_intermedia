
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

      <!-- Boostrap links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

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
      <li><a href="Compras.html">Compras</a></li>
      <li><a href="Carrito.html">Carrito</a></li>

    </ul>

    <ul>
      <img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="img-usuario-navegacion">
      <li><a href="#">Usuario</a></li>

    </ul>
</nav>

<body style="width: 100%; height: 100%;" class="imagen-gatitos">

      <div class="container p-5 my-5 wrapper-sin-fondo" style="min-height: 80%;">
        
        <div class=" wrapper-inicio-sesion">


        <form action="Funcion/procesar_login.php" method="post">

          <!-- usuario -->
          <div class="col form-floating mt-3 mb-3 ">
            <input type="text" class="form-control" id="usuario"  required name="username">
            <label for="usuario">Usuario:</label>
          </div>

       <!-- contraseña -->
        <div class="col form-floating mt-3 mb-3">
          <input type="password" class="form-control" id="pwd"  required  name="password">
          <label for="pwd">Password</label>
        </div>


          <!-- Boton de submit -->
          <div class="wrapper">
            <input type="submit" class="boton-registrar" value="iniciar sesion"><br>
          </div>

        </form> 

      </div>
      </div>

</body>

<!-- Barra de informacion al final de la pagina -->
<footer class="wrapper-footer">
    © 2023 Tu Empresa. Todos los derechos reservados.
</footer>

</html>
