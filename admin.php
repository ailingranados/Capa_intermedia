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
  <link rel="stylesheet" href="CSS/Todas_las_paginas.css">
    <!-- Agrega el enlace a jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Archivo de JavaScript para el comportamiento del código -->
  <script src="Logica.js"></script>
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
 
 
  <form class="Barra_busqueda" action="Funcion/Busqueda.php"  method="post">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">

        <input class="palabra_busqueda me-2" type="text"  name = "busqueda" placeholder="Search">
        <button class="button_pink" type="submit">Search</button>
      </form>
 
 </nav>
 
 <nav class="barra_acceso_rapido">
 
   <button class="boton_categoria" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
       
     </button>
 
     <ul>
      <!--
       <li><a href="Compras.html">Compras</a></li>
       <li><a href="Carrito.html">Carrito</a></li>
       <li><a href="Inicio_sesion.html">Inicio Sesion</a></li> -->
       <?php     echo " <li><a href='Perfil.php?usuario=$usuario'>Perfil</a></li>";
         if($Role == 1){
          echo "<li><a href='admin.php?usuario=$usuario'>Administrador</a></li>";
         

         // echo "<li><a href='Registro_Productos.php'>Crear producto</a></li>";
      } ?>
 
 
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
       <img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="img-usuario-navegacion">
       <li><a href="Perfil_usuario_publico.html">Usuario</a></li>
  -->
     </ul>
 </nav>

<body style="width: 100%; height: 100%;" class="imagen-gatitos">


  <div style="margin: 30px;">
    <h1 class="titulo-inventario">Productos pendientes</h1>

    <form id="filtroForm" style="width: 20%;" class="contenedor-agrupar">
            <label for="consulta" class="form-label">Agrupar por</label>
            <select class="form-select" id="consulta" name="consulta">
                <option value="0">Invalidados</option>
                <option value="1">Validados</option>
                <option value="2">Todos</option>
            </select>
        </form>
  </div>

  <br>
  <table class="tabla-inventario" id="tablaProductos" class="tabla-inventario">

    <!--
    <tr>
    <th>Id de Vendedor</th>
    <th>Nombre de Vendedor</th>
      <th>Producto</th>
      <th>Existencia</th>
      <th>Categoria</th>
      <th>precio</th>
      <th>Estado</th>
    </tr>

    <?php 
    /*
    include('Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
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
   
    c.Cate_ID AS Categoria_ID,
    c.Cate_Nombre AS Categoria_Nombre,
    c.Cate_Descripcion AS Categoria_Descripcion,
    c.Cate_Estatus AS Categoria_Estatus,

    u.Usua_ID AS Usuario_ID,
    u.Usua_Nombre AS Usuario_Nombre

FROM 
    Producto p
JOIN 
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID
JOIN 
    Categorias c ON pi.Cate_ID = c.Cate_ID
JOIN 
    Usuario u ON pi.Usua_ID = u.Usua_ID where  pi.PrIn_Validado = 0";


                   

    $resultConsulta2 = $conn->query($sqlConsulta2);

    if ($resultConsulta2->num_rows > 0) {
      while ($row2 = $resultConsulta2->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
   
        if($row2["PrIn_Validado"] == 0){
          $estado2 = "No validado";
        }
        echo "<tr class='fila-redireccion' data-prod-id='" . $row2["Prod_ID"] . "'>";
        echo "
        <th>" .$row2["Usuario_ID"]."</th>
        <th>" .$row2["Usuario_Nombre"]."</th>
        <th>" .$row2["Prod_Nombre"]."</th>
        <th>" .$row2["PrIn_Existencia"]."</th>
        <th>" .$row2["Categoria_Nombre"]."</th>
        <th>$ " .$row2["Prod_Precio"]."</th>
        <th> " .$estado2."</th>
        </tr>
        ";
       
      }
    } else {
        //echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    */
    ?>
    -->
  </table>
  <script>
 // Función para cargar los datos de productos mediante AJAX
 function cargarProductos(validado) {
  $.ajax({
    url: 'Funcion/obtener_productos.php', // Reemplaza con la ruta correcta a tu script PHP
    type: 'GET',
    data: { validado: validado, usuario: '<?php echo $usuario; ?>', idd: '<?php echo $idd; ?>' },
    success: function(data) {
        // Inserta los datos en la tabla
        $('#tablaProductos').html(data);
    },
    error: function(error) {
        console.error('Error al cargar productos: ', error);
    }
});

  /*
            $.ajax({
                url: 'Funcion/obtener_productos.php', // Reemplaza con la ruta correcta a tu script PHP
                type: 'GET',
                data: { validado: validado },
                success: function(data) {
                    // Inserta los datos en la tabla
                    $('#tablaProductos').html(data);
                },
                error: function(error) {
                    console.error('Error al cargar productos: ', error);
                }
            });
            */
        }

        // Manejador de eventos para el cambio en el select
        $('#consulta').change(function() {
            var seleccion = $(this).val();
            
            switch (seleccion) {
                case '0':
                    cargarProductos(0);
                    break;
                case '1':
                    cargarProductos(1);
                    break;
                case '2':
                    cargarProductos(2);
                    break;
                default:
                    console.error('Opción no válida.');
                    break;
            }
        });

        // Cargar productos por defecto al cargar la página
        cargarProductos(0);

        document.addEventListener('DOMContentLoaded', function () {
    // Obtiene el valor de las variables PHP
    var usuario = <?php echo json_encode($usuario); ?>;
    var idd = <?php echo json_encode($idd); ?>;

    // Agrega un listener de clic a todas las filas con la clase 'fila-redireccion'
    var filas = document.querySelectorAll('.fila-redireccion');
    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            // Obtiene el valor del atributo data-prod-id
            var prodId = this.getAttribute('data-prod-id');
            
            // Redirige a tu otro archivo PHP con el ID del producto y las variables de PHP
            window.location.href = 'Modificar_Productos_admin.php?prod_id=' + prodId + '&usuario=' + usuario + '&usuarioid=' + idd;
        });
    });
});

  
/*
document.addEventListener('DOMContentLoaded', function () {
    // Agrega un listener de clic a todas las filas con la clase 'fila-redireccion'
    var filas = document.querySelectorAll('.fila-redireccion');
    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            // Obtiene el valor del atributo data-prod-id
            var prodId = this.getAttribute('data-prod-id');
            
            // Redirige a tu otro archivo PHP con el ID del producto
            window.location.href = 'Modificar_Productos_admin.php?prod_id=' + prodId+ '&usuario=<?php// echo $usuario; ?>'+ '&usuarioid=<?php //echo $idd; ?>';
        });
    });
});
*/

