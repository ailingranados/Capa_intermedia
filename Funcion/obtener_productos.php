<?php

// Verifica si la variable 'validado' está presente en la solicitud
if (isset($_GET['validado'])) {
    $validado = $_GET['validado'];
    $usuario = $_GET['usuario'];
    $idd = $_GET['idd'];

    // Realiza la conexión a la base de datos y ejecuta la consulta según la opción
    include('conexion.php');

    switch ($validado) {
        case 0:
            $sql = "SELECT 
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
            break;
        case 1:
            $sql = "SELECT 
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
            Usuario u ON pi.Usua_ID = u.Usua_ID where  pi.PrIn_Validado = 1";
            break;
        case 2:
            $sql = "SELECT 
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
            Usuario u ON pi.Usua_ID = u.Usua_ID";
            break;
        default:
            echo "Opción no válida.";
            exit;
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Construye la tabla HTML con los resultados de la consulta
        echo "<tr>
                <th>Id de Vendedor</th>
                <th>Nombre de Vendedor</th>
                <th>Producto</th>
                <th>Existencia</th>
                <th>Categoria</th>
                <th>precio</th>
                <th>Estado</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            $estado = ($row["PrIn_Validado"] == 0) ? "No validado" : "Validado";
            $producto_id =  $row["Prod_ID"];
            echo "<tr class='fila-redireccion' data-prod-id='" . $row["Prod_ID"] . "'>";
        echo "
                    <th>" . $row["Usuario_ID"] . "</th>
                    <th>" . $row["Usuario_Nombre"] . "</th>
                    <th>" . $row["Prod_Nombre"] . "</th>
                    <th>" . $row["PrIn_Existencia"] . "</th>
                    <th>" . $row["Categoria_Nombre"] . "</th>
                    <th>$ " . $row["Prod_Precio"] . "</th>
                    <th> <a href='Modificar_Productos_admin.php?usuario=". $usuario ."&prod_id=".$producto_id."&usuarioid=". $idd ."'>". $estado . "</a> </th>
                </tr>";
        }
    } else {
        echo "No se encontraron resultados.";
    }

    // Cierra la conexión
    $conn->close();
} else {
    echo "Error: Se requiere el parámetro 'validado' en la solicitud.";
}
?>
