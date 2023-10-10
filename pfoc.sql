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
