CREATE TABLE MetodoPago (
    MePa_ID INT auto_increment PRIMARY KEY NOT NULL,
    MePa_Nombre VARCHAR(15) NOT NULL,
    MePa_Estatus BOOL NOT NULL
);
insert into metodopago(MePa_Nombre, MePa_Estatus) values ('Tarjeta', 1);
select * from metodopago;
CREATE TABLE Tarjeta (
    tarjeta_ID INT auto_increment PRIMARY KEY NOT NULL,
    tarjeta_usuario_ID INT not null,
    tarjeta_nombre VARCHAR(45) NOT NULL,
    tarjeta_num VARCHAR(16) NOT NULL,
    tarjeta_fecha_vencimiento VARCHAR(6) NOT NULL,
    tarjeta_csv VARCHAR(4) NOT NULL,
    tarjeta_Credito_debito BOOL ,
    tarjeta_Estatus BOOL ,
	FOREIGN KEY (tarjeta_usuario_ID) REFERENCES Usuario(Usua_ID)
    
);


SELECT 
    vp.Ventp_ID,
    vp.Venta_ID,
    vp.Usua_ID_Vend,
    vp.ventp_Prod_ID,
    vp.Cantidad,
    vp.Ventp_PrecioUnidad,
    vp.Ventp_Precio_total,
    vp.Ventp_Estatus,
    v.Vent_Fecha
FROM 
    Venta_por_producto vp
JOIN 
    Venta v ON vp.Venta_ID = v.Vent_ID
    GROUP BY
  vp.Venta_ID;
  
  
  SELECT 
    v.Vent_Fecha,  
    c.Cate_Nombre,
    pr.Prod_Nombre,
    cal.Cali_Valor,
    vp.Ventp_Precio_total,
    v.Usua_ID_Comp,
    
	(SELECT COUNT(DISTINCT Ventp_ID)as contador FROM Venta_por_producto  WHERE ventp_Prod_ID =vp.ventp_Prod_ID  and  Venta_ID = v.Vent_ID) AS CantidadRepetidos,
    
     vp.ventp_Prod_ID, vp.Venta_ID
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
    calificacion cal ON v.Cali_ID = cal.Cali_ID 
    GROUP BY
  vp.ventp_Prod_ID, vp.Venta_ID   order by v.Vent_Fecha desc;
  
  
  
  
  SELECT 
    Vent_ID,
    Usua_ID_Comp,
    Vent_Fecha,
    Vent_Precio,
    Vent_tarjeta_ID,
    Cali_ID,
    Vent_Estatus
FROM 
    Venta;

