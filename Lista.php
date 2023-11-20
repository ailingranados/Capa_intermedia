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
    <script src="https://kit.fontawesome.com/51dcded893.js" crossorigin="anonymous"></script>
    <?php
// Obtén el valor de usuario pasado en la URL
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $id_lista = $_GET['lista'];
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

    <form class="Barra_busqueda" action="Funcion/Busqueda.php"  method="post">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">

        <input class="palabra_busqueda me-2" type="text"  name = "busqueda" placeholder="Search">
        <button class="button_pink" type="submit">Search</button>
      </form>

</nav>

<nav class="barra_acceso_rapido">

    <button class="boton_categoria" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
        Categorias
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
        <!--
        <img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="rounded-pill">
        <li><a href="Inicio_sesion.html">Inicio Sesion</a></li>
        -->
      </ul>
</nav>

<body class=" imagen-gatitos">

    <div class="wrapper">

        <div class="offcanvas offcanvas-start" id="demo">
            <div class="offcanvas-header">
              <h1 class="offcanvas-title">Bienvenido</h1>
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
                    <!--
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
                     -->
                    <li>
                        <a class="boton-menu boton-carrito" href="Carrito.html"> <i class="bi bi-cart4"></i>Carrito <span
                                class="numerito">0</span></a>
                    </li>
                </ul>
            </nav>
        
            </div>
          </div>
        
        <!-- Donde encontraremos todos nuestros productos -->
        <main>
            <!-- titulo    disabled-->

           
            <?php 
    include('Funcion/conexion.php');

    
    $sqlConsulta33 = "SELECT   LiDP_ID ,
    LiDe_ID ,
    Prod_ID ,
    LiDP_Estatus  from Lista_Deseos_Prod where LiDe_ID =$id_lista and LiDP_Estatus = 1"; 
    $resultConsulta33 = $conn->query($sqlConsulta33);

    if ($resultConsulta33->num_rows > 0) {
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
        echo " <div class='contenedor-carrito '>
        <h2 class='fa-solid fa-cart-shopping fa-lg titulo-carrito'>$nombrelista</h2>
        
    </div>";
    } else {
       // echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    }else{
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
        echo " <div class='contenedor-carrito '>
        <h2 class='fa-solid fa-cart-shopping fa-lg titulo-carrito'>$nombrelista</h2>
        <p class='carrito-vacio '> $nombrelista esta vacio <i class='bi bi-emoji-frown'></i></p>
        <button class='carrito-acciones-comprar'onclick=\"window.location.href='Lista_agregar_productos.php?usuario=$usuario&lista=$id_lista'\">Agregar productos</button>



        <p class='carrito-comprado '>Muchas gracias por tu compra </p>
    </div>";
    } else {
       // echo "No se encontraron resultados para el usuario '$usuario'.";
    }
       
    }
    $conn->close();
    ?>
            <div class="contenedor-carrito disabled">
                <p class="carrito-vacio "> Tu carrito esta vacio <i class="bi bi-emoji-frown"></i></p>

       
                <p class="carrito-comprado disabled">Muchas gracias por tu compra </p>
            </div>
        </main>

    </div>

            
 <div class="wrapper-carrito"> 

 <?php 
    include('Funcion/conexion.php');

    
    $sqlConsulta3 = "   SELECT   l.LiDP_ID ,
    l.LiDe_ID ,
    l.Prod_ID ,
    l.LiDP_Estatus,  
    l.cantidad_lista, 

    lista.Usua_ID,
    
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
Lista_Deseos lista ON l.LiDe_ID = lista.LiDe_ID
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
    l.LiDe_ID =$id_lista and LiDP_Estatus = 1

GROUP BY
l.Prod_ID";


                   

    $resultConsulta3 = $conn->query($sqlConsulta3);

    if ($resultConsulta3->num_rows > 0) {
        echo "<div class='carrito-productos'>";
        $total = 0;
      while ($row3 = $resultConsulta3->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
       
        $archivoContenido = base64_encode($row3['Fotos']); // asumiendo que la imagen se almacena en la base de datos como un blob
        //echo "<img src='data:image/*;base64,$archivoContenido' alt='$nombre' style='width:300px;height:300px;'>";
        $Nombre = $row3['Prod_Nombre'];
        $Precio = $row3['Prod_Precio'];
        $id_producto = $row3['Prod_ID'];
        $id_creador_lista = $row3['Usua_ID'];
        $cantidad = $row3['cantidad_lista'];

        $subtotal = $cantidad * $Precio;

        $total = $subtotal + $total;

       

       echo " 
       <div class='carrito-producto'>
           <img class='carrito-producto-imagen' src='data:image/*;base64,$archivoContenido' alt=''>
           <div class='carrito-producto-titulo'>
                   <small>Titulo</small>
                   <h3>$Nombre</h3>
           </div>
           <div class='carrito-producto-cantidad'>
               <small>Cantidad</small>
               <p>$cantidad</p>
           </div>
           <div class='carrito-producto-precio'>
               <small>Precio</small>
               <p>$$Precio</p>
           </div>
           <div class='carrito-producto-subtotal'>
               <small>Subtotal</small>
               <p>$$subtotal</p>
           </div>";
           
           if($id_creador_lista == $idd){
           echo "  <button class='carrito-producto-eliminar'onclick=\"window.location.href='Funcion/quitar_elemento_lista.php?id=$id_producto&usuario=$usuario&idusuario=$id_lista'\"> <i class='bi bi-trash3'></i></button>";
           }
           echo "  </div>
       ";


       



       
       
      }
      echo "</div>
      <div class='carrito-acciones'>";

      if($id_creador_lista == $idd){
        echo "<div class='carrito-acciones-izq'>
      <button class='carrito-acciones-vaciar' onclick=\"window.location.href='Funcion/vaciar_lista.php?usuario=$usuario&idusuario=$id_lista'\">Vaciar Lista</button>
      </div>";

      }

      


      echo "<div class='carrito-acciones-derecha'>
          <div class='carrito-acciones-total'>
              <p>Total: </p>
              <p id='Total'>$$total</p>
          </div>

          <button class='carrito-acciones-comprar'onclick=\"window.location.href='pagar_Lista.php?usuario=$usuario&lista=$id_lista'\">Comprar</button>";
          if($id_creador_lista == $idd){
          echo "<button class='carrito-acciones-comprar'onclick=\"window.location.href='Lista_agregar_productos.php?usuario=$usuario&lista=$id_lista'\">Agregar productos</button>";
          }
      echo "</div>
  </div>";
    } else {
       // echo "No se encontraron resultados para el usuario '$usuario'.";
      
    }

    // Cerrar la conexión
    $conn->close();
    ?>
    

</div>   
</body>