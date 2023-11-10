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


  <?php
// Obtén el valor de usuario pasado en la URL
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
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
    <a href="Landing_page.html" style="text-decoration: none;"> <h1 class="Logo">Suberbia</h1> </a>


    <form class="Barra_busqueda">
        <input class="palabra_busqueda me-2" type="text" placeholder="Search">
        <button class="button_pink" type="button">Search</button>
      </form>

</nav>

<nav class="barra_acceso_rapido">

    <button class="boton_categoria" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
        Categorias
      </button>

      <ul>
        <li><a href="Compras.html">Compras</a></li>
        <li><a href="Carrito.html">Carrito</a></li>
        <li><a href="#perfil">Perfil</a></li>

        

        <?php 
        
        if($Role == 3){
            echo "<li><a href='perfil'>Inventario</a></li>";
            echo "<li><a href='Registro_Productos.php?usuario=$usuario'>Crear producto</a></li>";

           // echo "<li><a href='Registro_Productos.php'>Crear producto</a></li>";
        }
        ?>


      </ul>

      <ul>  <!-- Usuario  -->
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
        <li> <a href="Inicio_sesion.html"><?php echo isset($usuario) ? $usuario : ''; ?></a></li>
 
      </ul>
</nav>

<body class="imagen-gatitos">

    <div class="wrapper-sin-fondo main-container">



  <div class="offcanvas offcanvas-start" id="demo">
    <div class="offcanvas-header">
      <h1 class="offcanvas-title">Bienvenido</h1>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">

      <!-- formulario de inicio de sesion -->
      <nav>
        <ul class="menu">
            <li>
                <button class="boton-menu boton-categoria active"> <i class="bi bi-check2-circle"></i>Todos los productos</button>
            </li>
            <li>
                <button class="boton-menu boton-categoria"> <i class="bi bi-check2-circle"></i>Abrigos</button>
            </li>
            <li>
                <button class="boton-menu boton-categoria"> <i class="bi bi-check2-circle"></i>Camisetas</button>
            </li>
            <li>
                <button class="boton-menu boton-categoria"> <i class="bi bi-check2-circle"></i>pantalones</button>
            </li>
            <li>
                <a class="boton-menu boton-carrito" href="Carrito.html"> <i class="bi bi-cart4"></i>Carrito <span
                        class="numerito">0</span></a>
            </li>
        </ul>
    </nav>

    </div>
  </div>


        <main class="main-content">
            <!-- titulo -->
            <h2 class="titulo-principal">Favoritos</h2>

            <div class="contenedor-productos_favoritos">

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_programa.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>

                    </div>
                </div>

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_programa.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>

                    </div>
                </div>

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_programa.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>

                    </div>
                </div>

                </div>
            
       
            <h2 class="titulo-principal">Todos los productos</h2>
            <div class="contenedor-productos">
                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>
                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>
            </div>
       
            <div class="contenedor-productos">
                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>

                <div class="producto">
                    <img class="producto-imagen" src="IMAGENES/gato_asustado.jpg" alt="cat">
                    <div class="producto-detalles">
                        <h3 class="producto-titulo">abrigo 01</h3>
                        <p class="producto-precio">$1000</p>
                        <button class="producto-agregar">Agregar</button>
                    </div>

                </div>
            </div>
       
         
        </main>

        
        <div class=" contenedor-derecho-carrito">
            <h2 class="titulo-carrito" style="background-color: white;">Carrito</h2>
            

                <div class="carrito-productos-vr">
                    <div class="carrito-producto-vr">
                        <img class="carrito-producto-imagen-vr" src="IMAGENES/gato_asustado.jpg" alt="">
     
                        <div class="carrito-producto-cantidad">
                            <br>
                            <small>Cantidad: </small>

                        </div>
                        <div class="carrito-producto-precio">

                        </div>

                    </div>

                </div>
            
            
                <div class="carrito-botones-vr">
                    <a href="Carrito.html">
                        <button class="carrito-ver">ver carrito</button>
                    </a>
                </div>
            

    </div>


</body>

<footer class="wrapper-footer">
    © 2023 Tu Empresa. Todos los derechos reservados.
</footer>

</html>