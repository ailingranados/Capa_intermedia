-- test

CREATE TABLE Videos (
    Video_ID INT AUTO_INCREMENT PRIMARY KEY,
    Video_Nombre VARCHAR(100) NOT NULL,
    Prod_ID int not null,
    Video_Archivo LONGBLOB NOT NULL,
    
    Video_Estatus BOOL NOT NULL DEFAULT 1,
	FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID)
);

CREATE TABLE Fotos_1 (
    Foto_ID INT AUTO_INCREMENT PRIMARY KEY,
    Foto_Nombre VARCHAR(100) NOT NULL,
    Prod_ID int not null,
    Foto_Archivo LONGBLOB NOT NULL,
    
    Foto_Estatus BOOL NOT NULL DEFAULT 1,
    FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID)

	
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
    Medi_Archivo  from Media where Prod_ID = 2 and TiMe_ID = 1;
SELECT Medi_ID, Prod_ID ,
    TiMe_ID ,
    Medi_Nombre_Archivo ,
    Medi_Archivo  from Media where Prod_ID = 2 and TiMe_ID = 1;
    
    
    
    
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
    v.Video_ID,
    v.Video_Nombre,
    v.Video_Archivo,
    v.Video_Estatus,
    f.Foto_ID,
    f.Foto_Nombre,
    f.Foto_Archivo,
    f.Foto_Estatus
FROM
    Producto p
JOIN
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID
LEFT JOIN
    Videos v ON p.Prod_ID = v.Prod_ID
LEFT JOIN
    Fotos_1 f ON p.Prod_ID = f.Prod_ID;


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
    Categorias c ON pi.Cate_ID = c.Cate_ID;
    
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
    Usuario u ON pi.Usua_ID = u.Usua_ID where p.Prod_ID = 9;
    
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
    Usuario u ON pi.Usua_ID = u.Usua_ID where PrIn_Validado = 0;



SELECT 
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
    Usuario_Info ui ON u.Usua_ID = ui.Usua_ID where u.Role_ID != 1;
