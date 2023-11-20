create database	superbia;


-- Seleccionamos la base de datos:
USE superbia;

-- TABLA 1: Usuario
CREATE TABLE Usuario (
    Usua_ID int auto_increment PRIMARY KEY NOT NULL,
    Usua_Nombre VARCHAR(30) NOT NULL,
    Usua_Contra VARCHAR(30) NOT NULL,
    Usua_PubPriv BOOL NOT NULL,
    Usua_Estatus BOOL NOT NULL,
    Role_ID INT NOT NULL,
    FOREIGN KEY (Role_ID) REFERENCES Roles(Role_ID)
);

-- TABLA 2: Usuario_Info
CREATE TABLE Usuario_Info (
    UsIn_ID INT auto_increment PRIMARY KEY NOT NULL,
    Usua_ID INT NOT NULL,
    UsIn_Nombre VARCHAR(30) NOT NULL,
    UsIn_ApellidoPa VARCHAR(30) NOT NULL,
    UsIn_ApellidoMa VARCHAR(30) NOT NULL,
    UsIn_Sexo VARCHAR(25) NOT NULL,
    UsIn_Telefono VARCHAR(20) NOT NULL,
    UsIn_Correo VARCHAR(60) NOT NULL,
    UsIn_Foto BLOB NOT NULL,
    UsIn_Fecha_Nac DATE NOT NULL,
    UsIn_Fecha_Creac DATETIME NOT NULL,
    UsIn_Estatus BOOL NOT NULL,
    FOREIGN KEY (Usua_ID) REFERENCES Usuario(Usua_ID)
);
-- TABLA 3: Roles
CREATE TABLE Roles (
    Role_ID INT auto_increment PRIMARY KEY NOT NULL,
    Role_Nombre VARCHAR(15) NOT NULL,
    Role_Estatus BOOL NOT NULL
);

INSERT INTO Roles (Role_Nombre, Role_Estatus) 
VALUES ('Administrador', 1);

INSERT INTO Roles (Role_Nombre, Role_Estatus) 
VALUES ('Usuario', 1);

INSERT INTO Roles (Role_Nombre, Role_Estatus) 
VALUES ('vendedor', 1);

INSERT INTO Usuario (Usua_Nombre, Usua_Contra, Usua_PubPriv, Usua_Estatus, Role_ID)
VALUES ('Usuario1', 'contrasena123', 1, 1, 1);
INSERT INTO Usuario_Info (Usua_ID, UsIn_Nombre, UsIn_ApellidoPa, UsIn_ApellidoMa, UsIn_Sexo, UsIn_Telefono, UsIn_Correo, UsIn_Foto, UsIn_Fecha_Nac, UsIn_Fecha_Creac, UsIn_Estatus)
VALUES (1, 'John', 'Doe', 'Smith', 'Masculino', '123456789', 'john.doe@example.com', 'imagen_binaria', '1990-05-15', '2023-10-07 14:30:00', 1);

select * from Roles;
select * from usuario;
select * from usuario_info;

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



-- TABLA 4: Produ_Comprados
CREATE TABLE Produ_Comprados (
    PrCo_ID INT auto_increment PRIMARY KEY,
    Usua_ID INT,
    Prod_ID INT,
    FOREIGN KEY (Usua_ID) REFERENCES Usuario(Usua_ID),
    FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID)
);

-- TABLA 5: Producto
CREATE TABLE Producto (
    Prod_ID INT auto_increment PRIMARY KEY NOT NULL,
    Prod_Nombre VARCHAR(50) NOT NULL,
    Prod_Precio DECIMAL(10, 2) NOT NULL,
    Prod_Cotizable BOOL,
    Prod_Estatus BOOL NOT NULL
);


-- TABLA 6: Producto_Info
CREATE TABLE Producto_Info (
    PrIn_ID INT auto_increment PRIMARY KEY NOT NULL,
    Prod_ID INT NOT NULL,
    Usua_ID INT NOT NULL,
    Cate_ID INT NOT NULL,
    PrIn_Descripcion TEXT NOT NULL,
    PrIn_Fecha_Creac DATE NOT NULL,
    PrIn_Existencia INT NOT NULL,
    PrIn_Validado BOOL,
    PrIn_Estatus BOOL NOT NULL,
    FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID),
    FOREIGN KEY (Usua_ID) REFERENCES Usuario(Usua_ID),
    FOREIGN KEY (Cate_ID) REFERENCES Categorias(Cate_ID)
);

-- TABLA 7: MetodoPago
CREATE TABLE MetodoPago (
    MePa_ID INT auto_increment PRIMARY KEY NOT NULL,
    MePa_Nombre VARCHAR(15) NOT NULL,
    MePa_Estatus BOOL NOT NULL
);

-- TABLA 8: Calificacion
CREATE TABLE Calificacion (
    Cali_ID INT auto_increment PRIMARY KEY,
    Cali_Valor INT,
    Cali_Estatus BOOL
);

-- TABLA 9: Lista_Deseos
CREATE TABLE Lista_Deseos (
    LiDe_ID INT auto_increment PRIMARY KEY NOT NULL,
    Usua_ID INT NOT NULL,
    LiDe_Nombre VARCHAR(15),
    LiDe_Visible BOOL,
    LiDe_Estatus BOOL,
    FOREIGN KEY (Usua_ID) REFERENCES Usuario(Usua_ID)
);

