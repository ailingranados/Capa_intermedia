DELIMITER //

CREATE PROCEDURE InsertarUsuario(
    IN p_Usua_Nombre VARCHAR(30),
    IN p_Usua_Contra VARCHAR(30),
    IN p_Usua_PubPriv BOOL,
    IN p_Usua_Estatus BOOL,
    IN p_Role_Nombre VARCHAR(15),
    IN p_UsIn_Nombre VARCHAR(30),
    IN p_UsIn_ApellidoPa VARCHAR(30),
    IN p_UsIn_ApellidoMa VARCHAR(30),
    IN p_UsIn_Sexo VARCHAR(25),
    IN p_UsIn_Telefono VARCHAR(20),
    IN p_UsIn_Correo VARCHAR(60),
    IN p_UsIn_Foto BLOB,
    IN p_UsIn_Fecha_Nac DATE,
    IN p_UsIn_Fecha_Creac DATETIME,
    IN p_UsIn_Estatus BOOL
)
BEGIN
    DECLARE v_Role_ID INT;

    -- Obtener el Role_ID correspondiente al nombre del rol
    SELECT Role_ID INTO v_Role_ID FROM Roles WHERE Role_Nombre = p_Role_Nombre;

    -- Insertar en la tabla Usuario
    INSERT INTO Usuario (Usua_Nombre, Usua_Contra, Usua_PubPriv, Usua_Estatus, Role_ID)
    VALUES (p_Usua_Nombre, p_Usua_Contra, p_Usua_PubPriv, p_Usua_Estatus, v_Role_ID);

    -- Obtener el Usua_ID generado en la inserción anterior
    
    SET @Usua_ID = LAST_INSERT_ID();

    -- Insertar en la tabla Usuario_Info
    INSERT INTO Usuario_Info (Usua_ID, UsIn_Nombre, UsIn_ApellidoPa, UsIn_ApellidoMa,
                              UsIn_Sexo, UsIn_Telefono, UsIn_Correo, UsIn_Foto,
                              UsIn_Fecha_Nac, UsIn_Fecha_Creac, UsIn_Estatus)
    VALUES (@Usua_ID, p_UsIn_Nombre, p_UsIn_ApellidoPa, p_UsIn_ApellidoMa,
            p_UsIn_Sexo, p_UsIn_Telefono, p_UsIn_Correo, p_UsIn_Foto,
            p_UsIn_Fecha_Nac, p_UsIn_Fecha_Creac, p_UsIn_Estatus);
END //

DELIMITER ;
CALL InsertarUsuario('NombreUsuario', 'Contraseña123', 1, 1, 'Administrador',
                     'NombreUsuario', 'ApellidoPaterno', 'ApellidoMaterno',
                     'Masculino', '123456789', 'correo@example.com', 'ruta_de_la_imagen.jpg',
                     '1990-01-01', NOW(), 1);
DELIMITER //

CREATE PROCEDURE Insertarproducto(
    IN p_nombre_producto VARCHAR(50),
    IN p_precio_producto DECIMAL(10, 2),
    IN p_cotizable_producto BOOL,
    IN p_estatus_producto BOOL,
    IN p_usuario_id INT,
    IN p_categoria_id INT,
    IN p_descripcion_producto TEXT,
    IN p_existencia_producto INT,
    IN p_validado_producto BOOL,
    IN p_nombre_video VARCHAR(100),
    IN p_archivo_video LONGBLOB,
    IN p_nombre_foto_1 VARCHAR(100),
    IN p_archivo_foto_1 LONGBLOB,
    IN p_nombre_foto_2 VARCHAR(100),
    IN p_archivo_foto_2 LONGBLOB
)
BEGIN
    DECLARE v_producto_id INT;

    -- Insertar en la tabla Producto
    INSERT INTO Producto (Prod_Nombre, Prod_Precio, Prod_Cotizable, Prod_Estatus)
    VALUES (p_nombre_producto, p_precio_producto, p_cotizable_producto, p_estatus_producto);

    -- Obtener el ID del producto recién insertado
    SET v_producto_id = LAST_INSERT_ID();

    -- Insertar en la tabla Producto_Info
    INSERT INTO Producto_Info (Prod_ID, Usua_ID, Cate_ID, PrIn_Descripcion, PrIn_Fecha_Creac, PrIn_Existencia, PrIn_Validado, PrIn_Estatus)
    VALUES (v_producto_id, p_usuario_id, p_categoria_id, p_descripcion_producto, CURRENT_DATE, p_existencia_producto, p_validado_producto, 1);

    -- Insertar en la tabla Videos
    INSERT INTO Videos (Video_Nombre, Prod_ID, Video_Archivo, Video_Estatus)
    VALUES (p_nombre_video, v_producto_id, p_archivo_video, 1);

    -- Insertar en la tabla Fotos_1 (Primera inserción)
    INSERT INTO Fotos_1 (Foto_Nombre, Prod_ID, Foto_Archivo, Foto_Estatus)
    VALUES (p_nombre_foto_1, v_producto_id, p_archivo_foto_1, 1);

    -- Insertar en la tabla Fotos_1 (Segunda inserción)
    INSERT INTO Fotos_1 (Foto_Nombre, Prod_ID, Foto_Archivo, Foto_Estatus)
    VALUES (p_nombre_foto_2, v_producto_id, p_archivo_foto_2, 1);
