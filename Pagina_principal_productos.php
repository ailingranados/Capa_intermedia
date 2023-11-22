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
   // echo "Usuario: " . $usuario;
} else {
    //echo "No se recibió un nombre de usuario.";
}
if (isset($_GET['id'])) {
    //$usuario = $_GET['usuario'];
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


</head>


<nav class="nav_busqueda">
    <a href="Landing_page.html" style="text-decoration: none;"> <h1 class="Logo">Suberbia</h1> </a>


    

</nav>
<nav class="barra_acceso_rapido">

    <button class="boton_categoria" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
        Categorias
      </button>

      <ul>
       
     

      </ul>

      <ul>  <!-- Usuario  -->
  
      </ul>
</nav>

<body class="imagen-gatitos">

    <div class="wrapper-sin-fondo main-container">



  <div class="offcanvas offcanvas-start" id="demo">
    <div class="offcanvas-header">
      <h1 class="offcanvas-title">Bienvenid@ </h1>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">

      <!-- formulario de inicio de sesion -->
      <nav>
        <ul class="menu">
        <?php
          // Realizar la consulta a la base de datos
          include('Funcion/conexion.php');  // Incluye el archivo de conexión

          $sql = "SELECT Cate_ID, Cate_Nombre FROM Vista_Categorias";
          $result = $conn->query($sql);
           // Verificar si se obtuvieron resultados
           echo "<li>
           <button class='boton-menu boton-categoria' onclick=\"window.location.href='Pagina_principal_productos.php'\">
               <i class='bi bi-check2-circle'></i>Todos los productos
           </button>
       </li>";
           if ($result->num_rows > 0) {
          // Iterar sobre los resultados y generar las opciones del select
           while ($row = $result->fetch_assoc()) {
            $id_categoriaa = $row["Cate_ID"];
            $nombre_categoriaa = $row["Cate_Nombre"];
            echo "<li>
    <button class='boton-menu boton-categoria' onclick=\"window.location.href='Pagina_principal_productos.php?id=$id_categoriaa&nombrecategoria=$nombre_categoriaa'\">
        <i class='bi bi-check2-circle'></i>$nombre_categoriaa
    </button>
</li>";

           }
           } else {
           //echo "<option value=''>No hay opciones disponibles</option>";
           }
           ?>
            <li>

                
                        
            </li>
        </ul>
    </nav>

    </div>
  </div>


        <main class="main-content">
            
       
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

        $cotizable = $row3['Prod_Cotizable'];

        if ($cotizable == 1){
            echo "<div class='producto'>
        <img class='producto-imagen' src='data:image/*;base64,$archivoContenido' alt='cat'>
        <div class='producto-detalles'>
            <h3 class='producto-titulo'>$Nombre</h3>
            <h3 class='producto-titulo'>$categoria_producto</h3>";

           

            
           
            
           echo" <button class='producto-agregar' >Ver producto</button>
            <button class='producto-agregar' >Cotizar</button>


          
            </div>
    </div>";

        }else{

        


        echo "<div class='producto'>
        <img class='producto-imagen' src='data:image/*;base64,$archivoContenido' alt='cat'>
        <div class='producto-detalles'>
            <h3 class='producto-titulo'>$Nombre</h3>
            <h3 class='producto-titulo'>$categoria_producto</h3>
            <p class='producto-precio'>$$Precio </p>

            <form id='form' >
           
            <div class='col form-floating mt-3 mb-3 '>
              <input type='number' class='form-control' id='cantidad' name='cantidad' value= '1'>
              <label for='disponible'>Cantidad:</label>
            </div>
            <input type='submit' class='btn button_pink' value='Agregar'><br>
            </form> 
            
             <button class='producto-agregar' >Ver producto</button> 
           <!-- <button class='producto-agregar' >Agregar</button> -->

          
            </div>
    </div>";

    }
       
       
      }
    } else {
       // echo "No se encontraron resultados para el usuario '$usuario'.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
   
                
               
            </div>

           
         
        </main>

        
      
    


</body>
<!--
<footer class="wrapper-footer">
    © 2023 Tu Empresa. Todos los derechos reservados.
</footer>
-->
</html>