-- TABLA 10: Lista_Deseos_Prod
CREATE TABLE Lista_Deseos_Prod (
    LiDP_ID INT auto_increment PRIMARY KEY NOT NULL,
    LiDe_ID INT NOT NULL,
    Prod_ID INT NOT NULL,
    LiDP_Estatus BOOL,
    cantidad_lista int,
    FOREIGN KEY (LiDe_ID) REFERENCES Lista_Deseos(LiDe_ID),
    FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID)
);

-- TABLA 11: Carrito
CREATE TABLE Carrito (
    Carr_ID INT auto_increment PRIMARY KEY NOT NULL,
    Usua_ID INT NOT NULL,
    Prod_ID INT NOT NULL,
    Carr_Fecha_Agregado DATE NOT NULL,
    cantidad int, 
    Carr_Estatus BOOL,
    FOREIGN KEY (Usua_ID) REFERENCES Usuario(Usua_ID),
    FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID)
);

-- TABLA 12: Media
CREATE TABLE Media (
    Medi_ID INT auto_increment PRIMARY KEY NOT NULL,
    Prod_ID INT NOT NULL,
    TiMe_ID INT NOT NULL,
    Medi_Nombre_Archivo VARCHAR(80) NOT NULL,
    Medi_Archivo LongBLOB NOT NULL,
    Medi_Estatus BOOL NOT NULL,
    FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID),
    FOREIGN KEY (TiMe_ID) REFERENCES Tipo_Media(TiMe_ID)
);

-- TABLA 13: Venta
CREATE TABLE Venta (
    Vent_ID INT auto_increment PRIMARY KEY NOT NULL,
   
    Usua_ID_Comp INT NOT NULL,
    Vent_Fecha DATETIME NOT NULL,
    Vent_Precio DECIMAL(10, 2) NOT NULL,
    Vent_tarjeta_ID INT NOT NULL,
    Cali_ID INT NOT NULL,
    Vent_Estatus BOOL NOT NULL,
    FOREIGN KEY (Usua_ID_Comp) REFERENCES Usuario(Usua_ID),
    FOREIGN KEY (Vent_tarjeta_ID) REFERENCES Tarjeta(tarjeta_ID),
    FOREIGN KEY (Cali_ID) REFERENCES Calificacion(Cali_ID)
);

CREATE TABLE Venta_por_producto (
    Ventp_ID INT auto_increment PRIMARY KEY NOT NULL,
    Venta_ID INT,
	Usua_ID_Vend INT NOT NULL,
    ventp_Prod_ID INT NOT NULL,
	Cantidad INT NOT NULL,
    Ventp_PrecioUnidad DECIMAL(10, 2) NOT NULL,
	Ventp_Precio_total DECIMAL(10, 2) NOT NULL,
    Ventp_Estatus BOOL NOT NULL,
    FOREIGN KEY (Venta_ID) REFERENCES Venta(Vent_ID),
	FOREIGN KEY (Usua_ID_Vend) REFERENCES Usuario(Usua_ID),

    FOREIGN KEY (ventp_Prod_ID) REFERENCES Producto(Prod_ID)
    
);


-- TABLA 14: Comentarios
CREATE TABLE Comentarios (
    Come_ID INT auto_increment PRIMARY KEY NOT NULL,
    Prod_ID INT NOT NULL,
    Usua_ID INT NOT NULL,
    Cali_ID INT NOT NULL,
    Come_Comentario TEXT NOT NULL,
    Come_Estatus BOOL NOT NULL,
    FOREIGN KEY (Prod_ID) REFERENCES Producto(Prod_ID),
    FOREIGN KEY (Usua_ID) REFERENCES Usuario(Usua_ID),
    FOREIGN KEY (Cali_ID) REFERENCES Calificacion(Cali_ID)
);

-- TABLA 15: Categorias
CREATE TABLE Categorias (
    Cate_ID INT auto_increment PRIMARY KEY NOT NULL,
    Usua_ID INT NOT NULL,
    Cate_Nombre VARCHAR(15) NOT NULL,
    Cate_Descripcion TEXT NOT NULL,
    Cate_Estatus BOOL NOT NULL,
    FOREIGN KEY (Usua_ID) REFERENCES Usuario(Usua_ID)
);

-- TABLA 16: Tipo_Media
CREATE TABLE Tipo_Media (
    TiMe_ID INT auto_increment PRIMARY KEY NOT NULL,
    TiMe_Nombre VARCHAR(50) NOT NULL,
    TiMe_Estatus BOOL NOT NULL
);

-- TABLA 17: Chat
CREATE TABLE Chat (
    Chat_ID INT auto_increment PRIMARY KEY NOT NULL,
    Chat_Fecha DATETIME NOT NULL,
    RemitenteID INT NOT NULL,
    DestinatarioID INT NOT NULL,
    Chat_Mensaje TEXT NOT NULL,
    Chat_Msg_Estatus INT NOT NULL,
    FOREIGN KEY (Usua_ID_Comp) REFERENCES Usuario(Usua_ID),
    FOREIGN KEY (Usua_ID_Vend) REFERENCES Usuario(Usua_ID)
);
