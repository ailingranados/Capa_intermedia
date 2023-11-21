-- Crear la tabla para almacenar el log de actualizaciones de usuarios
CREATE TABLE Usuario_Update_Log (
    Log_ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    Usua_ID INT NOT NULL,
    Fecha_Actualizacion DATETIME NOT NULL,
    FOREIGN KEY (Usua_ID) REFERENCES Usuario(Usua_ID)
);

select * FROM Usuario_Update_Log;

SELECT 
    MAX(Log_ID) AS Log_ID,
    Usua_ID,
    MAX(Fecha_Actualizacion) AS Fecha_Modificacion
FROM 
    Usuario_Update_Log;

-- Crear el trigger
DELIMITER //

CREATE TRIGGER after_usuario_info_update
AFTER UPDATE ON Usuario_Info
FOR EACH ROW
BEGIN
    -- Insertar el log de actualización en la tabla Usuario_Update_Log
    INSERT INTO Usuario_Update_Log (Usua_ID, Fecha_Actualizacion)
    VALUES (NEW.Usua_ID, NOW());
END //

DELIMITER ;




-- Crear la tabla para almacenar el log de modificaciones de productos
CREATE TABLE Producto_Modificacion_Log (
    Log_ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    Prod_ID INT NOT NULL,
    Fecha_Modificacion DATETIME NOT NULL,
    FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID)
);


select * from Producto_Modificacion_Log;

SELECT 
    MAX(Log_ID) AS Log_ID,
    Prod_ID,
    MAX(Fecha_Modificacion) AS Fecha_Modificacion
FROM 
    Producto_Modificacion_Log where Prod_ID =7
GROUP BY 
    Prod_ID;


-- Trigger para la tabla Videos
DELIMITER //
CREATE TRIGGER after_videos_update
AFTER UPDATE ON Videos
FOR EACH ROW
BEGIN
    INSERT INTO Producto_Modificacion_Log (Prod_ID, Fecha_Modificacion)
    VALUES (NEW.Prod_ID, NOW());
END;
//
DELIMITER ;

-- Trigger para la tabla Fotos_1
DELIMITER //
CREATE TRIGGER after_fotos_1_update
AFTER UPDATE ON Fotos_1
FOR EACH ROW
BEGIN
    INSERT INTO Producto_Modificacion_Log (Prod_ID, Fecha_Modificacion)
    VALUES (NEW.Prod_ID, NOW());
END;
//
DELIMITER ;

-- Trigger para la tabla Producto_Info
DELIMITER //
CREATE TRIGGER after_producto_info_update
AFTER UPDATE ON Producto_Info
FOR EACH ROW
BEGIN
    INSERT INTO Producto_Modificacion_Log (Prod_ID, Fecha_Modificacion)
    VALUES (NEW.Prod_ID, NOW());
END;
//
DELIMITER ;
