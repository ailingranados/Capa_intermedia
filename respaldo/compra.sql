DELIMITER //

CREATE PROCEDURE InsertarVentaYProductos(
    IN tarjeta_usuario_ID_param INT,
    IN tarjeta_nombre_param VARCHAR(45),
    IN tarjeta_num_param VARCHAR(16),
    IN tarjeta_fecha_vencimiento_param VARCHAR(6),
    IN tarjeta_csv_param VARCHAR(4),
    IN tarjeta_credito_debito_param BOOL,
    IN tarjeta_estatus_param BOOL,
    IN usua_ID_comp_param INT,
    IN cali_valor_param INT,
    IN vent_estatus_param BOOL
)
BEGIN
    DECLARE tarjeta_id_var INT;
    DECLARE venta_id_var INT;
    DECLARE cali_id_var INT;

    -- Insertar datos en la tabla Tarjeta
    INSERT INTO Tarjeta (
        tarjeta_usuario_ID,
        tarjeta_nombre,
        tarjeta_num,
        tarjeta_fecha_vencimiento,
        tarjeta_csv,
        tarjeta_credito_debito,
        tarjeta_estatus
    )
    VALUES (
        tarjeta_usuario_ID_param,
        tarjeta_nombre_param,
        tarjeta_num_param,
        tarjeta_fecha_vencimiento_param,
        tarjeta_csv_param,
        tarjeta_credito_debito_param,
        tarjeta_estatus_param
    );

    -- Obtener el ID de la tarjeta insertada
    SET tarjeta_id_var = LAST_INSERT_ID();

    -- Insertar datos en la tabla Calificacion
    INSERT INTO Calificacion (Cali_Valor, Cali_Estatus)
    VALUES (cali_valor_param, 1);

    -- Obtener el ID de la calificación insertada
    SET cali_id_var = LAST_INSERT_ID();

    -- Insertar datos en la tabla Venta
    INSERT INTO Venta (
        Usua_ID_Comp,
        Vent_Fecha,
        Vent_Precio,
        Vent_tarjeta_ID,
        Cali_ID,
        Vent_Estatus
    )
    SELECT
        usua_ID_comp_param,
        NOW(),
        SUM(Producto.Prod_Precio), -- Utilizamos pi.Precio en lugar de producto.Precio
        tarjeta_id_var,
        cali_id_var,
        vent_estatus_param
    FROM
        Carrito carrito
    JOIN
        Producto  ON carrito.Prod_ID = Producto.Prod_ID
    WHERE
        carrito.Usua_ID = usua_ID_comp_param AND carrito.Carr_Estatus = 1;

    -- Obtener el ID de la venta insertada
    SET venta_id_var = LAST_INSERT_ID();

    -- Insertar datos en la tabla Venta_por_producto desde el Carrito
    INSERT INTO Venta_por_producto (
        Venta_ID,
        Usua_ID_Vend,
        ventp_Prod_ID,
        Cantidad,
        Ventp_PrecioUnidad,
        Ventp_Precio_total,
        Ventp_Estatus
    )
    SELECT
        venta_id_var,
        pi2.Usua_ID,
        carrito.Prod_ID,
        (SELECT COUNT(DISTINCT Carr_ID) as contador FROM Carrito WHERE Prod_ID = carrito.Prod_ID and Usua_ID = usua_ID_comp_param and Carr_Estatus = 1),
        producto.Prod_Precio,
        (SELECT COUNT(DISTINCT Carr_ID) as contador FROM Carrito WHERE Prod_ID = carrito.Prod_ID and Usua_ID = usua_ID_comp_param and Carr_Estatus = 1) * producto.Prod_Precio,
        1 -- Ventp_Estatus (ajusta según tus necesidades)
    FROM
        Carrito carrito
    JOIN
        Producto_Info pi2 ON carrito.Prod_ID = pi2.Prod_ID
	JOIN
       Producto  ON carrito.Prod_ID = Producto.Prod_ID
    WHERE
        carrito.Usua_ID = usua_ID_comp_param AND carrito.Carr_Estatus = 1;

    -- Actualizar la existencia en la tabla Producto_Info
    UPDATE Producto_Info pinfo
JOIN Carrito carrito ON pinfo.Prod_ID = carrito.Prod_ID
SET pinfo.PrIn_Existencia = pinfo.PrIn_Existencia - (
    SELECT COUNT(DISTINCT Carr_ID) as contador 
    FROM Carrito 
    WHERE Prod_ID = carrito.Prod_ID 
    AND Usua_ID = usua_ID_comp_param 
    AND Carr_Estatus = 1
)
WHERE carrito.Usua_ID = usua_ID_comp_param AND carrito.Carr_Estatus = 1;

    -- Limpiar el carrito después de realizar la venta
    DELETE FROM Carrito WHERE Usua_ID = usua_ID_comp_param AND Carr_Estatus = 1;
    
END //

DELIMITER ;





DELIMITER //