END //

DELIMITER ;

                     
                     
DELIMITER //



CREATE PROCEDURE InsertarProductoConMedia(
    IN p_Prod_Nombre VARCHAR(50),
    IN p_Prod_Precio DECIMAL(10, 2),
    IN p_Prod_Cotizable BOOL,
    IN p_Prod_Estatus BOOL,
    IN p_Usua_ID INT,
    IN p_Cate_ID INT,
    IN p_Prin_Descripcion varchar(50),
    IN p_Prin_Existencia INT,
    IN p_Prin_Validado BOOL,
    IN p_Medi_Nombre_Archivo1 VARCHAR(80),
    IN p_Medi_Archivo1 LONGBLOB,
    IN p_Medi_Nombre_Archivo2 VARCHAR(80),
    IN p_Medi_Archivo2 LONGBLOB,
    IN p_Medi_Nombre_Archivo3 VARCHAR(80),
    IN p_Medi_Archivo3 LONGBLOB,
    IN p_TiMe_ID_Imagen INT,
    IN p_TiMe_ID_Video INT
)
BEGIN
    DECLARE v_Prod_ID INT;

    -- Insertar en la tabla Producto
    INSERT INTO Producto (Prod_Nombre, Prod_Precio, Prod_Cotizable, Prod_Estatus)
    VALUES (p_Prod_Nombre, p_Prod_Precio, p_Prod_Cotizable, p_Prod_Estatus);

    -- Obtener el ID del producto recién insertado
    SET v_Prod_ID = LAST_INSERT_ID();

    -- Insertar en la tabla Producto_Info
    INSERT INTO Producto_Info (Prod_ID, Usua_ID, Cate_ID, PrIn_Descripcion, PrIn_Existencia, PrIn_Validado, PrIn_Fecha_Creac, PrIn_Estatus)
    VALUES (v_Prod_ID, p_Usua_ID, p_Cate_ID, p_Prin_Descripcion, p_Prin_Existencia, p_Prin_Validado, NOW(), 1);

    -- Insertar imágenes en la tabla Media
    INSERT INTO Media (Prod_ID, TiMe_ID, Medi_Nombre_Archivo, Medi_Archivo, Medi_Estatus)
    VALUES (v_Prod_ID, p_TiMe_ID_Imagen, p_Medi_Nombre_Archivo1, p_Medi_Archivo1, 1);

    INSERT INTO Media (Prod_ID, TiMe_ID, Medi_Nombre_Archivo, Medi_Archivo, Medi_Estatus)
    VALUES (v_Prod_ID, p_TiMe_ID_Imagen, p_Medi_Nombre_Archivo2, p_Medi_Archivo2, 1);

    -- Insertar video en la tabla Media
    INSERT INTO Media (Prod_ID, TiMe_ID, Medi_Nombre_Archivo, Medi_Archivo, Medi_Estatus)
    VALUES (v_Prod_ID, p_TiMe_ID_Video, p_Medi_Nombre_Archivo3, p_Medi_Archivo3, 1);
END //

DELIMITER ;




DELIMITER //

