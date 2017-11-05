Create Table "Cliente"(
	"Cedula" int not null,
	"Nombre" varchar(20) not null,
	"Apellido1" varchar(25) not null,
	"Apellido2" varchar(25) not null,
	"Telefono1" int not null,
	"Telefono2" int,
	"Direccion" varchar(150),
	Constraint "PK_Cliente" Primary Key("Cedula")
);

Create Table "Producto"(
	"Codigo_Producto" int not null,
	"Nombre" varchar(20) not null,
	"Precio" int not null,
	"Cantidad" int not null,
	"Tipo" int,
	Constraint "PK_Producto" Primary Key("Codigo_Producto")
);

Create Table "TipoCarro"(
	"Id_TipoCarro" int not null,
	"Marca" varchar(15) not null,
	"Modelo" varchar(15),
	"Año" int not null,
	Constraint "PK_TipoCarro" Primary Key("Id_TipoCarro")
);

Create Table "Carro"(
	"Placa" int not null,
	"TipoCarro" int not null,
	"CedulaCliente" int not null,
	Constraint "PK_Carro" Primary Key("Placa"),
	Constraint "FK_TipoCarro" Foreign Key("TipoCarro") references "TipoCarro"("Id_TipoCarro"),
	Constraint "FK_Cliente" Foreign Key("CedulaCliente") references "Cliente"("Cedula")
);

Create Table "Entrada_Exp"(
	"IdEntrada" int not null,
	"CedulaCliente" int,
	"Fecha" DATE not null,
	"Descripcion" varchar(250),
	"Codigo_Producto" int,
	"Cantidad" int,
	"Total" int,
	Constraint "PK_Entrada_Exp" Primary Key("IdEntrada"),
	Constraint "FK_Producto" Foreign Key("Codigo_Producto") references "Producto"("Codigo_Producto"),
	Constraint "FK_Cliente" Foreign Key("CedulaCliente") references "Cliente"("Cedula")
);

Create Table "Aplica_Para"(
	"Codigo_Producto" int not null,
	"TipoCarro" int not null,
	Constraint "FK_Producto" Foreign Key("Codigo_Producto") references "Producto"("Codigo_Producto"),
	Constraint "FK_TipoCarro" Foreign Key("TipoCarro") references "TipoCarro"("Id_TipoCarro")	
);
