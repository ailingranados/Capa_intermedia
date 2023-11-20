
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
  
  <?php
// Obtén el valor de usuario pasado en la URL
if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $usuarioid = $_GET['usuarioid'];
    $producto = $_GET['prod_id'];
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
    Usuario u ON pi.Usua_ID = u.Usua_ID where p.Prod_ID = $producto";

    $resultConsulta = $conn->query($sqlConsulta);

    if ($resultConsulta->num_rows > 0) {
        // Obtener el primer resultado (asumiendo que solo habrá uno)
        $row = $resultConsulta->fetch_assoc();

        // Asignar los valores a variables para usar en el HTML
       
        $nombre = $row["Prod_Nombre"];
        $descripcion = $row["PrIn_Descripcion"];
        $categoria = $row["Categoria_ID"];
        $cotizable = $row["Prod_Cotizable"];
        $precio = $row["Prod_Precio"];
        $cantidad = $row["PrIn_Existencia"];
        $estado = $row["PrIn_Validado"];

        /*
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
        */
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
        
          echo "<li><a href='ventas_vendedor.php?usuario=$usuario'>Ventas</a></li>";
            echo "<li><a href='Inventario.php?usuario=$usuario'>Inventario</a></li>";
            echo "<li><a href='Registro_Productos.php?usuario=$usuario'>Crear producto</a></li>";

           // echo "<li><a href='Registro_Productos.php'>Crear producto</a></li>";
        
        ?>

    </ul>

    <ul>
    <?php
    // Obtén el nombre de usuario de alguna manera
     $nombreUsuario = $usuarioid; // Esto es un ejemplo, debes obtener el nombre de usuario de acuerdo a tu lógica
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

<body style="width: 100%; height: 100%;"  class="imagen-gatitos">
 
 
      <div class="container p-5 my-5 " style="max-width: 50%;">
        
        <div class="wrapper-registro">

  
          <form action="Funcion/editar_Producto_vendedor.php"  method="post"  enctype="multipart/form-data">
          <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
          <input type="hidden" name="producto" value="<?php echo $producto; ?>">


            <!--PEDIMOS LOS DATOS DE REGISTRO DEL PRODUCTO-->
            <!-- required en el input para datos requeridos -->
            <!-- nombre -->
            <div class="col form-floating mt-3 mb-3 ">
              <input type="text" class="form-control" id="nombre" name="nombre" required autofocus value="<?php echo $nombre; ?>" readonly>
              <label for="nombre">Nombre del producto:</label>
            </div>
  
            <!-- descripcion del producto -->
            <div class="col form-floating mt-3 mb-3 ">
              <input type="text" class="form-control" id="descripcion" name="descripcion" required value="<?php echo $descripcion; ?>">
              <label for="descripcion">Descripcion:</label>
            </div>
  
              <!-- imagenes del producto (minimo 1) -->
          <div class="col form-floating mt-3 mb-3">
            <input type="file" class="form-control" id="producto_1" name="producto_1" accept="image/*" required>
            <label for="producto_1">Imagen 1 del producto</label>
          </div>

          <div class="col form-floating mt-3 mb-3">
            <input type="file" class="form-control" id="producto_1" name="producto_2" accept="image/*" required>
            <label for="producto_1">Imagen 2 del producto</label>
          </div>
  
          <!-- video del producto (minimo 1) -->
          <div class="col form-floating mt-3 mb-3">
            <input type="file" class="form-control" id="producto_2" name="producto_3" accept="video/*" required>
            <label for="producto_2">Video del producto</label>
          </div>

          <?php
          // Realizar la consulta a la base de datos
          include('Funcion/conexion.php');  // Incluye el archivo de conexión

          $sql = "SELECT Cate_ID, Cate_Nombre FROM categorias";
          $result = $conn->query($sql);
        ?>

         <!-- Elegir de una lista, tipo de usuario -->
         <label for="rol" class="form-label">Elige la categoria</label>
         <select class="form-select" id="rol" name="categoria">
          <?php
            // Verificar si se obtuvieron resultados
             if ($result->num_rows > 0) {
            // Iterar sobre los resultados y generar las opciones del select
             while ($row = $result->fetch_assoc()) {
             $selected = ($row["Cate_ID"] == $categoria) ? "selected" : "";
              echo "<option value='" . $row["Cate_ID"] . "' $selected>" . $row["Cate_Nombre"] . "</option>";
             }
            } else {
             echo "<option value=''>No hay opciones disponibles</option>";
            }
          /*
           // Verificar si se obtuvieron resultados
           if ($result->num_rows > 0) {
          // Iterar sobre los resultados y generar las opciones del select
           while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["Cate_ID"] . "'>" . $row["Cate_Nombre"] . "</option>";
           }
           } else {
           echo "<option value=''>No hay opciones disponibles</option>";
           }
           */
           ?>
         
         </select>

         <?php
         // Cerrar la conexión
         $conn->close();
         ?>

  
             <!-- Elegir de una lista, Categoria (al menos 1)-->
             <!--
             <label for="categoria" class="form-label">Elige la Categoria</label>
             <select class="form-select" id="categoria" name="categoria">
               <option>Mascotas</option>
               <option>Alimentos</option>
               <option>Ropa</option>
               <option>Papeleria</option>
               <option>Tecnologia</option>
             </select>
             <br>
  -->
             <!--
             <p>Si no encuentras una categoria,<a href="Crear_categoria.php?usuario=<?php// echo $usuario; ?>" >Creala</a> </p>
          -->
             <!--
             <div class="col form-floating mt-3 mb-3 ">
              <input type="text" class="form-control" id="categoria_nueva" name="categoria_nueva">
              <label for="categoria_nueva">Categoria nueva:</label>
            </div>
          -->
            <label for="checkbox">Cotizable:</label>
            <input type="checkbox" id="checkbox" name="checkbox" value="1" <?php echo ($cotizable == 1) ? 'checked' : ''; ?>>

            
            <div class="col form-floating mt-3 mb-3 ">
              <input type="number" class="form-control" id="precio" name="precio"  value="<?php echo $precio; ?>">
              <label for="precio">Precio:</label>
            </div>
            
            <div class="col form-floating mt-3 mb-3 ">
              <input type="number" class="form-control" id="disponible" name="disponible"  value="<?php echo $cantidad; ?>">
              <label for="disponible">Cantidad disponible:</label>
            </div>
  
            <!-- Boton de submit -->
            <br>
            <div class="wrapper">
            <input type="submit" class="boton-registrar" value="REGISTRAR"><br>
            </div>  
          </form> 
          <?php 
        if($estado == 1){
          echo "<a href='Funcion/invalidar_producto_admin.php?usuario=". $usuario ."&producto=".$producto."' id='registroLink'>Invalidar</a>";

        }else{
          echo "<a href='Funcion/validar_producto_admin.php?usuario=". $usuario ."&producto=".$producto."' id='registroLink'>Validar</a>";

        }
        ?>

      </div>
      </div>
    
</body>

<footer class="wrapper-footer">
    © 2023 Suberbia. Todos los derechos reservados.
</footer>

</html>
