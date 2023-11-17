
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
      
    </button>

    <ul>
    <?php 
         echo " <li><a href='Perfil.php?usuario=$usuario'>Perfil</a></li>";
         if($Role == 1){
          echo "<li><a href='admin.php?usuario=$usuario'>Administrador</a></li>";

         // echo "<li><a href='Registro_Productos.php'>Crear producto</a></li>";
      }
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
      <img src="IMAGENES/logo_sin_fondo.png" alt="Logo" style="width:40px;" class="img-usuario-navegacion">
      <li><a href="Perfil_usuario_publico.html">Usuario</a></li>
      -->
    </ul>
</nav>

<body style="width: 100%; height: 100%;"  class="imagen-gatitos">
 
 
      <div class="container p-5 my-5 " style="max-width: 50%;">
        
        <div class="wrapper-registro">

  
          <form action="Funcion/Registrar_Producto.php"  method="post"  enctype="multipart/form-data">
          <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
          <input type="hidden" name="usuarioid" value="<?php echo $idd; ?>">


            <!--PEDIMOS LOS DATOS DE REGISTRO DEL PRODUCTO-->
            <!-- required en el input para datos requeridos -->
            <!-- nombre -->
            <div class="col form-floating mt-3 mb-3 ">
              <input type="text" class="form-control" id="nombre" name="nombre" required autofocus>
              <label for="nombre">Nombre del producto:</label>
            </div>
  
            <!-- descripcion del producto -->
            <div class="col form-floating mt-3 mb-3 ">
              <input type="text" class="form-control" id="descripcion" name="descripcion" required>
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
            echo "<option value='" . $row["Cate_ID"] . "'>" . $row["Cate_Nombre"] . "</option>";
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
  
             <p>Si no encuentras una categoria,<a href="Crear_categoria.php?usuario=<?php echo $usuario; ?>" >Creala</a> </p>
             <!--
             <div class="col form-floating mt-3 mb-3 ">
              <input type="text" class="form-control" id="categoria_nueva" name="categoria_nueva">
              <label for="categoria_nueva">Categoria nueva:</label>
            </div>
          -->
          <label for="checkbox">Cotizable:</label>
          <input type="checkbox" id="checkbox" name="checkbox">
            
            <div class="col form-floating mt-3 mb-3 ">
              <input type="number" class="form-control" id="precio" name="precio">
              <label for="precio">Precio:</label>
            </div>
            
            <div class="col form-floating mt-3 mb-3 ">
              <input type="number" class="form-control" id="disponible" name="disponible">
              <label for="disponible">Cantidad disponible:</label>
            </div>
  
            <!-- Boton de submit -->
            <br>
            <div class="wrapper">
            <input type="submit" class="boton-registrar" value="REGISTRAR"><br>
            </div>  
          </form> 

      </div>
      </div>
    
</body>

<footer class="wrapper-footer">
    © 2023 Suberbia. Todos los derechos reservados.
</footer>

</html>
