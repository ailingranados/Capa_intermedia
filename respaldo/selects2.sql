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