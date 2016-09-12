create database db_infobeth;
	go
	create table class_persona
		(
			codPersona int not null,
			nombres varchar(45) not null,
			apellidos varchar(100) not null,
			sexo char(1) not null,
			telefono char(15),
			email varchar(60),
			fechaNacim date,
			PRIMARY KEY(codPersona)
		);
	create table class_estudiante
		(
			registro int not null,
			fechaInicio date not null,
			fechaCulminaion date not null,
			estado char(1),
			codPersona int not null,
			foreign key (codPersona) references class_persona(codPersona),
			primary key(registro)
		);

	create table class_bibliotecario
		(
			usuario varchar(50) not null,
			clave varchar(10) not null,
			turno varchar(25) not null,
			estado char(1) not null,
			codPersona int not null,
			foreign key (codPersona) references class_persona(codPersona),
			primary key(usuario)
		);

	create table class_libro
		(
			codLibro varchar(30) not null ,
			nombreLibro varchar(50),
			numeroPag int not null,
			año_edicion date not null,
			num_ejemplares int,
			estado_libro char(1),
			codAutor int not null,
			codEditorial int not null,
			codCategoria int not null,
			primary key(codLibro),
			foreign key(codAutor)references class_autor(codAutor),
			foreign key(codEditorial) references class_editorial(codEditorial),
			foreign key(codCategoria) references class_categoria(codCategoria)
		);
	create table class_categoria
		(
			codCategoria int not null,
			nombre_c varchar(50),
			descripcion_c varchar(50),
			estado char(1) not null,
			primary key(codCategoria)
		);

delimiter $
CREATE PROCEDURE insertCategoria 
(
	in n_codCategoria int(11),
	in n_nombre_c varchar(50),
	in n_descripcion_c varchar(50),
	in n_estado char(1)
)
BEGIN 
	INSERT INTO class_categoria 
(
	codCategoria,
	nombre_c,
	descripcion_c,
	estado
)
VALUES
( 
	n_codCategoria,
	n_nombre_c ,
	n_descripcion_c,
	n_estado
);
END


	create table class_autor 
		(
			codAutor int not null,
			nombreAutor varchar(50) not null,
			nacionalidadAutor varchar(50) not null,
			fechaNacimAutor date,
			primary key(codAutor)
		);
delimiter $
CREATE PROCEDURE insertAutor
(
	in n_codAutor int,
	in n_nombreAutor varchar(50),
	in n_nacionalidadAutor varchar(50),
	in n_fechaNacimAutor date
)
BEGIN 
	INSERT INTO class_autor
(
	codAutor,
	nombreAutor,
	nacionalidadAutor,
	fechaNacimAutor
)
VALUES
( 
	n_codAutor,
	n_nombreAutor,
	n_nacionalidadAutor,
	n_fechaNacimAutor
);
END



	create table class_editorial
		(
			codEditorial int not null,
			nombreEditorial varchar(60) not null,
			descripcion varchar(50) not null,
			primary key (codEditorial)
		);


delimiter $
CREATE PROCEDURE insertEditorial
(
	in n_codEditorial int,
	in n_nombreEditorial varchar(60),
	in n_descripcion varchar(50)
)
BEGIN 
	INSERT INTO class_editorial
(
	codEditorial,
	nombreEditorial,
	descripcion
)
VALUES
( 
	n_codEditorial,
	n_nombreEditorial,
	n_descripcion
);
END

	create table class_prestamo 
			( 
				codPrestamo int not null,
				fechaSalida timestamp, 
				fechaDevollucion date not null, 
				notaGlosa varchar(100), 
				estado char(1),
				primary key(codPrestamo), 
				registro int not null, 
				usuario varchar(50) not null, 
				codLibro varchar(30) not null, 
				foreign key (registro) references class_estudiante(registro), 
				foreign key (usuario) references class_bibliotecario(usuario), 
				foreign key (codLibro) references class_libro(codLibro)
			);
	create table class_multa
			(
				codMulta int not null,
				nombreMulta varchar(50) not null,
				descripcionMulta varchar(100) not null,
				precioMulta float not null,
				codPrestamo int not null,
				foreign key(codPrestamo)references class_prestamo(codPrestamo)
			);
	create table class_devolucion
			(
				fechaDevollucion timestamp,
				glosaDevolucion varchar(100) not null,
				codPrestamo int not null,
				foreign key(codPrestamo)references class_prestamo(codPrestamo),
				primary key(codPrestamo)
			);


create table class_reserva (
    codReserva int not null,
    fechaReserva date not null,
    fechaLimite date not null,
    estado char(1),
    codLibro varchar(30),
    foreign key (codLibro)references class_libro(codLibro),
    primary key (codReserva)
);