CREATE PROCEDURE InsertarVentaYProductos(
    IN tarjeta_usuario_ID_param INT,
    IN tarjeta_nombre_param VARCHAR(45),
    IN tarjeta_num_param VARCHAR(16),
    IN tarjeta_fecha_vencimiento_param VARCHAR(6),
    IN tarjeta_csv_param VARCHAR(4),
    IN tarjeta_credito_debito_param BOOL,
    IN tarjeta_estatus_param BOOL,
    IN usua_ID_comp_param INT,
    IN cali_valor_param INT,
    IN vent_estatus_param BOOL,
    IN Vent_Precio_param DECIMAL(10, 2)
)
BEGIN
    DECLARE tarjeta_id_var INT;
    DECLARE venta_id_var INT;
    DECLARE cali_id_var INT;

    -- Insertar datos en la tabla Tarjeta
    INSERT INTO Tarjeta (
        tarjeta_usuario_ID,
        tarjeta_nombre,
        tarjeta_num,
        tarjeta_fecha_vencimiento,
        tarjeta_csv,
        tarjeta_credito_debito,
        tarjeta_estatus
    )
    VALUES (
        tarjeta_usuario_ID_param,
        tarjeta_nombre_param,
        tarjeta_num_param,
        tarjeta_fecha_vencimiento_param,
        tarjeta_csv_param,
        tarjeta_credito_debito_param,
        tarjeta_estatus_param
    );

    -- Obtener el ID de la tarjeta insertada
    SET tarjeta_id_var = LAST_INSERT_ID();

    -- Insertar datos en la tabla Calificacion
    INSERT INTO Calificacion (Cali_Valor, Cali_Estatus)
    VALUES (cali_valor_param, 1);

    -- Obtener el ID de la calificación insertada
    SET cali_id_var = LAST_INSERT_ID();

    -- Insertar datos en la tabla Venta
    INSERT INTO Venta (
        Usua_ID_Comp,
        Vent_Fecha,
        Vent_Precio,
        Vent_tarjeta_ID,
        Cali_ID,
        Vent_Estatus
    )
    values(
        usua_ID_comp_param,
        NOW(),
        Vent_Precio_param, -- Utilizamos pi.Precio en lugar de producto.Precio
        tarjeta_id_var,
        cali_id_var,
        vent_estatus_param);

    -- Obtener el ID de la venta insertada
    SET venta_id_var = LAST_INSERT_ID();

    -- Insertar datos en la tabla Venta_por_producto desde el Carrito
   -- Insertar datos en la tabla Venta_por_producto desde el Carrito
-- Insertar datos en la tabla Venta_por_producto desde el Carrito
INSERT INTO Venta_por_producto (
    Venta_ID,
    Usua_ID_Vend,
    ventp_Prod_ID,
    Cantidad,
    Ventp_PrecioUnidad,
    Ventp_Precio_total,
    Ventp_Estatus
)
SELECT
    venta_id_var,
    pi2.Usua_ID,
    carrito.Prod_ID,
    SUM(carrito.cantidad) as TotalCantidad, -- Sumar la cantidad para el mismo producto
    producto.Prod_Precio,
    SUM(carrito.cantidad * producto.Prod_Precio), -- Calcular el precio total sumando
    1 -- Ventp_Estatus (ajusta según tus necesidades)
FROM
    Carrito carrito
JOIN
    Producto_Info pi2 ON carrito.Prod_ID = pi2.Prod_ID
JOIN
    Producto ON carrito.Prod_ID = Producto.Prod_ID
WHERE
    carrito.Usua_ID = usua_ID_comp_param AND carrito.Carr_Estatus = 1
GROUP BY
    venta_id_var, pi2.Usua_ID, carrito.Prod_ID, producto.Prod_Precio;


    -- Actualizar la existencia en la tabla Producto_Info
   -- Actualizar la existencia en la tabla Producto_Info
UPDATE Producto_Info pinfo
JOIN Carrito carrito ON pinfo.Prod_ID = carrito.Prod_ID
SET pinfo.PrIn_Existencia = pinfo.PrIn_Existencia - carrito.cantidad
WHERE carrito.Usua_ID = usua_ID_comp_param AND carrito.Carr_Estatus = 1;



    -- Limpiar el carrito después de realizar la venta
    DELETE FROM Carrito WHERE Usua_ID = usua_ID_comp_param AND Carr_Estatus = 1;
    
END //

DELIMITER ;



CALL InsertarVentaYProductos(26, 'jesus bancomer2', '123456', '082028', '123', 0, 1, 26, 06, 1, 4410 )
;
CALL InsertarVentaYProductos(26, 'a gastar', '45594849', '2032', '156', 1, 1, 26, 05, 1 );
select * from carrito;
select * from venta;
SELECT * FROM `venta_por_producto`;

UPDATE Venta_por_producto
SET Ventp_Estatus = 0
WHERE Venta_ID != 33;

UPDATE Venta
SET Vent_Estatus = 0
WHERE Vent_ID != 33;