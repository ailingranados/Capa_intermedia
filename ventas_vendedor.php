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
  <link rel="stylesheet" type="text/css" href="CSS/Todas_las_paginas.css">

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
     <?php 
         echo " <li><a href='Perfil.php?usuario=$usuario'>Perfil</a></li>";
        if($Role == 3){
          echo "<li><a href='ventas_vendedor.php?usuario=$usuario'>Ventas</a></li>";
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
 
 
     </ul>
 </nav>

<body style="width: 100%; height: 100%;" class="imagen-gatitos">


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
    
  </tr>
  
  <?php 
    include('Funcion/conexion.php');

    // Consulta para obtener información del usuario 'geralt'
    $sqlConsulta2 = " SELECT 
    v.Vent_Fecha,  
    c.Cate_Nombre,
    pr.Prod_Nombre,
    cal.Cali_Valor,
    vp.Ventp_Precio_total,
    v.Usua_ID_Comp,
    vp.Cantidad,
    vp.Ventp_PrecioUnidad,
    vp.ventp_Prod_ID,
    pf.Usua_ID
FROM 
    Venta_por_producto vp
JOIN 
    Venta v ON vp.Venta_ID = v.Vent_ID
JOIN 
    producto_info pf ON vp.ventp_Prod_ID = pf.Prod_ID
JOIN 
    categorias c ON pf.Cate_ID = c.Cate_ID
JOIN 
    producto pr ON vp.ventp_Prod_ID = pr.Prod_ID
JOIN 
    calificacion cal ON v.Cali_ID = cal.Cali_ID where vp.Ventp_Estatus = 1 and pf.Usua_ID = $idd
    GROUP BY
  vp.ventp_Prod_ID, vp.Venta_ID   order by v.Vent_Fecha desc ";


                   

    $resultConsulta2 = $conn->query($sqlConsulta2);

    if ($resultConsulta2->num_rows > 0) {
      while ($row2 = $resultConsulta2->fetch_assoc()) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
        echo "<tr class='fila-redireccion' data-prod-id='" . $row2["ventp_Prod_ID"] . "'>";
        echo "
        <th>" .$row2["Vent_Fecha"]."</th>
        <th>" .$row2["Cate_Nombre"]."</th>
        <th>" .$row2["Prod_Nombre"]."</th>
        <th>" .$row2["Cali_Valor"]."</th>
        <th>" .$row2["Cantidad"]."</th>
        <th>" .$row2["Ventp_PrecioUnidad"]."</th>
        <th>$ " .$row2["Ventp_Precio_total"]."</th>
        </tr>
        ";
       
      }
    } else {
        //echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

  <!--
  <tr>
    <td>fecha</td>
    <td>Categoria</td>
    <td>Producto</td>
    <td>Calificación</td>
    <td>Precio</td>
   
  </tr>
  <tr>
    <td>fecha</td>
    <td>Categoria</td>
    <td>Producto</td>
    <td>Calificación</td>
    <td>Precio</td>
    
  </tr>
  <tr>
    <td>fecha</td>
    <td>Categoria</td>
    <td>Producto</td>
    <td>Calificación</td>
    <td>Precio</td>
   
  </tr>
  <tr>
    <td>fecha</td>
    <td>Categoria</td>
    <td>Producto</td>
    <td>Calificación</td>
    <td>Precio</td>
  
  </tr>
  -->
</table>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Agrega un listener de clic a todas las filas con la clase 'fila-redireccion'
    var filas = document.querySelectorAll('.fila-redireccion');
    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            // Obtiene el valor del atributo data-prod-id
            var prodId = this.getAttribute('data-prod-id');
            
            // Redirige a tu otro archivo PHP con el ID del producto
            window.location.href = 'Producto.php?prod_id=' + prodId+ '&usuario=<?php echo $usuario; ?>';
        });
    });
});
</script>
<br><br><br><br>

</body>


<footer class="wrapper-footer">
  © 2023 Suberbia. Todos los derechos reservados.
</footer>

</html>