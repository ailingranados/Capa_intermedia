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


select * from categorias;
INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES (22,'Mascotas','Perros y gatos', 1);
INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES (22,'Electrodomesticos','Para el hogar', 1);
INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES (22,'Ropa Caballero','Ropa para dama', 1);
INSERT INTO Categorias (Usua_ID, Cate_Nombre, Cate_Descripcion, Cate_Estatus) VALUES (22,'Ropa Dama','Ropa para dama', 1);



select * from Tipo_Media;
INSERT INTO Tipo_Media (TiMe_Nombre, TiMe_Estatus) VALUES ('Imagen', 1);
INSERT INTO Tipo_Media (TiMe_Nombre, TiMe_Estatus) VALUES ('Video', 1);