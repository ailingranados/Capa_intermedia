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
;



select   LiDe_ID ,
    Usua_ID ,
    LiDe_Nombre ,
    LiDe_Visible,
    LiDe_Estatus  from Lista_Deseos;
    
    select   LiDP_ID ,
    LiDe_ID ,
    Prod_ID ,
    LiDP_Estatus  from Lista_Deseos_Prod;
    
    
    SELECT   l.LiDP_ID ,
    l.LiDe_ID ,
    l.Prod_ID ,
    l.LiDP_Estatus,  
    
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
    ct.Cate_Estatus
     from 
     Lista_Deseos_Prod l
JOIN
    Producto p ON l.Prod_ID = p.Prod_ID
JOIN
    lista_deseos ld ON l.LiDe_ID = ld.LiDe_ID
JOIN
    Producto_Info pi ON l.Prod_ID = pi.Prod_ID
LEFT JOIN
    Videos v ON p.Prod_ID = v.Prod_ID
LEFT JOIN
    Fotos_1 f ON p.Prod_ID = f.Prod_ID
LEFT JOIN
    Categorias ct ON pi.Cate_ID = ct.Cate_ID

GROUP BY
l.Prod_ID








;
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
    c.Cate_Estatus,
    u.Usua_ID,
    u.Usua_Nombre,
    u.Usua_PubPriv,
    u.Usua_Estatus,
    u.Role_ID,
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
    Producto p
JOIN
    Producto_Info pi ON p.Prod_ID = pi.Prod_ID
LEFT JOIN
    Videos v ON p.Prod_ID = v.Prod_ID
LEFT JOIN
    Fotos_1 f ON p.Prod_ID = f.Prod_ID
LEFT JOIN
    Categorias c ON pi.Cate_ID = c.Cate_ID
LEFT JOIN
    Usuario u ON pi.Usua_ID = u.Usua_ID
LEFT JOIN
    Usuario_Info ui ON u.Usua_ID = ui.Usua_ID
WHERE
    p.Prod_ID = 10
GROUP BY
    p.Prod_ID;


select Chat_ID ,
    Chat_Fecha ,
    RemitenteID ,
    DestinatarioID ,
    Chat_Mensaje ,
    Chat_Msg_Estatus,
    
    u.Usua_ID,
    u.Usua_Nombre,
    u.Usua_PubPriv,
    u.Usua_Estatus,
    u.Role_ID,
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
    
    from Chat
    JOIN
    Usuario u ON RemitenteID = u.Usua_ID
    JOIN
    Usuario_Info ui ON u.Usua_ID = ui.Usua_ID where DestinatarioID =24
    group by RemitenteID;




SELECT 
    v.Vent_Fecha,  
    c.Cate_Nombre,
    pr.Prod_Nombre,
    cal.Cali_Valor,
    vp.Ventp_Precio_total,
    v.Usua_ID_Comp,
    vp.Cantidad,
    vp.Ventp_PrecioUnidad,
    vp.ventp_Prod_ID,
    pf.Usua_ID
FROM 
    Venta_por_producto vp
JOIN 
    Venta v ON vp.Venta_ID = v.Vent_ID
JOIN 
    producto_info pf ON vp.ventp_Prod_ID = pf.Prod_ID
JOIN 
    categorias c ON pf.Cate_ID = c.Cate_ID
JOIN 
    producto pr ON vp.ventp_Prod_ID = pr.Prod_ID
JOIN 
    calificacion cal ON v.Cali_ID = cal.Cali_ID where vp.Ventp_Estatus = 1 and pf.Usua_ID = 24
    GROUP BY
  vp.ventp_Prod_ID, vp.Venta_ID   order by v.Vent_Fecha desc;
  
  
  
  
   SELECT   l.LiDP_ID ,
    l.LiDe_ID ,
    l.Prod_ID ,
    l.LiDP_Estatus,  
    l.cantidad_lista, 

    lista.Usua_ID,
    
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
    ct.Cate_Estatus
     from 
     Lista_Deseos_Prod l
JOIN
Lista_Deseos lista ON l.LiDe_ID = lista.LiDe_ID
JOIN
    Producto p ON l.Prod_ID = p.Prod_ID
JOIN
    Producto_Info pi ON l.Prod_ID = pi.Prod_ID
LEFT JOIN
    Videos v ON p.Prod_ID = v.Prod_ID
LEFT JOIN
    Fotos_1 f ON p.Prod_ID = f.Prod_ID
LEFT JOIN
    Categorias ct ON pi.Cate_ID = ct.Cate_ID