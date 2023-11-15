select * from carrito where Usua_ID = and Carr_Estatus = 1;
select * from producto;

select * from usuario;
SELECT
    c.Carr_ID,
    c.Usua_ID AS Carr_Usua_ID,
    c.Prod_ID AS Carr_Prod_ID,
    c.Carr_Fecha_Agregado,
    c.Carr_Estatus,
    
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
    ct.Cate_Estatus,
     (SELECT COUNT(DISTINCT Carr_ID)as contador FROM Carrito  WHERE Prod_ID = c.Prod_ID and Usua_ID = 26 and Carr_Estatus = 1) AS CantidadRepetidos
FROM
    Carrito c
JOIN
    Producto p ON c.Prod_ID = p.Prod_ID
JOIN
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID
LEFT JOIN
    Videos v ON p.Prod_ID = v.Prod_ID
LEFT JOIN
    Fotos_1 f ON p.Prod_ID = f.Prod_ID
LEFT JOIN
    Categorias ct ON pi.Cate_ID = ct.Cate_ID
WHERE
    c.Carr_Estatus = 1 and c.Usua_ID = 26
GROUP BY
    c.Prod_ID;
SELECT COUNT(DISTINCT Carr_ID)as contador FROM Carrito  WHERE Prod_ID = 8 and Usua_ID = 26 and Carr_Estatus = 1







