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
  <style>/*
.wrapper-footer {
    display: grid;
    position: absolute;
    bottom: 0;

    background-color: var(--accent-200);
    align-items: center;
    justify-content: center;
    padding: 2rem;
    color: var(--clr-white);
}
body{
    min-height: 100%;
    
}
footer{
    position: relative;
    margin-top: -200px;
    height: 200px;
} */

#operacionesForm {
            display: flex;
            align-items: center;
        }

        #valor {
            margin-right: 10px;
        }

        .simbolo {
            cursor: pointer;
            font-size: 24px;
            margin-right: 10px;
        }
 </style>

  <?php
// Obtén el valor de usuario pasado en la URL
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $id_lista = $_GET['lista'];
   // echo "Usuario: " . $usuario;
} else {
    echo "No se recibió un nombre de usuario.";
}
if (isset($_GET['id'])) {
    $usuario = $_GET['usuario'];
    $id_categoria2 = $_GET['id'];
    $titulo = $_GET['nombrecategoria'];
    $sqlConsulta3 = " SELECT
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
    v.Video_ID,
    v.Video_Nombre,
    v.Video_Archivo,
    v.Video_Estatus,
    f.Foto_ID,
    f.Foto_Nombre,
    f.Foto_Archivo,
    f.Foto_Estatus,
    c.Cate_ID,
    c.Cate_Nombre,
    c.Cate_Descripcion,
    c.Cate_Estatus
FROM
    Producto p
JOIN
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID
LEFT JOIN
    Videos v ON p.Prod_ID = v.Prod_ID
LEFT JOIN
    Fotos_1 f ON p.Prod_ID = f.Prod_ID
LEFT JOIN
    Categorias c ON pi.Cate_ID = c.Cate_ID where p.Prod_Estatus = 1 and  pi.PrIn_Validado = 1 and  c.Cate_ID =  $id_categoria2
GROUP BY
    p.Prod_ID";
} else {
    $sqlConsulta3 = " SELECT
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
    v.Video_ID,
    v.Video_Nombre,
    v.Video_Archivo,
    v.Video_Estatus,
    f.Foto_ID,
    f.Foto_Nombre,
    f.Foto_Archivo,
    f.Foto_Estatus,
    c.Cate_ID,
    c.Cate_Nombre,
    c.Cate_Descripcion,
    c.Cate_Estatus
FROM
    Producto p
JOIN
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID
LEFT JOIN
    Videos v ON p.Prod_ID = v.Prod_ID
LEFT JOIN
    Fotos_1 f ON p.Prod_ID = f.Prod_ID
LEFT JOIN
    Categorias c ON pi.Cate_ID = c.Cate_ID where p.Prod_Estatus = 1 and  pi.PrIn_Validado = 1
GROUP BY
    p.Prod_ID";
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
       
        <!--<li><a href="#perfil">Perfil</a></li>-->

        

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
      <h1 class="offcanvas-title">Bienvenid@ <?php echo $usuario; ?></h1>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">

      <!-- formulario de inicio de sesion -->
      <nav>
        <ul class="menu">
        <?php
          // Realizar la consulta a la base de datos
          include('Funcion/conexion.php');  // Incluye el archivo de conexión

          $sql = "SELECT Cate_ID, Cate_Nombre FROM categorias";
          $result = $conn->query($sql);
           // Verificar si se obtuvieron resultados
           echo "<li>
           <button class='boton-menu boton-categoria' onclick=\"window.location.href='PagP_usuario_registrado.php?usuario=$usuario'\">
               <i class='bi bi-check2-circle'></i>Todos los productos
           </button>
       </li>";
           if ($result->num_rows > 0) {
          // Iterar sobre los resultados y generar las opciones del select
           while ($row = $result->fetch_assoc()) {
            $id_categoriaa = $row["Cate_ID"];
            $nombre_categoriaa = $row["Cate_Nombre"];
            echo "<li>
    <button class='boton-menu boton-categoria' onclick=\"window.location.href='PagP_usuario_registrado.php?id=$id_categoriaa&usuario=$usuario&nombrecategoria=$nombre_categoriaa'\">
        <i class='bi bi-check2-circle'></i>$nombre_categoriaa
    </button>
</li>";

           }
           } else {
           //echo "<option value=''>No hay opciones disponibles</option>";
           }
           ?>
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
            
       
            <h2 class="titulo-principal"><?php if (isset($_GET['id'])) {
                     $titulo = $_GET['nombrecategoria'];
                     echo $titulo;

                }else{
                     echo"Todos los productos";
                }?></h2>
            <div class="contenedor-productos">
            <?php 
    include('Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
    


                   

    $resultConsulta3 = $conn->query($sqlConsulta3);

    if ($resultConsulta3->num_rows > 0) {
      while ($row3 = $resultConsulta3->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
       
        $archivoContenido = base64_encode($row3['Foto_Archivo']); // asumiendo que la imagen se almacena en la base de datos como un blob
        //echo "<img src='data:image/*;base64,$archivoContenido' alt='$nombre' style='width:300px;height:300px;'>";
        $Nombre = $row3['Prod_Nombre'];
        $categoria_producto = $row3['Cate_Nombre'];
        $Precio = $row3['Prod_Precio'];
        $id_producto = $row3['Prod_ID'];


        echo "<div class='producto'>
        <img class='producto-imagen' src='data:image/*;base64,$archivoContenido' alt='cat'>
        <div class='producto-detalles'>
            <h3 class='producto-titulo'>$Nombre</h3>
            <h3 class='producto-titulo'>$categoria_producto</h3>
            <p class='producto-precio'>$$Precio </p>

            <form id='form' action='Funcion/agregar_producto_lista.php' method='post' enctype='multipart/form-data'>
            <input type='hidden' name='usuario' value='". $usuario."'>
            <input type='hidden' name='id' value='". $id_lista."'>
            <input type='hidden' name='producto' value='". $id_producto."'> 
            <div class='col form-floating mt-3 mb-3 '>
              <input type='number' class='form-control' id='cantidad' name='cantidad' value= '1'>
              <label for='disponible'>Cantidad:</label>
            </div>
            <input type='submit' class='btn button_pink' value='Agregar'><br>
            </form> 
            
            <button class='producto-agregar' onclick=\"window.location.href='Producto.php?id=$idd&usuario=$usuario&prod_id=$id_producto'\">Ver producto</button>
           <!-- <button class='producto-agregar' onclick=\"window.location.href='Funcion/agregar_carrito.php?id=$idd&usuario=$usuario&producto=$id_producto'\">Agregar</button> -->

          
            </div>
    </div>";


       
       
      }
    } else {
       // echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
   
                
               
            </div>

           
         
        </main>

        
        <div class=" contenedor-derecho-carrito">
           
                
                        
                    <?php 
    include('Funcion/conexion.php');
    $sqlConsulta2 = "SELECT   LiDe_ID ,
        Usua_ID ,
        LiDe_Nombre ,
        LiDe_Visible,
        LiDe_Estatus  from Lista_Deseos
                        WHERE
                        LiDe_ID = $id_lista";
    
    
                       
    
        $resultConsulta2 = $conn->query($sqlConsulta2);
    
        if ($resultConsulta2->num_rows > 0) {
            $row2 = $resultConsulta2->fetch_assoc();
            $nombrelista = $row2['LiDe_Nombre'];
            echo "<h2 class='titulo-carrito' style='background-color: white;'>$nombrelista</h2>     
            <div class='carrito-productos-vr'>";
        } else {
           // echo "No se encontraron resultados para el usuario '$usuario'.";
        }

    
    $sqlConsulta3 = " SELECT   l.LiDP_ID ,
    l.LiDe_ID ,
    l.Prod_ID ,
    l.LiDP_Estatus, 
    l.cantidad_lista, 
    
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
    
    GROUP_CONCAT(f.Foto_Archivo) AS Fotos,
    v.Video_ID,
    v.Video_Nombre,
    v.Video_Archivo,
    v.Video_Estatus,
    
    ct.Cate_ID,
    ct.Cate_Nombre,
    ct.Cate_Descripcion,
    ct.Cate_Estatus
     from 
     Lista_Deseos_Prod l
JOIN
    Producto p ON l.Prod_ID = p.Prod_ID
JOIN
    Producto_Info pi ON l.Prod_ID = pi.Prod_ID
LEFT JOIN
    Videos v ON p.Prod_ID = v.Prod_ID
LEFT JOIN
    Fotos_1 f ON p.Prod_ID = f.Prod_ID
LEFT JOIN
    Categorias ct ON pi.Cate_ID = ct.Cate_ID
    where 
LiDe_ID =$id_lista and LiDP_Estatus = 1

GROUP BY
l.Prod_ID";


                   

    $resultConsulta3 = $conn->query($sqlConsulta3);

    if ($resultConsulta3->num_rows > 0) {
        
           
       

      while ($row3 = $resultConsulta3->fetch_assoc()) {

        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
       
        $archivoContenido = base64_encode($row3['Fotos']); // asumiendo que la imagen se almacena en la base de datos como un blob
        //echo "<img src='data:image/*;base64,$archivoContenido' alt='$nombre' style='width:300px;height:300px;'>";
        $Nombre = $row3['Prod_Nombre'];
        $Precio = $row3['Prod_Precio'];
        $id_producto = $row3['Prod_ID'];
        $cantidad = $row3['cantidad_lista'];

        $Nombre_lista = $row3['Prod_Nombre'];

        

       echo "<div class='carrito-producto-vr'>
       <img class='carrito-producto-imagen-vr' src='data:image/*;base64,$archivoContenido'  alt=''>
     
       <div class='carrito-producto-cantidad'>
           <br>
           <small>$Nombre </small>

       </div>
       <div class='carrito-producto-precio'>
       <small>Cantidad: $cantidad </small>
       <small>$$Precio </small>
       </div>
       </div>";


       
       
      }
      
    } else {
        //echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

                

                </div>

            
                <div class="carrito-botones-vr">
                    <a href="Lista.php?usuario=<?php echo $usuario; ?>&lista=<?php echo $id_lista; ?>">
                        <button class="carrito-ver">ver lista</button>
                    </a>
                </div>
                

    </div>
    


</body>
<!--
<footer class="wrapper-footer">
    © 2023 Tu Empresa. Todos los derechos reservados.
</footer>
-->
</html>