CREATE PROCEDURE ModificarProducto(
    IN p_prod_id INT,
    IN p_precio_producto DECIMAL(10, 2),
    IN p_cotizable_producto BOOL,
    IN p_categoria_id INT,
    IN p_descripcion_producto TEXT,
    IN p_existencia_producto INT,
   
    IN p_nombre_video VARCHAR(100),
    IN p_archivo_video LONGBLOB,
    IN p_nombre_foto_1 VARCHAR(100),
    IN p_archivo_foto_1 LONGBLOB,
    IN p_nombre_foto_2 VARCHAR(100),
    IN p_archivo_foto_2 LONGBLOB
)
BEGIN
    -- Modificar en la tabla Producto
    UPDATE Producto
    SET
        Prod_Precio = p_precio_producto,
        Prod_Cotizable = p_cotizable_producto
    WHERE
        Prod_ID = p_prod_id;

    -- Modificar en la tabla Producto_Info
    UPDATE Producto_Info
    SET
        Cate_ID = p_categoria_id,
        PrIn_Descripcion = p_descripcion_producto,
        PrIn_Fecha_Creac = CURRENT_DATE,
        PrIn_Existencia = p_existencia_producto
    WHERE
        Prod_ID = p_prod_id;

    -- Modificar en la tabla Videos
    UPDATE Videos
    SET
        Video_Nombre = p_nombre_video,
        Video_Archivo = p_archivo_video
    WHERE
        Prod_ID = p_prod_id;

    -- Modificar en la tabla Fotos_1 (Primera inserción)
    UPDATE Fotos_1
    SET
        Foto_Nombre = p_nombre_foto_1,
        Foto_Archivo = p_archivo_foto_1
    WHERE
        Prod_ID = p_prod_id;

    -- Modificar en la tabla Fotos_1 (Segunda inserción)
    UPDATE Fotos_1
    SET
        Foto_Nombre = p_nombre_foto_2,
        Foto_Archivo = p_archivo_foto_2
    WHERE
        Prod_ID = p_prod_id;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE ModificarProducto2(
    IN p_prod_id INT,
    IN p_precio_producto DECIMAL(10, 2),
    IN p_cotizable_producto BOOL,
    IN p_categoria_id INT,
    IN p_descripcion_producto TEXT,
    IN p_existencia_producto INT,
    -- Excluimos p_validado_producto de los parámetros
    IN p_nombre_video VARCHAR(100),
    IN p_archivo_video LONGBLOB,
    IN p_nombre_foto_1 VARCHAR(100),
    IN p_archivo_foto_1 LONGBLOB,
    IN p_nombre_foto_2 VARCHAR(100),
    IN p_archivo_foto_2 LONGBLOB
)
BEGIN
    DECLARE v_id_foto_1 INT;
    DECLARE v_id_foto_2 INT;

    -- Obtener el ID de la primera imagen
    SELECT Foto_ID INTO v_id_foto_1
    FROM Fotos_1
    WHERE Prod_ID = p_prod_id
    ORDER BY Foto_ID
    LIMIT 1;

    -- Obtener el ID de la segunda imagen (que no sea igual al ID de la primera imagen)
    SELECT Foto_ID INTO v_id_foto_2
    FROM Fotos_1
    WHERE Prod_ID = p_prod_id AND Foto_ID <> v_id_foto_1
    ORDER BY Foto_ID
    LIMIT 1;

    -- Modificar en la tabla Producto
    UPDATE Producto
    SET
        Prod_Precio = p_precio_producto,
        Prod_Cotizable = p_cotizable_producto
    WHERE
        Prod_ID = p_prod_id;

    -- Modificar en la tabla Producto_Info
    UPDATE Producto_Info
    SET
        Cate_ID = p_categoria_id,
        PrIn_Descripcion = p_descripcion_producto,
        PrIn_Fecha_Creac = CURRENT_DATE,
        PrIn_Existencia = p_existencia_producto
    WHERE
        Prod_ID = p_prod_id;

    -- Modificar en la tabla Videos
    UPDATE Videos
    SET
        Video_Nombre = p_nombre_video,
        Video_Archivo = p_archivo_video
    WHERE
        Prod_ID = p_prod_id;

    -- Modificar en la tabla Fotos_1 (Primera inserción)
    IF v_id_foto_1 IS NOT NULL THEN
        UPDATE Fotos_1
        SET
            Foto_Nombre = p_nombre_foto_1,
            Foto_Archivo = p_archivo_foto_1
        WHERE
            Foto_ID = v_id_foto_1;
    END IF;

    -- Modificar en la tabla Fotos_1 (Segunda inserción)
    IF v_id_foto_2 IS NOT NULL THEN
        UPDATE Fotos_1
        SET
            Foto_Nombre = p_nombre_foto_2,
            Foto_Archivo = p_archivo_foto_2
        WHERE
            Foto_ID = v_id_foto_2;
    END IF;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE ValidarProducto(
    IN p_prod_id INT
)
BEGIN
    -- Actualizar en la tabla Producto_Info
    UPDATE Producto_Info
    SET
        PrIn_Validado = 1
    WHERE
        Prod_ID = p_prod_id;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE InvalidarProducto(
    IN p_prod_id INT
)
BEGIN
    -- Actualizar en la tabla Producto_Info
    UPDATE Producto_Info
    SET
        PrIn_Validado = 0
    WHERE
        Prod_ID = p_prod_id;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE InsertarCarrito(
    IN p_usua_id INT,
    IN p_prod_id INT,
    IN cantidad_proc int
)
BEGIN
    -- Insertar en la tabla Carrito
    INSERT INTO Carrito (Usua_ID, Prod_ID, Carr_Fecha_Agregado, Carr_Estatus, cantidad)
    VALUES (p_usua_id, p_prod_id, NOW(), 1, cantidad_proc);
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE CambiarEstadoCarrito(
    IN p_Usua_ID INT,
    IN p_Prod_ID INT
)
BEGIN
    DECLARE principal_id INT;

    -- Seleccionar el ID principal del Carrito
    SELECT Carr_ID INTO principal_id
    FROM Carrito
    WHERE Usua_ID = p_Usua_ID AND Prod_ID = p_Prod_ID and Carr_Estatus = 1
    LIMIT 1;

    -- Actualizar el estado del Carrito
    IF principal_id IS NOT NULL THEN
        UPDATE Carrito
        SET Carr_Estatus = 0
        WHERE Carr_ID = principal_id;
    END IF;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE VaciarCarrito(
    IN p_Usua_ID INT,
    IN p_Prod_ID INT
)
BEGIN
    UPDATE Carrito
    SET Carr_Estatus = 0
    WHERE Usua_ID = p_Usua_ID;
