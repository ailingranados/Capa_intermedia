CREATE VIEW Vista_modificacion_producto AS
SELECT 
    MAX(Log_ID) AS Log_ID,
    Prod_ID,
    MAX(Fecha_Modificacion) AS Fecha_Modificacion
FROM 
    Producto_Modificacion_Log 
GROUP BY 
    Prod_ID;
    
    SELECT Fecha_Modificacion FROM Vista_modificacion_producto where Prod_ID = 1;
    
    
   CREATE VIEW Vista_modificacion_usuario AS 
    SELECT 
    MAX(Log_ID) AS Log_ID,
    Usua_ID,
    MAX(Fecha_Actualizacion) AS Fecha_Modificacion
FROM 
    Usuario_Update_Log;
    
	SELECT Fecha_Modificacion FROM Vista_modificacion_usuario where Usua_ID = 21;




CREATE VIEW Vista_Usuario AS 
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
                Usuario_Info ui ON u.Usua_ID = ui.Usua_ID;
                
                select * from Vista_Usuario;
                
                
           select Usua_ID,
                Usua_Nombre,
                Usua_Contra,
                Usua_PubPriv,
                Usua_Estatus,
                Role_ID,
                Role_Nombre,
                Role_Estatus,
                UsIn_ID,
                UsIn_Nombre,
                UsIn_ApellidoPa,
                UsIn_ApellidoMa,
                UsIn_Sexo,
                UsIn_Telefono,
                UsIn_Correo,
                UsIn_Foto,
                UsIn_Fecha_Nac,
                UsIn_Fecha_Creac,
                UsIn_Estatus from Vista_Usuario;
                


CREATE VIEW Vista_Carrito AS 
SELECT
    c.Carr_ID,
    c.Usua_ID AS Carr_Usua_ID,
    c.Prod_ID AS Carr_Prod_ID,
    c.Carr_Fecha_Agregado,
    c.cantidad,
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
    c.Carr_Estatus = 1 
GROUP BY
    c.Prod_ID;