</script>

<!-- Usuarios -->

<div style="margin: 30px;">
    <h1 class="titulo-inventario">Usuarios</h1>

   
  </div>

  <br>
  <table class="tabla-inventario">
    <tr>
    <th>Id usuario</th>
    <th>Nombre de usuario</th>
      <th>Nombre</th>
      <th>Apellido Paterno</th>
      <th>Apellido Materno</th>
      <th>Rol</th>
      <th>Estado</th>
      <th>Última modificación</th>

    </tr>

    <?php 
    include('Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
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
    Usuario_Info ui ON u.Usua_ID = ui.Usua_ID where u.Role_ID != 1";


                   

    $resultConsulta3 = $conn->query($sqlConsulta3);

    if ($resultConsulta3->num_rows > 0) {
      while ($row3 = $resultConsulta3->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
        if($row3["Usua_Estatus"] == 1){
          $estado = "Alta";
        }if($row3["Usua_Estatus"] == 0){
          $estado = "Baja";
        }

        $id_usu =  $row3["Usua_ID"] ;

        $sql2 = "  SELECT Fecha_Modificacion FROM Vista_modificacion_usuario where Usua_ID = $id_usu";
        $result2 = $conn->query($sql2);
        $fechaa = "";
    
        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
                $fechaa = $row2['Fecha_Modificacion'];
                
                
               
            
        } 


        echo "<tr class='fila-redireccion elemento-deseado' data-prod-id='" . $row3["Usua_ID"] . "'>";
        echo "
        <th>" .$row3["Usua_ID"]."</th>
        <th>" .$row3["Usua_Nombre"]."</th>
        <th>" .$row3["UsIn_Nombre"]."</th>
        <th>" .$row3["UsIn_ApellidoPa"]."</th>
        <th>" .$row3["UsIn_ApellidoMa"]."</th>
        <th> " .$row3["Role_Nombre"]."</th>
        <th> " . $estado."</th>
        <th> " . $fechaa."</th>
        </tr>
        ";
       
      }
    } else {
        echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
    
  </table>
  <script>
document.addEventListener('DOMContentLoaded', function () {
    // Agrega un listener de clic a todas las filas con la clase 'fila-redireccion'
    var filas = document.querySelectorAll('.elemento-deseado');
    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            // Obtiene el valor del atributo data-prod-id
            var prodId2 = this.getAttribute('data-prod-id');
            
            // Redirige a tu otro archivo PHP con el ID del producto
            window.location.href = 'Modificar_persona_Admin.php?usuario2=' + prodId2+ '&usuario=<?php echo $usuario; ?>';
        });
    });
});
</script>