END //

DELIMITER ;






DELIMITER //

CREATE PROCEDURE InsertarListaDeseos(
    IN usua_ID_param INT,
    IN liDe_Nombre_param VARCHAR(15),
    IN liDe_Visible_param BOOL
)
BEGIN
    -- Insertar datos en la tabla Lista_Deseos
    INSERT INTO Lista_Deseos (Usua_ID, LiDe_Nombre, LiDe_Visible, LiDe_Estatus)
    VALUES (usua_ID_param, liDe_Nombre_param, liDe_Visible_param, 1);
    
    -- Si necesitas realizar alguna otra tarea después de la inserción, puedes agregarla aquí.

END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE InsertarProducto_lista(
    IN p_lista_id INT,
    IN p_prod_id INT,
    IN cantidad_proc int
)
BEGIN
    -- Insertar en la tabla Carrito
    INSERT INTO Lista_Deseos_Prod (LiDe_ID, Prod_ID, LiDP_Estatus, cantidad_lista)
    VALUES (p_lista_id, p_prod_id, 1, cantidad_proc);
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE CambiarEstadoListaProducto(
    IN p_lista_id INT,
    IN p_Prod_ID INT
)
BEGIN
    DECLARE principal_id INT;

    -- Seleccionar el ID principal del Carrito
    SELECT LiDP_ID INTO principal_id
    FROM Lista_Deseos_Prod
    WHERE LiDe_ID = p_lista_id AND Prod_ID = p_Prod_ID and LiDP_Estatus = 1
    LIMIT 1;

    -- Actualizar el estado del Carrito
    IF principal_id IS NOT NULL THEN
        UPDATE Lista_Deseos_Prod
        SET LiDP_Estatus = 0
        WHERE LiDP_ID = principal_id;
    END IF;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE VaciarLista(
    IN p_lista_id INT
   
)
BEGIN
    UPDATE Lista_Deseos_Prod
    SET LiDP_Estatus = 0
    WHERE LiDe_ID = p_lista_id;
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




DELIMITER //

