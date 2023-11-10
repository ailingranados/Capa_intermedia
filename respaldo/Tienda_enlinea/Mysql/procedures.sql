DELIMITER //

CREATE PROCEDURE InsertarUsuario(
    IN p_Usua_Nombre VARCHAR(30),
    IN p_Usua_Contra VARCHAR(30),
    IN p_Usua_PubPriv BOOL,
    IN p_Usua_Estatus BOOL,
    IN p_Role_id int,
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
 
    
    INSERT INTO Usuario (Usua_Nombre, Usua_Contra, Usua_PubPriv, Usua_Estatus, Role_ID)
    VALUES (p_Usua_Nombre, p_Usua_Contra, p_Usua_PubPriv, p_Usua_Estatus, p_Role_id);

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
CALL InsertarUsuario('NombreUsuario2', 'Contraseña123', 1, 1, 1,
                     'NombreUsuario', 'ApellidoPaterno', 'ApellidoMaterno',
                     'Masculino', '123456789', 'correo@example.com', 'ruta_de_la_imagen.jpg',
                     '1990-01-01', NOW(), 1);




DELIMITER //

CREATE PROCEDURE ActualizarUsuario(
    IN p_Usua_Nombre VARCHAR(30),
    IN p_Usua_Contra VARCHAR(30),
    IN p_Usua_PubPriv BOOL,
    IN p_Usua_Estatus BOOL,
    
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
    DECLARE v_Usua_ID INT;

    -- Obtener el Usua_ID del nombre de usuario
    SELECT Usua_ID INTO v_Usua_ID FROM Usuario WHERE Usua_Nombre = p_Usua_Nombre;

    -- Verificar si se encontró un Usua_ID
    IF v_Usua_ID IS NOT NULL THEN
        -- Actualizar información en la tabla Usuario
        UPDATE Usuario
        SET Usua_Nombre = p_Usua_Nombre,
            Usua_Contra = p_Usua_Contra,
            Usua_PubPriv = p_Usua_PubPriv,
            Usua_Estatus = p_Usua_Estatus
           
        WHERE Usua_ID = v_Usua_ID;

        -- Actualizar información en la tabla Usuario_Info
        UPDATE Usuario_Info
        SET UsIn_Nombre = p_UsIn_Nombre,
            UsIn_ApellidoPa = p_UsIn_ApellidoPa,
            UsIn_ApellidoMa = p_UsIn_ApellidoMa,
            UsIn_Sexo = p_UsIn_Sexo,
            UsIn_Telefono = p_UsIn_Telefono,
            UsIn_Correo = p_UsIn_Correo,
            UsIn_Foto = p_UsIn_Foto,
            UsIn_Fecha_Nac = p_UsIn_Fecha_Nac,
            UsIn_Fecha_Creac = p_UsIn_Fecha_Creac,
            UsIn_Estatus = p_UsIn_Estatus
        WHERE Usua_ID = v_Usua_ID;
    ELSE
        -- No se encontró un Usua_ID para el nombre de usuario proporcionado
        SELECT 'No se encontró un Usua_ID para el nombre de usuario proporcionado' AS Resultado;
    END IF;
END //

DELIMITER ;




DELIMITER //

CREATE PROCEDURE ActualizarUsuario_Vendedor(
    IN p_Usua_Nombre VARCHAR(30),
    IN p_Usua_Contra VARCHAR(30),
    
    IN p_Usua_Estatus BOOL,
    
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
    DECLARE v_Usua_ID INT;

    -- Obtener el Usua_ID del nombre de usuario
    SELECT Usua_ID INTO v_Usua_ID FROM Usuario WHERE Usua_Nombre = p_Usua_Nombre;

    -- Verificar si se encontró un Usua_ID
    IF v_Usua_ID IS NOT NULL THEN
        -- Actualizar información en la tabla Usuario
        UPDATE Usuario
        SET Usua_Nombre = p_Usua_Nombre,
            Usua_Contra = p_Usua_Contra,
           
            Usua_Estatus = p_Usua_Estatus
           
        WHERE Usua_ID = v_Usua_ID;

        -- Actualizar información en la tabla Usuario_Info
        UPDATE Usuario_Info
        SET UsIn_Nombre = p_UsIn_Nombre,
            UsIn_ApellidoPa = p_UsIn_ApellidoPa,
            UsIn_ApellidoMa = p_UsIn_ApellidoMa,
            UsIn_Sexo = p_UsIn_Sexo,
            UsIn_Telefono = p_UsIn_Telefono,
            UsIn_Correo = p_UsIn_Correo,
            UsIn_Foto = p_UsIn_Foto,
            UsIn_Fecha_Nac = p_UsIn_Fecha_Nac,
            UsIn_Fecha_Creac = p_UsIn_Fecha_Creac,
            UsIn_Estatus = p_UsIn_Estatus
        WHERE Usua_ID = v_Usua_ID;
    ELSE
        -- No se encontró un Usua_ID para el nombre de usuario proporcionado
        SELECT 'No se encontró un Usua_ID para el nombre de usuario proporcionado' AS Resultado;
    END IF;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE DesactivarUsuario(
    IN p_Usua_Nombre VARCHAR(30)
)
BEGIN
    -- Actualizar el estado del usuario a 0 o false
    UPDATE Usuario
    SET Usua_Estatus = 0
    WHERE Usua_Nombre = p_Usua_Nombre;

    -- Si deseas actualizar también en Usuario_Info, descomenta esta línea
    -- UPDATE Usuario_Info
    -- SET UsIn_Estatus = 0
    -- WHERE Usua_ID = (SELECT Usua_ID FROM Usuario WHERE Usua_Nombre = p_Usua_Nombre);
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE VerificarCredenciales(IN p_Usuario VARCHAR(30), IN p_Contrasena VARCHAR(30), OUT p_Resultado INT)
BEGIN
    DECLARE v_UsuarioCount INT;
    
    -- Verifica si el usuario y la contraseña coinciden en la tabla Usuario
    SELECT COUNT(*) INTO v_UsuarioCount
    FROM Usuario
    WHERE Usua_Nombre = p_Usuario AND Usua_Contra = p_Contrasena;
    
    -- Asigna 1 si las credenciales son correctas, 0 si no son correctas
    IF v_UsuarioCount = 1 THEN
        SET p_Resultado = 1;
    ELSE
        SET p_Resultado = 0;
    END IF;
END //

DELIMITER ;




-- Declaración de variables
DECLARE @resultado INT;

-- Llama al procedimiento para verificar las credenciales
CALL VerificarCredenciales('Edgar12', 'Jesus.2023', @resultado);

-- Comprueba el valor de resultado
IF @resultado = 1 THEN
    -- Las credenciales son correctas
    SELECT 'Credenciales correctas' AS Mensaje;
ELSE
    -- Las credenciales son incorrectas
    SELECT 'Credenciales incorrectas' AS Mensaje;
END IF;