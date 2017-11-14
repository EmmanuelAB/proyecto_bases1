--                                                     CREACIÓN DE LAS TABLAS 
CREATE TABLE cliente (
    cedula int PRIMARY KEY,
    nombre varchar(20) NOT NULL,
    apellido1 varchar(20) NOT NULL,
    apellido2 varchar(20),
    telefono1 int NOT NULL,
    telefono2 int,
    direccion varchar(200)
);

CREATE TABLE tipocarro (
    idtipocarro serial PRIMARY KEY,
    marca varchar(10) NOT NULL,
    modelo varchar(10),
    año int
);

CREATE TABLE producto (
    codigo serial PRIMARY KEY,
    nombre varchar(60) NOT NULL,
    tipo varchar(10)  --dice si es quimico o repuesto
);

CREATE TABLE aplicapara (
    idtipocarro int NOT NULL,
    codigoproducto int NOT NULL,
    precio int,
    cantidad int,

    CONSTRAINT idaplicapara PRIMARY KEY (idtipocarro, codigoproducto),
    CONSTRAINT aplicapara_idtipocarro_fkey FOREIGN KEY (idtipocarro) REFERENCES tipocarro(idtipocarro),
    CONSTRAINT aplicapara_codigoproducto_fkey FOREIGN KEY (codigoproducto) REFERENCES producto(codigo)
);

CREATE TABLE carro (
    placa varchar(10) PRIMARY KEY,
    idtipocarro int,
    cedula int,
    CONSTRAINT carro_idtipocarro_fkey FOREIGN KEY (idtipocarro) REFERENCES tipocarro(idtipocarro)
);

CREATE TABLE entradaexp (
    identradaexp serial PRIMARY KEY,
    fecha varchar(10),
    descripcion varchar(50), --solo si hace trabajo -> pone descrip 
    cantidad int,
    total int,
    cedula int, 
    codigoproducto int,      --si vende producto pone el codigo del producto
    idtipocarro int,         --y el id del carro (por que el pk son ambos atributos)

    CONSTRAINT entradaexp_cedula_fkey FOREIGN KEY (cedula) REFERENCES cliente(cedula),
    CONSTRAINT entradaexp_codigoproducto_fkey FOREIGN KEY (codigoproducto) REFERENCES producto(codigo),
    CONSTRAINT entradaexp_idtipocarro_fkey FOREIGN KEY (idtipocarro) REFERENCES tipocarro(idtipocarro)
);


--                                                     CREACIÓN DE LAS VISTAS
CREATE VIEW ver_primeros_clientes AS
 SELECT cliente.cedula,
    cliente.nombre,
    cliente.apellido1,
    cliente.apellido2,
    cliente.telefono1,
    cliente.telefono2,
    cliente.direccion
   FROM cliente;

--                                                     CREACION DE INDICES
CREATE INDEX ON cliente(nombre);



--                                                     CREACIÓN DE PROCEDIMIENTOS ALMACENADOS
CREATE FUNCTION aumentar(_tipocarro int, _porcentaje real) RETURNS void
    LANGUAGE plpgsql
    AS $$
begin
	update aplicapara set precio = precio + precio*(_porcentaje/100) where idtipocarro = _tipocarro;
end;
$$;

