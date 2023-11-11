-- test

CREATE TABLE Videos (
    Video_ID INT AUTO_INCREMENT PRIMARY KEY,
    Video_Nombre VARCHAR(100) NOT NULL,
    Video_Descripcion TEXT,
    Video_Archivo LONGBLOB NOT NULL,
    Fecha_Subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Video_Estatus BOOL NOT NULL DEFAULT 1
);
SELECT 
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
    m.Medi_ID,
    m.Medi_Nombre_Archivo,
    m.Medi_Archivo,
    m.Medi_Estatus,
    c.Cate_ID AS Categoria_ID,
    c.Cate_Nombre AS Categoria_Nombre,
    c.Cate_Descripcion AS Categoria_Descripcion,
    c.Cate_Estatus AS Categoria_Estatus,
    tm.TiMe_ID,
    tm.TiMe_Nombre,
    tm.TiMe_Estatus
FROM 
    Producto p
JOIN 
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID
JOIN 
    Media m ON p.Prod_ID = m.Prod_ID
JOIN 
    Categorias c ON pi.Cate_ID = c.Cate_ID
JOIN 
    Tipo_Media tm ON m.TiMe_ID = tm.TiMe_ID where pi.Usua_ID = 24 and p.Prod_ID = 1 and tm.TiMe_ID = 2;
    
    
SELECT 
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
    Categorias c ON pi.Cate_ID = c.Cate_ID where pi.Usua_ID = 24 and p.Prod_ID = 1 ;


select Prod_ID ,
    TiMe_ID ,
    Medi_Nombre_Archivo ,
    Medi_Archivo  from Media;
