<!-- Ailin Elizabeth Granados Cantu
Capa intermedia
06-nov-2023 -->

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

  <style>
    <style>
    .contenedor-derecho-carrito {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .contenedor-derecho-carrito img {
      width: 100%;
      max-width: 300px;
      /* ajusta el ancho máximo según sea necesario */
    }

    * {
      box-sizing: border-box
    }


    .mySlides {
      display: none
    }

    img {
      vertical-align: middle;
    }

    .slideshow-container {
      max-width: 500px;
      position: relative;
      margin: auto;
    }

   

    /* Next & previous buttons */
    .prev,
    .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      width: auto;
      margin-top: -22px;
      padding: 16px;
      color: white;
      font-weight: bold;
      font-size: 18px;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0;
      user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }

    /* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}
/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}
    /* The dots/bullets/indicators */
    .dot {
      cursor: pointer;
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
      background-color: #717171;
    }


  </style>
  </style>
  <?php
// Obtén el valor de usuario pasado en la URL
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $prod_id = $_GET['prod_id'];
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

  <a href="Landing_page.html" style="text-decoration: none;">
    <h1 class="Logo">Suberbia</h1>
  </a>


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
    <!--
    <img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="img-usuario-navegacion">
    <li><a href="#">Usuario</a></li>
  -->
  </ul>
</nav>

<body style="width: 100%; height: 100%;" class="imagen-gatitos">


<div class="main-container">
    <main class="main-content">

        <div class="producto-descripcion">

          <?php 
          include('Funcion/conexion.php');
          $sqlConsulta2 = "SELECT 
    p.Prod_ID,
    p.Prod_Nombre,
    p.Prod_Precio,
    p.Prod_Cotizable,
    p.Prod_Estatus,
    pi.PrIn_ID,
    pi.Usua_ID AS PrIn_Usua_ID,
    pi.Cate_ID AS PrIn_Cate_ID,
    pi.PrIn_Descripcion,
    pi.PrIn_Fecha_Creac,
    pi.PrIn_Existencia,
    pi.PrIn_Validado,
    pi.PrIn_Estatus,
    m.Medi_ID,
    m.Medi_Nombre_Archivo,
    m.Medi_Archivo,
    m.Medi_Estatus,
    c.Cate_ID AS Categoria_ID,
    c.Cate_Nombre AS Categoria_Nombre,
    c.Cate_Descripcion AS Categoria_Descripcion,
    c.Cate_Estatus AS Categoria_Estatus,
    tm.TiMe_ID,
    tm.TiMe_Nombre,
    tm.TiMe_Estatus
FROM 
    Producto p
JOIN 
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID
JOIN 
    Media m ON p.Prod_ID = m.Prod_ID
JOIN 
    Categorias c ON pi.Cate_ID = c.Cate_ID
JOIN 
    Tipo_Media tm ON m.TiMe_ID = tm.TiMe_ID where pi.Usua_ID = $idd and p.Prod_ID = $prod_id  and tm.TiMe_ID = 2";

    $resultConsulta2 = $conn->query($sqlConsulta2);

    if ($resultConsulta2->num_rows > 0) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        $row2 = $resultConsulta2->fetch_assoc();
        $videoArchivo = $row2["Medi_Archivo"];

        echo "
    <h2>" . $row2["Prod_Nombre"] . "</h2>
    <p>" . $row2["PrIn_Descripcion"] . "</p>
    <p>Precio: $ " . number_format($row2["Prod_Precio"], 2) . "</p>
    <p>Existencia: " . $row2["PrIn_Existencia"] . "</p>
    
    <p>Categoria: " . $row2["Categoria_Nombre"] . "</p>";


    if (!empty($videoArchivo)) {
      echo '<video width="640" height="360" controls>';
      echo '<source src="data:video/mp4;base64,' . base64_encode($videoArchivo) . '" type="video/mp4">';
      echo 'Tu navegador no soporta el elemento de video.';
      echo '</video>';
  } else {
      echo '<p>No hay archivo de video disponible.</p>';
  }

    

        // Asignar los valores a variables para usar en el HTML
        
        // ... Continuar con los demás campos ...
    } else {
        echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();?>

         
          </div>

    </main>

    <div class="producto-img">

    
      <div class="slideshow-container">
      <div class="mySlides">
        <div class="numbertext">1 / 3</div>
        <img src="IMAGENES/gato_asustado.jpg" style="width:100%">
       
      </div>

      <div class="mySlides">
        <div class="numbertext">2 / 3</div>
        <img src="IMAGENES/gato_enojado.jpg" style="width:100%">
        
      </div>

      <div class="mySlides">
        <div class="numbertext">3 / 3</div>
        <img src="IMAGENES/Gato_mochila.jpg" style="width:100%">
        
      </div>

      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <!-- The dots/circles -->
    <div style="text-align:center">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>

  
    <?php
    /*
    // Obtén el nombre de usuario de alguna manera
     $nombreUsuario = $prod_id; // Esto es un ejemplo, debes obtener el nombre de usuario de acuerdo a tu lógica
     //echo $idd;
    if ($nombreUsuario) {
    // Escapa el nombre de usuario para asegurarte de que sea seguro para la URL
        $nombreUsuarioURL = urlencode($nombreUsuario);
    
       // Genera la URL de la imagen con el nombre de usuario como parámetro
      $urlImagen = "Funcion/mostrar_producto.php?id=$nombreUsuarioURL";

       // Muestra la imagen
        echo "<img src='$urlImagen'alt='Producto' class='img-fluid'>";
    } else {
         echo "No se ha especificado un nombre de usuario.";
    }
    */
    ?>
      
      
      <!--<img src="IMAGENES/Gato_mochila.jpg" alt="Producto" class="img-fluid">-->
    </div>
    <script>
   let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
  </script>

    
    

              
  <div class="producto-recomendaciones">
    <h2 class="titulo-carrito" style="background-color: white;">Productos</h2>
    <h2 class="titulo-carrito" style="background-color: white; font-size: large;">recomendados</h2>
 

        <div class="carrito-productos-vr">
            <div class="carrito-producto-vr">
                <img class="carrito-producto-imagen-vr" src="IMAGENES/gato_asustado.jpg" alt="">

                <div class="carrito-producto-cantidad">
                    <br>
                    <small>Titulo producto </small>

                </div>
                <div class="carrito-producto-precio">

                </div>

            </div>

        </div>
    

    

</div>

  </div>

</body>

<footer class="wrapper-footer">
  © 2023 Tu Empresa. Todos los derechos reservados.
</footer>

</html>