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
   
  <!-- Archivo de JavaScript para el comportamiento del código -->
  <script src="Logica.js"></script>
  <?php
// Obtén el valor de usuario pasado en la URL
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $id_usuario2 = $_GET['usuario2'];
    $usuario2 = $_GET['usuario2nombre'];

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
      <!--
       <img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="img-usuario-navegacion">
       <li><a href="Perfil_usuario_publico.html">Usuario</a></li>
  -->
     </ul>
 </nav>

<body style="width: 100%; height: 100%;" class="imagen-gatitos">


  <div style="margin: 30px;">
    <h1 class="titulo-inventario">Productos para Cotizar</h1>

  </div>

  <br>
  <table class="tabla-inventario">
    <tr>
      <th>Producto</th>
      <th>Existencia</th>
      <th>Categoria</th>
      <th>precio</th>
      <th>Accion</th>

    </tr>

    <?php 
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
    c.Cate_Estatus AS Categoria_Estatus

FROM 
    Producto p
JOIN 
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID

JOIN 
    Categorias c ON pi.Cate_ID = c.Cate_ID where pi.Usua_ID = $idd and p.Prod_Cotizable = 1";


                   

    $resultConsulta2 = $conn->query($sqlConsulta2);

    if ($resultConsulta2->num_rows > 0) {
      
      while ($row2 = $resultConsulta2->fetch_assoc()) {
        $cantidaddd = 0.00;
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        //$row2 = $resultConsulta2->fetch_assoc();
        $producto_idd = $row2["Prod_ID"];
        
        $sql = "SELECT CalcularSumaVentasPorProducto($producto_idd) AS SumaVentasPorProducto;";
        $result = $conn->query($sql);
        
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cantidaddd = $row['SumaVentasPorProducto'];
                
                
                
            }
        } else {
            //echo "No se encontraron fotos.";
        }
        $id_productote = $row2["Prod_ID"];

        echo "<tr class='fila-redireccion' data-prod-id='" . $row2["Prod_ID"] . "'>";
        echo "
        <th>" .$row2["Prod_Nombre"]."</th>
        <th>" .$row2["PrIn_Existencia"]."</th>
        <th>" .$row2["Categoria_Nombre"]."</th>
        <th>$ " .$row2["Prod_Precio"]."</th>
        <th><a href='cotizar_precio_producto.php?prod_id=$id_productote&usuario=$usuario&usuarioid=$idd&usuarioid2=$id_usuario2&usuario2nombre=$usuario2'>Cotizar</a></th>

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
    var filas = document.querySelectorAll('.fila-redireccion');
    filas.forEach(function (fila) {
        fila.addEventListener('click', function () {
            // Obtiene el valor del atributo data-prod-id
            var prodId = this.getAttribute('data-prod-id');
            $id_usuario2
            // Redirige a tu otro archivo PHP con el ID del producto
            window.location.href = 'cotizar_precio_producto.php?prod_id=' + prodId + '&usuario=<?php echo $usuario;?>&usuarioid=<?php echo $idd;?>&usuarioid2=<?php echo $id_usuario2;?>';
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