<div style="margin: 30px;">
    <h1 class="titulo-inventario">Categorias</h1>


   
  </div>

<br>
<table class="tabla-inventario">
  <tr>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Estado</th>
    <th>Accion</th>
    

    
  </tr>
  
  <?php 
    include('Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
    $sql12 = "SELECT Cate_ID, Cate_Nombre, Cate_Descripcion ,
    Cate_Estatus FROM Vista_Categorias";



                   

    $resultConsulta222 = $conn->query($sql12);

    if ($resultConsulta222->num_rows > 0) {
      while ($row222 = $resultConsulta222->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
        $id_categoriaa = $row222["Cate_ID"];
        $nombre_categoriaa = $row222["Cate_Nombre"];
        $descripcion_categoriaa = $row222["Cate_Descripcion"];
        $estado_categoriaa = $row222["Cate_Estatus"];


        echo "<tr class='' data-prod-id='" . $row222["Cate_ID"] . "'>";
        echo "
        <th>" .$nombre_categoriaa."</th>
        <th>" .$descripcion_categoriaa."</th>";
        if ($estado_categoriaa == 0){
          echo "<th>Inactivo</th>";
        }else{
          echo "<th>Activo</th>";
        }
        
        echo "<th> <a href='Modificar_categoria.php?usuario=". $usuario ."&categoria=".$id_categoriaa."'>Modificar</a> </th>
        </tr>
        ";
       
      }
    } else {
        //echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

</table>

<div style="margin: 30px;">
    <h1 class="titulo-inventario">Ventas</h1>


   
  </div>

<br>
<table class="tabla-inventario">
  <tr>
    <th>Fecha y hora</th>
    <th>Categoria</th>
    <th>Producto</th>
    <th>Calificación</th>
    <th>cantidad</th>
    <th>precio unitario</th>
    <th>Precio total</th>
    <th>Usuario vendedor</th>
    <th>Usuario comprador</th>


    
  </tr>
  
  <?php 
    include('Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
    $sqlConsulta2 = "  SELECT 
    Vent_Fecha,  
    Cate_Nombre,
    Prod_Nombre,
    Cali_Valor,
    Ventp_Precio_total,
    Usua_ID_Comp,
    Comprador_Nombre,
    PrIn_ID,
    Prod_ID,
    Vendedor_Nombre,
    PrIn_Descripcion,
    PrIn_Fecha_Creac,
    PrIn_Existencia,
    PrIn_Validado,
    PrIn_Estatus,
    Cantidad,
    Ventp_PrecioUnidad,
    ventp_Prod_ID
FROM VistaVentas
ORDER BY Vent_Fecha DESC; ";


                   

    $resultConsulta2 = $conn->query($sqlConsulta2);

    if ($resultConsulta2->num_rows > 0) {
      while ($row2 = $resultConsulta2->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
        echo "<tr class='' data-prod-id='" . $row2["ventp_Prod_ID"] . "'>";
        echo "
        <th>" .$row2["Vent_Fecha"]."</th>
        <th>" .$row2["Cate_Nombre"]."</th>
        <th>" .$row2["Prod_Nombre"]."</th>
        <th>" .$row2["Cali_Valor"]."</th>
        <th>" .$row2["Cantidad"]."</th>
        <th>" .$row2["Ventp_PrecioUnidad"]."</th>
        <th>$ " .$row2["Ventp_Precio_total"]."</th>
        <th>" .$row2["Vendedor_Nombre"]."</th>
        <th>" .$row2["Comprador_Nombre"]."</th>
        </tr>
        ";
       
      }
    } else {
        //echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

</table>

  <br><br><br><br>


</body>

<footer class="wrapper-footer">
  © 2023 Suberbia. Todos los derechos reservados.
</footer>
</html>