--                                                     INSERCION DE DATOS DE EJEMPLO
 INSERT INTO tipocarro (marca, modelo, año) VALUES 
	 ('Toyota',	'Corolla',		1989),
	 ('Toyota',	'Starlet',		1990),
	 ('Nissan',	'Sentra',		1995),
	 ('Nissan',	'D21',			1995),
	 ('Nissan',	'SentraB12',	1988),
	 ('Nissan',	'SentraB13',	1990),
	 ('Honda',	'Civic',		1995),
	 ('Honda',	'Accord',		1998),
	 ('Toyota',	'Hilux',		2010),
	 ('Subaru',	'Impeza',		2012),
	 ('Toyota',	'Corolla',		1992),
	 ('Toyota',	'Corolla', 		1999),
	 ('Nissan',	'Versa',		2017),
	 ('Nissan',	'Versa',		2015)
 ;
 
  INSERT INTO cliente (cedula, nombre, apellido1, apellido2, telefono1, telefono2, direccion) VALUES
	 (1234563,	'Gerardo', 'Soto',      'Cruz',      63312287,	0	,'El llano, Alajuela'),
	 (1234564,	'Estefany','Molina',    'Espinoza',  61345987,	0	,'Tacares, Alajuela'),
	 (1934981,	'Pepe',    'Ramirez',   'Arroyo',    89321745,	0	,'La Uruca, San José'),
	 (4240867,	'Isaac',   'Mena',      'Lopez',     31232398,	0	,'San Joaquín, Heredia'),
	 (1234562,	'María',   'Corrales',  'Bolaños',	 63412299,	0	,'Paraiso, Cartago'),
	 (1234569,	'Jose',    'Alfaro',    'Rojas',     61512155,	0	,'Santa Cruz, Guanacaste'),
	 (8182123,	'Mario',   'Gonzales',  'Perez',     48578121,	0	,'San Joaquín, Flores'),
	 (1234567,	'Juana',   'Perez',     'Lopez',     60409125,	0	,'Puente de Piedra, Grecia'),
	 (1234561,	'Maria',   'Alpizar',   'Mena',      61412255,	0	,'Osa, Cartago'),
	 (1234568,	'Lucas',   'Rodriguez', 'Hidalgo',   61505125,	0	,'San Joaquin, Flores')
 ;
 
 INSERT INTO producto (nombre, tipo) VALUES
	 ('dash',		    		'repuesto'),
	 ('guantera',				'repuesto'),
	 ('bumber',					'repuesto'),
	 ('arrancador',				'repuesto'),
	 ('alternador',				'repuesto'),
	 ('booster',				'repuesto'),
	 ('radio',					'repuesto'),
	 ('aceite amalie 20w50',    'quimico'),
	 ('desengrasante naranja',  'quimico'),
	 ('cloro galon',			'quimico'),
	 ('aceite castrol 20w50',	'quimico')
 ;
 
 INSERT INTO aplicapara (idtipocarro, codigoproducto, precio, cantidad) VALUES
	 (1,	3,	5000,	1),
	 (1,	2,	7500,	5),
	 (1,	5,	15000,	8),
	 (2,	5,	30000,	2),
	 (3,	5,	45000,	9),
	 (4,	2,	2000,	4),
	 (2,	1,	17500,	12),
	 (11,	1,	10000,	20)
;

 INSERT INTO carro (placa, idtipocarro, cedula) VALUES
	 ('XYZ123',	1,	1234567),
	 ('XYZ124',	2,	1234567),
	 ('ABC123',	3,	1234564),
	 ('ABX123',	6,	1234562)
 ;



 INSERT INTO entradaexp (fecha, descripcion, cantidad, total, cedula, codigoproducto, idtipocarro) VALUES
	 ('2017-07-08'	,'venta',	           1,7500,	1234563,	2,1),
	 ('2017-07-08'	,'venta',	           1,30000,	1234563,	5,2),
	 ('2017-07-08'	,'venta',	           1,45000,	1234563,	5,3),
	 ('2017-07-08'	,'venta',	           1,7000,	1934981,	2,4),
	 ('2017-07-08'	,'venta',	           1,7000,	1934981,	5,3),
	 ('2017-07-08'	,'venta',	           1,7000,	1934981,	1,2),
	 ('2017-07-08'	,'venta',	           1,7000,	1234567,	2,4),
	 ('2017-07-08'	,'cambio_aceite',      1,12500,	1234563,NULL,NULL),
	 ('2017-07-08'	,'overhaul',	       1,30000,	1234563,NULL,NULL),
	 ('2017-07-08'	,'venta',	           1,1000,	1234567,	5,3),
	 ('2017-07-08'	,'venta',	           1,1000,	1234567,	1,2)
 ;
 
-- INSERT INTO entradaexp (fecha, descripcion, cantidad, total, cedula) VALUES
-- 	 ('2017-07-08'	,'cambio_aceite',      1,5000,	1234563),
--	 ('2017-07-08'	,'overhaul',	       1,50000,	1234563)
--;
 


