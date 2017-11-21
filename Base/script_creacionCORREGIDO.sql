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
    CONSTRAINT carro_idtipocarro_fkey FOREIGN KEY (idtipocarro) REFERENCES tipocarro(idtipocarro),
    CONSTRAINT carro_cedula_fkey FOREIGN KEY (cedula) REFERENCES cliente(cedula)
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

CREATE OR REPLACE FUNCTION total(cantidad_p integer, codigo_p integer, tipocarro_p integer)
  RETURNS integer AS
$BODY$
DECLARE	
precio integer;
DECLARE
total integer;
BEGIN
	SELECT a.precio into precio FROM aplicapara a WHERE a.codigoproducto = codigo_p and a.idtipocarro=tipocarro_p;
	UPDATE aplicapara set cantidad = cantidad-cantidad_p where codigoproducto = codigo_p and idtipocarro=tipocarro_p;
    total = precio * cantidad_p;
	RETURN total;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE;

--                                                     INSERCION DE DATOS DE EJEMPLO
 INSERT INTO tipocarro (marca, modelo, año) VALUES 
	 ('Toyota',	'Corolla',		1989),
	 ('Nissan',	'Sentra',		1995),
	 ('Honda',	'Accord',		1998)
 ;
 
  INSERT INTO cliente (cedula, nombre, apellido1, apellido2, telefono1, telefono2, direccion) VALUES
	 (1234561,	'Gerardo', 'Soto',      'Cruz',      63312287,	0	,'El llano, Alajuela'),
	 (1234562,	'Estefany','Molina',    'Espinoza',  61345987,	0	,'Tacares, Alajuela'),
	 (1234563,	'Pepe',    'Ramirez',   'Arroyo',    89321745,	0	,'La Uruca, San José')
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
	 (1,	1,	5000,	20),
	 (1,	2,	7500,	20),
	 (1,	3,	15000,	20),
	 (2,	4,	30000,	20),
	 (2,	5,	45000,	20),
	 (2,	6,	2000,	20),
	 (3,	7,	17500,	20),
	 (3,	1,	10000,	20)
;

 INSERT INTO carro (placa, idtipocarro, cedula) VALUES
	 ('XYZ123',	1,	1234561),
	 ('XYZ124',	2,	1234562),
	 ('ABC123',	3,	1234563),
	 ('ABX123',	2,	1234561)
 ;



 INSERT INTO entradaexp (fecha, descripcion, cantidad, total, cedula, idtipocarro, codigoproducto) VALUES
	 ('2017-07-08'	,'venta',	           1,total(1,1,1),	1234561,	1,1),
	 ('2017-07-08'	,'venta',	           2,total(2,2,1),	1234562,	1,2),
	 ('2017-07-08'	,'venta',	           1,total(1,3,1),	1234563,	1,3),
	 ('2017-07-08'	,'venta',	           1,total(1,4,2),	1234561,	2,4),
	 ('2017-07-08'	,'venta',	           3,total(3,5,2),	1234562,	2,5),
	 ('2017-07-08'	,'venta',	           1,total(1,6,2),	1234563,	2,6),
	 ('2017-07-08'	,'venta',	           4,total(4,4,2),	1234561,	2,4),
	 ('2017-07-08'	,'cambio_aceite',      1,32000,			1234562,NULL,NULL),
	 ('2017-07-08'	,'overhaul',	       1,14000,			1234563,NULL,NULL),
	 ('2017-07-08'	,'venta',	           2,total(2,7,3),	1234561,	3,7),
	 ('2017-07-08'	,'venta',	           1,total(1,1,3),	1234562,	3,1)
 ;