CREATE PROCEDURE lista_InsertarVentaYProductos(
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
    IN Vent_Precio_param DECIMAL(10, 2),
    IN id_lista_param INT
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
    lista.Prod_ID,
    SUM(lista.cantidad_lista) as TotalCantidad, -- Sumar la cantidad para el mismo producto
    producto.Prod_Precio,
    SUM(lista.cantidad_lista * producto.Prod_Precio), -- Calcular el precio total sumando
    1 -- Ventp_Estatus (ajusta según tus necesidades)
FROM
    Lista_Deseos_Prod lista
JOIN
    Producto_Info pi2 ON lista.Prod_ID = pi2.Prod_ID
JOIN
    Producto ON lista.Prod_ID = Producto.Prod_ID
WHERE
    lista.LiDe_ID = id_lista_param AND lista.LiDP_Estatus = 1
GROUP BY
    venta_id_var, pi2.Usua_ID, lista.Prod_ID, producto.Prod_Precio;


    -- Actualizar la existencia en la tabla Producto_Info
   -- Actualizar la existencia en la tabla Producto_Info
UPDATE Producto_Info pinfo
JOIN Lista_Deseos_Prod lista ON pinfo.Prod_ID = lista.Prod_ID
SET pinfo.PrIn_Existencia = pinfo.PrIn_Existencia - lista.cantidad_lista
WHERE  lista.LiDe_ID = id_lista_param AND lista.LiDP_Estatus = 1;



    -- Limpiar el carrito después de realizar la venta
    DELETE FROM Lista_Deseos_Prod WHERE LiDe_ID = id_lista_param AND LiDP_Estatus = 1;
    
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE InsertarChat(
    IN p_Usua_ID_Comp INT,
    IN p_Usua_ID_Vend INT,
    IN p_Chat_Mensaje TEXT
)
BEGIN
    INSERT INTO Chat (Chat_Fecha, RemitenteID, DestinatarioID, Chat_Mensaje, Chat_Msg_Estatus)
    VALUES (NOW(), p_Usua_ID_Comp, p_Usua_ID_Vend, p_Chat_Mensaje, 1);
END //

DELIMITER ;





DELIMITER //

CREATE PROCEDURE ModificarPrecioYRegistrarCotizacion(
    IN p_Prod_ID INT,
    IN p_Usua_ID INT,
    IN p_Nuevo_Precio DECIMAL(10, 2)
)
BEGIN
    DECLARE producto_modificado BOOL;

    -- Modificar el precio del producto en la tabla Producto
    UPDATE Producto
    SET Prod_Precio = p_Nuevo_Precio
    WHERE Prod_ID = p_Prod_ID;

    -- Verificar si se realizó la modificación
    SELECT ROW_COUNT() INTO producto_modificado;

    -- Si se modificó, insertar en la tabla Cotizacion
    IF producto_modificado > 0 THEN
        INSERT INTO Cotizacion (Usua_ID, Prod_ID, Fecha_Cotizacion)
        VALUES (p_Usua_ID, p_Prod_ID, NOW());
    END IF;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE ModificarCategoriaNombreDesc(
    IN categoriaID INT,
    IN nuevoNombre VARCHAR(15),
    IN nuevaDescripcion TEXT
)
BEGIN
    UPDATE Categorias
    SET Cate_Nombre = nuevoNombre, Cate_Descripcion = nuevaDescripcion
    WHERE Cate_ID = categoriaID;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE ActivarCategoria(
    IN categoriaID INT
)
BEGIN
    UPDATE Categorias
    SET Cate_Estatus = 1
    WHERE Cate_ID = categoriaID;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE DesactivarCategoria(
    IN categoriaID INT
)
BEGIN
    UPDATE Categorias
    SET Cate_Estatus = 0
    WHERE Cate_ID = categoriaID;
END //

DELIMITER ;




DELIMITER //

CREATE PROCEDURE InsertarCalificacionYComentario(
    IN caliValorParam INT,
    IN comentarioParam TEXT,
    IN usuaIDParam INT,
    IN prodIDParam INT
)
BEGIN
    DECLARE caliIDVar INT;

    -- Insertar datos en la tabla Calificacion
    INSERT INTO Calificacion (Cali_Valor, Cali_Estatus)
    VALUES (caliValorParam, 1);

    -- Obtener el ID de la calificación insertada
    SET caliIDVar = LAST_INSERT_ID();

    -- Insertar datos en la tabla Comentarios
    INSERT INTO Comentarios (Prod_ID, Usua_ID, Cali_ID, Come_Comentario, Come_Estatus)
    VALUES (prodIDParam, usuaIDParam, caliIDVar, comentarioParam, 1);
END //

DELIMITER ;



CALL InsertarVentaYProductos(26, 'a gastar', '45594849', '2032', '156', 1, 1, 26, 05, 1 )



select * from categorias;
INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES (22,'Mascotas','Perros y gatos', 1);
INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES (22,'Electrodomesticos','Para el hogar', 1);
INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES (22,'Ropa Caballero','Ropa para dama', 1);
INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES (22,'Ropa Dama','Ropa para dama', 1);



select * from Tipo_Media;
INSERT INTO Tipo_Media (TiMe_Nombre, TiMe_Estatus) VALUES ('Imagen', 1);
INSERT INTO Tipo_Media (TiMe_Nombre, TiMe_Estatus) VALUES ('Video', 1);