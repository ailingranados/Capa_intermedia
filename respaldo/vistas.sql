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

GROUP BY
    c.Prod_ID;
    
    
    select Carr_ID,
    Carr_Usua_ID,
    Carr_Prod_ID,
    Carr_Fecha_Agregado,
    cantidad,
    Carr_Estatus,
    
    Prod_ID,
    Prod_Nombre,
    Prod_Precio,
    Prod_Cotizable,
    Prod_Estatus,
    
    PrIn_ID,
	PrIn_Usua_ID,
    PrIn_Cate_ID,
    PrIn_Descripcion,
    PrIn_Fecha_Creac,
    PrIn_Existencia,
    PrIn_Validado,
    PrIn_Estatus,
    
     Fotos,
    Video_ID,
    Video_Nombre,
    Video_Archivo,
    Video_Estatus,
    
    Cate_ID,
    Cate_Nombre,
    Cate_Descripcion,
    Cate_Estatus
    from Vista_Carrito;
    
    
    SELECT Carr_ID,
    Carr_Usua_ID,
    Carr_Prod_ID,
    Carr_Fecha_Agregado,
    cantidad,
    Carr_Estatus,
    
    Prod_ID,
    Prod_Nombre,
    Prod_Precio,
    Prod_Cotizable,
    Prod_Estatus,
    
    PrIn_ID,
	PrIn_Usua_ID,
    PrIn_Cate_ID,
    PrIn_Descripcion,
    PrIn_Fecha_Creac,
    PrIn_Existencia,
    PrIn_Validado,
    PrIn_Estatus,
    
     Fotos,
    Video_ID,
    Video_Nombre,
    Video_Archivo,
    Video_Estatus,
    
    Cate_ID,
    Cate_Nombre,
    Cate_Descripcion,
    Cate_Estatus
    from Vista_Carrito
WHERE
     Carr_Usua_ID = 21;
     
     
     
     
     CREATE VIEW Vista_Categorias AS 

     SELECT Cate_ID, Cate_Nombre, Cate_Descripcion ,
    Cate_Estatus FROM categorias;
     
	SELECT Cate_ID, Cate_Nombre, Cate_Descripcion ,
    Cate_Estatus FROM Vista_Categorias;



CREATE VIEW VistaVentas AS
SELECT 
    v.Vent_Fecha,  
    c.Cate_Nombre,
    pr.Prod_Nombre,
    cal.Cali_Valor,
    vp.Ventp_Precio_total,
    v.Usua_ID_Comp,
    usuario_comprador.Usua_Nombre AS Comprador_Nombre,
    pi.PrIn_ID,
    pi.Prod_ID,
    vendedor.Usua_Nombre AS Vendedor_Nombre,
    pi.PrIn_Descripcion,
    pi.PrIn_Fecha_Creac,
    pi.PrIn_Existencia,
    pi.PrIn_Validado,
    pi.PrIn_Estatus,
    vp.Cantidad,
    vp.Ventp_PrecioUnidad,
    vp.ventp_Prod_ID
FROM 
    Venta_por_producto vp
JOIN 
    Venta v ON vp.Venta_ID = v.Vent_ID
JOIN 
    producto_info pi ON vp.ventp_Prod_ID = pi.Prod_ID
JOIN 
    categorias c ON pi.Cate_ID = c.Cate_ID
JOIN 
    producto pr ON vp.ventp_Prod_ID = pr.Prod_ID
JOIN 
    calificacion cal ON v.Cali_ID = cal.Cali_ID
JOIN 
    Usuario usuario_comprador ON v.Usua_ID_Comp = usuario_comprador.Usua_ID
JOIN 
    Usuario vendedor ON pi.Usua_ID = vendedor.Usua_ID;
    
    SELECT 
    Vent_Fecha,  
    Cate_Nombre,
    Prod_Nombre,
    Cali_Valor,
    Ventp_Precio_total,
    Usua_ID_Comp,
    Comprador_Nombre,
    PrIn_ID,
    Prod_ID,
    Vendedor_Nombre,
    PrIn_Descripcion,
    PrIn_Fecha_Creac,
    PrIn_Existencia,
    PrIn_Validado,
    PrIn_Estatus,
    Cantidad,
    Ventp_PrecioUnidad,
    ventp_Prod_ID
FROM VistaVentas
ORDER BY Vent_Fecha DESC;


CREATE VIEW Vista_comentarios AS
SELECT 
    c.Come_ID,
    c.Prod_ID,
    c.Usua_ID,
    c.Cali_ID,
    c.Come_Comentario,
    c.Come_Estatus,
    u.Usua_ID AS Usuario_ID,
    u.Usua_Nombre AS Usuario_Nombre,
    u.Usua_Contra AS Usuario_Contraseña,
    u.Usua_PubPriv AS Usuario_PubPriv,
    u.Usua_Estatus AS Usuario_Estatus,
    u.Role_ID,
    r.Role_Nombre,
    r.Role_Estatus AS Rol_Estatus,
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
    ui.UsIn_Estatus AS UsuarioInfo_Estatus,
    cal.Cali_Valor,
    cal.Cali_Estatus AS Calificacion_Estatus
FROM 
    Comentarios c
JOIN 
    Usuario u ON c.Usua_ID = u.Usua_ID
JOIN 
    Roles r ON u.Role_ID = r.Role_ID
JOIN 
    Usuario_Info ui ON u.Usua_ID = ui.Usua_ID
JOIN 
    Calificacion cal ON c.Cali_ID = cal.Cali_ID;
    
    SELECT 
    Come_ID,
    Prod_ID,
    Usua_ID,
    Cali_ID,
    Come_Comentario,
    Come_Estatus,
    Usuario_ID,
    Usuario_Nombre,
    Usuario_Contraseña,
    Usuario_PubPriv,
    Usuario_Estatus,
    Role_ID,
    Role_Nombre,
    Rol_Estatus,
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
    UsuarioInfo_Estatus,
    Cali_Valor,
    Calificacion_Estatus
FROM Vista_comentarios where prod_ID = 10;

CREATE VIEW Vista_Producto_Info AS
SELECT Prod_ID, PrIn_Existencia
FROM Producto_Info;

