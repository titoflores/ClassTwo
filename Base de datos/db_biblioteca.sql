-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2016 a las 04:03:07
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_biblioteca`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarEstudiante`(
	in n_registro int
)
BEGIN 
	SELECT 
    E.registro, P.nombres, P.apellidos, E.estado
FROM
    class_estudiante AS E,
    class_persona AS P
WHERE
    P.codPersona = E.codPersona
        AND E.registro = n_registro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarFeriado`( 
in n_fechaActual date)
BEGIN 
select * from calendario
WHERE fecha=n_fechaActual;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarLibroCodigo`( 
in n_codLibro varchar(30))
BEGIN 
SELECT 
	L.codLibro,
	L.nombreLibro,
	C.nombre_c,
	A.nombreAutor
FROM class_libro AS L, class_categoria AS C, class_autor AS A
WHERE 
L.codCategoria=C.codCategoria
AND L.codAutor=A.codAutor
AND
CONCAT(L.codLibro) 
like Concat(n_codLibro);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarLibroGeneral`( 
in pal_buscar varchar(50))
BEGIN 
SELECT
	L.codLibro,
	L.nombreLibro,
	C.nombre_c,
	A.nombreAutor 
FROM 
	class_libro AS L,
	class_categoria AS C,
	class_autor AS A
WHERE 
L.codCategoria=C.codCategoria
AND L.codAutor=A.codAutor
AND
CONCAT(L.codLibro,' ',L.nombreLibro,' ', C.nombre_c,' ', A.nombreAutor) 
like Concat('%',pal_buscar,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertAutor`(
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertBitacora`(
n_codBitacora int,
n_ip varchar(24),
n_usuario varchar(60),
n_claseBD varchar(50),
n_accionInclass varchar(50)
)
BEGIN
INSERT INTO
 bitacora VALUES(
n_codBitacora,
null,
n_ip,
(SELECT @@hostname),
n_usuario,
n_claseBD,
n_accionInclass
);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertCategoria`(
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertEditorial`(
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPrestamo`(
	in n_codPrestamo int,
	in n_fechaSalida date,
	in n_fechaDevolucion date,
	in n_notaGlosa varchar(100),
	in n_estado char(1),
	in n_registro int,
	in n_usuario varchar(50),
	in n_codLibro varchar(30)
)
BEGIN 
	INSERT INTO class_prestamo
(
	codPrestamo,
	fechaSalida,
	fechaDevolucion,
	notaGlosa,
	estado,
	registro,
	usuario,
	codLibro
)
VALUES
( 
	n_codPrestamo,
	n_fechaSalida,
	n_fechaDevolucion,
	n_notaGlosa,
	n_estado,
	n_registro,
	n_usuario,
	n_codLibro
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertReserva`(
	in n_codReserva int,
	in n_fechaReserva date,
	in n_fechaLimite date,
	in n_estado char(1),
	in n_codLibro varchar(30),
	in n_registro int
)
BEGIN 
	INSERT INTO class_reserva
(
	codReserva,
	fechaReserva,
	fechaLimite,
	estado,
	codLibro,
	registro
)
VALUES
( 
	n_codReserva,
	n_fechaReserva,
	n_fechaLimite,
	n_estado,
	n_codLibro,
	n_registro
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaMulta`(
)
BEGIN 


select 
P.fechaSalida,
P.fechaDevolucion,
D.fechaDevolucion as devuelta,
P.registro,
P.usuario,
L.codLibro,
L.nombreLibro,
M.descripcionMulta,
M.precioMulta,
M.estado
from 
class_prestamo as P, 
class_libro as L,
class_multa as M,
class_devolucion as D
WHERE P.registro=P.registro
AND P.codLibro=L.codLibro
AND M.codPrestamo=P.codPrestamo
AND D.codPrestamo=P.codPrestamo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listDevolucion`()
BEGIN 
select 
fechaDevolucion,
glosaDevolucion,
codPrestamo 
FROM 
class_devolucion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listLibro`()
BEGIN 
	SELECT 
    L.codLibro,
    L.nombreLibro,
    L.numeroPag,
    L.ano_edicion,
    L.num_ejemplares,
    L.estado_libro,
	A.codAutor,
    A.nombreAutor,
	E.codEditorial,
    E.nombreEditorial,
	C.codCategoria,
    C.nombre_c
FROM
    class_libro AS L,
    class_autor AS A,
    class_editorial AS E,
    class_categoria AS C
WHERE 
L.codAutor=A.codAutor
AND L.codEditorial=E.codEditorial
AND L.codCategoria=C.codCategoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listPrestamo`()
BEGIN 
SELECT 
	P.codPrestamo,    
	P.fechaSalida,
	P.fechaDevolucion, 
	P.notaGlosa, P.estado, 
	E.registro,B.usuario, 
	L.codLibro,
	L.nombreLibro,
	B.usuario
FROM
    class_prestamo AS P,
	class_estudiante AS E,
	class_libro AS L,
	class_bibliotecario AS B
WHERE 
	P.codLibro = L.codLibro
AND P.usuario=B.usuario
AND P.registro=E.registro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listPrestamo_est`(
n_registro int
)
BEGIN 
SELECT 
	P.codPrestamo,    
	P.fechaSalida,
	P.fechaDevolucion, 
	P.notaGlosa, P.estado, 
	E.registro,B.usuario, 
	L.codLibro,	
	L.nombreLibro,
	B.usuario
FROM
    class_prestamo AS P,
	class_estudiante AS E,
	class_libro AS L,
	class_bibliotecario AS B
WHERE 
	P.codLibro = L.codLibro
AND P.usuario=B.usuario
AND P.registro=E.registro
AND P.registro=n_registro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listReserva`()
BEGIN 
SELECT 
    R.codReserva,
	R.fechaReserva,
	R.fechaLimite,
	R.estado,
	L.codLibro,
	L.nombreLibro,
	E.registro, 
	P.nombres, 
	P.apellidos
FROM
    class_reserva AS R,
	class_libro AS L,
	class_estudiante AS E,
	class_persona AS P
WHERE 
	R.codLibro = L.codLibro
	AND R.registro=E.registro
	AND E.codPersona=P.codPersona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `numeroPrestamos`(
n_codLibro int
)
BEGIN
 SELECT 
		* from class_prestamo 
	WHERE estado='A'
	and codLibro = n_codLibro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restarEjemplares`( in n_codLibro varchar(30))
BEGIN 
	UPDATE class_libro
SET
num_ejemplares=num_ejemplares-1
WHERE
codLibro=n_codLibro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sumarEjemplares`( in n_codLibro varchar(30))
BEGIN 
	UPDATE class_libro
SET
num_ejemplares=num_ejemplares+1
WHERE
codLibro=n_codLibro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tieneMulta`(
	in n_registro int
)
BEGIN 


select 
P.fechaSalida,
P.fechaDevolucion,
D.fechaDevolucion,
P.registro,
P.usuario,
L.codLibro,
L.nombreLibro,
M.descripcionMulta,
M.precioMulta,
M.estado
from 
class_prestamo as P, 
class_libro as L,
class_multa as M,
class_devolucion as D
WHERE P.registro=n_registro
AND P.codLibro=L.codLibro
AND M.codPrestamo=P.codPrestamo
AND D.codPrestamo=P.codPrestamo
AND M.estado='A';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tienePrestamo`(
	in n_registro int
)
BEGIN 


select 
P.fechaSalida,
P.fechaDevolucion,
P.estado, 
P.registro,
P.usuario,
L.codLibro,
L.nombreLibro 
from 
class_prestamo as P, 
class_libro as L
WHERE P.registro=n_registro
AND P.codLibro=L.codLibro
AND P.estado='A';

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateEjemplares`( in n_codLibro varchar(30),
in n_num_ejemplares int)
BEGIN 
	UPDATE class_libro
SET
num_ejemplares=n_num_ejemplares
WHERE
codLibro=n_codLibro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateEstado`( in n_codLibro varchar(30),
in n_estado_libro char(1))
BEGIN 
	UPDATE class_libro
SET
estado_libro=n_estado_libro
WHERE
codLibro=n_codLibro;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateEstadoPrestamo_Inactivo`( 
in n_codPrestamo int
)
BEGIN 
	UPDATE class_prestamo
SET
estado='I'
WHERE
codPrestamo=n_codPrestamo;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE IF NOT EXISTS `bitacora` (
  `codBitacora` int(11) NOT NULL,
  `fechaHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuarioPc` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `usuarioBd` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `claseBd` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `accionInClass` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=337 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`codBitacora`, `fechaHora`, `usuarioPc`, `usuarioBd`, `claseBd`, `accionInClass`) VALUES
(1, '2015-11-07 05:03:46', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(2, '2015-11-08 21:59:13', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(3, '2015-11-08 22:00:23', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(4, '2015-11-08 22:00:28', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(5, '2015-11-08 22:00:33', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(6, '2015-11-08 22:00:37', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(7, '2015-11-08 22:00:43', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(8, '2015-11-08 22:00:47', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(9, '2015-11-08 22:31:58', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(10, '2015-11-08 22:32:03', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(11, '2015-11-09 01:34:13', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(12, '2015-11-09 01:39:40', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(13, '2015-11-09 01:39:46', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(14, '2015-11-09 01:45:06', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(15, '2015-11-09 02:04:31', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(16, '2015-11-09 02:12:15', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(17, '2015-11-09 02:12:35', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(18, '2015-11-09 02:12:38', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(19, '2015-11-09 02:12:43', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(20, '2015-11-09 02:12:43', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(21, '2015-11-09 02:14:16', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(22, '2015-11-09 02:14:29', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(23, '2015-11-09 02:14:29', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(24, '2015-11-09 02:17:15', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(25, '2015-11-09 02:17:20', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(26, '2015-11-09 02:17:25', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(27, '2015-11-09 02:17:30', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(28, '2015-11-09 02:17:36', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(29, '2015-11-09 02:17:44', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(30, '2015-11-09 02:18:48', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(31, '2015-11-09 02:18:52', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(32, '2015-11-09 02:18:52', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(33, '2015-11-09 02:18:52', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(34, '2015-11-09 02:20:47', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(35, '2015-11-09 02:20:47', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(36, '2015-11-09 02:20:47', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(37, '2015-11-09 02:23:51', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(38, '2015-11-09 02:23:51', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(39, '2015-11-09 02:23:51', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(40, '2015-11-09 02:27:23', 'TITO-PC', 'root', 'class_reserva', 'DELETE'),
(41, '2015-11-09 02:27:36', 'TITO-PC', 'root', 'class_libro', 'DELETE'),
(42, '2015-11-09 02:27:41', 'TITO-PC', 'root', 'class_libro', 'DELETE'),
(43, '2015-11-09 02:27:45', 'TITO-PC', 'root', 'class_libro', 'DELETE'),
(44, '2015-11-09 02:28:09', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(45, '2015-11-09 02:28:12', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(46, '2015-11-09 02:28:16', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(47, '2015-11-09 02:28:35', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(48, '2015-11-09 02:28:39', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(49, '2015-11-09 02:28:43', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(50, '2015-11-09 02:28:46', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(51, '2015-11-09 02:28:50', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(52, '2015-11-09 02:33:41', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(53, '2015-11-09 02:34:18', 'TITO-PC', 'root', 'class_autor', 'DELETE'),
(54, '2015-11-09 02:34:22', 'TITO-PC', 'root', 'class_autor', 'DELETE'),
(55, '2015-11-09 02:34:26', 'TITO-PC', 'root', 'class_autor', 'DELETE'),
(56, '2015-11-09 02:34:29', 'TITO-PC', 'root', 'class_autor', 'DELETE'),
(57, '2015-11-09 02:35:15', 'TITO-PC', 'root', 'class_libro', 'DELETE'),
(58, '2015-11-09 02:35:19', 'TITO-PC', 'root', 'class_libro', 'DELETE'),
(59, '2015-11-09 02:35:23', 'TITO-PC', 'root', 'class_libro', 'DELETE'),
(60, '2015-11-09 02:36:09', 'TITO-PC', 'root', 'class_editorial', 'DELETE'),
(61, '2015-11-09 02:36:12', 'TITO-PC', 'root', 'class_editorial', 'DELETE'),
(62, '2015-11-09 02:36:16', 'TITO-PC', 'root', 'class_editorial', 'DELETE'),
(63, '2015-11-09 02:36:20', 'TITO-PC', 'root', 'class_editorial', 'DELETE'),
(64, '2015-11-09 02:36:24', 'TITO-PC', 'root', 'class_editorial', 'DELETE'),
(65, '2015-11-09 02:36:41', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(66, '2015-11-09 02:36:45', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(67, '2015-11-09 02:36:49', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(68, '2015-11-09 02:36:52', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(69, '2015-11-09 02:36:56', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(70, '2015-11-09 02:38:00', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(71, '2015-11-09 02:38:00', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(72, '2015-11-09 02:38:00', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(73, '2015-11-09 02:38:00', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(74, '2015-11-09 02:38:00', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(75, '2015-11-09 02:38:00', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(76, '2015-11-09 02:38:05', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(77, '2015-11-09 02:38:10', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(78, '2015-11-09 02:38:28', 'TITO-PC', 'root', 'class_autor', 'DELETE'),
(79, '2015-11-09 02:47:38', 'TITO-PC', 'root', 'class_categoria', 'INSERT'),
(80, '2015-11-09 02:48:19', 'TITO-PC', 'root', 'class_categoria', 'UPDATE'),
(81, '2015-11-09 02:48:41', 'TITO-PC', 'root', 'class_categoria', 'INSERT'),
(82, '2015-11-09 02:49:46', 'TITO-PC', 'root', 'class_categoria', 'UPDATE'),
(83, '2015-11-09 02:49:54', 'TITO-PC', 'root', 'class_categoria', 'UPDATE'),
(84, '2015-11-09 02:50:47', 'TITO-PC', 'root', 'class_categoria', 'INSERT'),
(85, '2015-11-09 02:51:24', 'TITO-PC', 'root', 'class_categoria', 'INSERT'),
(86, '2015-11-09 02:58:01', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(87, '2015-11-09 02:58:01', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(88, '2015-11-09 02:58:01', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(89, '2015-11-09 02:58:09', 'TITO-PC', 'root', 'class_categoria', 'UPDATE'),
(90, '2015-11-09 02:58:37', 'TITO-PC', 'root', 'class_categoria', 'UPDATE'),
(91, '2015-11-09 02:58:46', 'TITO-PC', 'root', 'class_categoria', 'UPDATE'),
(92, '2015-11-09 03:05:24', 'TITO-PC', 'root', 'class_categoria', 'INSERT'),
(93, '2015-11-09 03:07:38', 'TITO-PC', 'root', 'class_categoria', 'INSERT'),
(94, '2015-11-09 03:09:37', 'TITO-PC', 'root', 'class_categoria', 'INSERT'),
(95, '2015-11-09 03:10:50', 'TITO-PC', 'root', 'class_categoria', 'UPDATE'),
(96, '2015-11-09 03:11:01', 'TITO-PC', 'root', 'class_categoria', 'DELETE'),
(97, '2015-11-09 03:11:28', 'TITO-PC', 'root', 'class_categoria', 'INSERT'),
(98, '2015-11-09 03:26:50', 'TITO-PC', 'root', 'class_autor', 'INSERT'),
(99, '2015-11-09 03:27:09', 'TITO-PC', 'root', 'class_autor', 'UPDATE'),
(100, '2015-11-09 03:29:45', 'TITO-PC', 'root', 'class_editorial', 'INSERT'),
(101, '2015-11-09 03:35:38', 'TITO-PC', 'root', 'class_libro', 'INSERT'),
(102, '2015-11-09 03:36:06', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(103, '2015-11-09 03:46:26', 'TITO-PC', 'root', 'class_autor', 'INSERT'),
(104, '2015-11-09 03:47:18', 'TITO-PC', 'root', 'class_editorial', 'INSERT'),
(105, '2015-11-09 03:48:16', 'TITO-PC', 'root', 'class_libro', 'INSERT'),
(106, '2015-11-09 03:51:07', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(107, '2015-11-09 08:24:36', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(108, '2015-11-09 08:28:19', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(109, '2015-11-09 08:49:34', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(110, '2015-11-09 08:49:35', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(111, '2015-11-09 08:49:35', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(112, '2015-11-10 00:45:12', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(113, '2015-11-10 00:45:48', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(114, '2015-11-10 00:50:04', 'TITO-PC', 'root', 'class_autor', 'INSERT'),
(115, '2015-11-10 00:51:33', 'TITO-PC', 'root', 'class_libro', 'INSERT'),
(116, '2015-11-10 00:55:29', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(117, '2015-11-10 00:55:29', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(118, '2015-11-10 00:57:19', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(119, '2015-11-10 00:57:19', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(120, '2015-11-13 01:01:01', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(121, '2015-11-13 01:01:01', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(122, '2015-11-11 01:06:44', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(123, '2015-11-11 01:07:41', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(124, '2015-11-11 01:28:58', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(125, '2015-11-11 01:29:02', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(126, '2015-11-11 01:29:06', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(127, '2015-11-11 01:29:55', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(128, '2015-11-11 01:29:55', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(129, '2015-11-11 01:29:55', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(130, '2015-11-11 01:30:33', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(131, '2015-11-11 01:30:33', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(132, '2015-11-11 01:30:33', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(133, '2015-11-11 01:40:35', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(134, '2015-11-11 01:41:49', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(135, '2015-11-11 01:46:39', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(136, '2015-11-11 01:46:40', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(137, '2015-11-11 01:50:46', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(138, '2015-11-11 01:50:46', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(139, '2015-11-11 01:50:46', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(140, '2015-11-12 03:41:07', 'TITO-PC', 'root', 'calendario', 'INSERT'),
(141, '2015-11-12 03:41:07', 'TITO-PC', 'root', 'calendario', 'INSERT'),
(142, '2015-11-13 15:59:09', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(143, '2015-11-13 15:59:14', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(144, '2015-11-14 04:14:18', 'TITO-PC', 'root', 'calendario', 'UPDATE'),
(145, '2015-11-14 04:15:00', 'TITO-PC', 'root', 'calendario', 'UPDATE'),
(146, '2015-11-14 05:54:19', 'TITO-PC', 'root', 'calendario', 'INSERT'),
(147, '2015-11-14 06:05:42', 'TITO-PC', 'root', 'calendario', 'UPDATE'),
(148, '2015-11-14 07:16:47', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(149, '2015-11-14 07:16:47', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(150, '2015-11-14 07:17:47', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(151, '2015-11-14 07:17:47', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(152, '2015-11-14 07:18:34', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(153, '2015-11-14 07:18:34', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(154, '2015-11-14 07:18:34', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(155, '2015-11-14 07:19:53', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(156, '2015-11-14 07:22:22', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(157, '2015-11-14 07:22:22', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(158, '2015-11-14 07:22:44', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(159, '2015-11-14 07:22:45', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(160, '2015-11-14 19:37:30', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(161, '2015-11-14 19:38:12', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(162, '2015-11-14 19:40:02', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(163, '2015-11-14 19:40:02', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(164, '2015-11-14 19:40:56', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(165, '2015-11-14 19:40:56', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(166, '2015-11-14 19:40:57', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(167, '2015-11-14 19:42:03', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(168, '2015-11-14 19:42:03', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(169, '2015-11-14 19:42:03', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(170, '2015-11-14 21:29:13', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(171, '2015-11-14 21:35:06', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(172, '2015-11-14 21:37:48', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(173, '2015-11-14 21:42:37', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(174, '2015-11-15 03:17:48', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(175, '2015-11-16 01:14:28', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(176, '2015-11-16 01:16:01', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(177, '2015-11-16 01:16:07', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(178, '2015-11-16 01:16:19', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(179, '2015-11-16 01:16:27', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(180, '2015-11-16 01:16:34', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(181, '2015-11-16 01:16:40', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(182, '2015-11-16 02:16:20', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(183, '2015-11-16 02:19:55', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(184, '2015-11-16 02:19:55', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(185, '2015-11-16 02:21:18', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(186, '2015-11-16 02:21:40', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(187, '2015-11-16 02:21:40', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(188, '2015-11-16 02:23:07', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(189, '2015-11-16 02:23:11', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(190, '2015-11-16 02:23:17', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(191, '2015-11-16 02:23:20', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(192, '2015-11-16 02:23:25', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(193, '2015-11-16 02:23:28', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(194, '2015-11-16 02:23:32', 'TITO-PC', 'root', 'class_devolucion', 'DELETE'),
(195, '2015-11-16 02:23:54', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(196, '2015-11-16 02:23:58', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(197, '2015-11-16 02:24:03', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(198, '2015-11-16 02:24:07', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(199, '2015-11-16 02:24:14', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(200, '2015-11-16 02:24:52', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(201, '2015-11-16 02:26:41', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(202, '2015-11-16 02:26:41', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(203, '2015-11-16 02:26:41', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(204, '2015-11-16 02:46:45', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(205, '2015-11-16 02:46:45', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(206, '2015-11-16 02:53:30', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(207, '2015-11-16 03:10:26', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(208, '2015-11-16 03:10:26', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(209, '2015-11-16 03:11:13', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(210, '2015-11-16 03:13:12', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(211, '2015-11-16 03:13:25', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(212, '2015-11-16 03:15:27', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(213, '2015-11-16 03:15:27', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(214, '2015-11-16 03:15:40', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(215, '2015-11-16 03:16:17', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(216, '2015-11-16 03:16:21', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(217, '2015-11-16 03:17:14', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(218, '2015-11-16 04:17:14', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(219, '2015-11-16 04:17:49', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(220, '2015-11-16 04:18:15', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(221, '2015-11-16 04:18:15', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(222, '2015-11-16 04:18:32', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(223, '2015-11-16 04:18:32', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(224, '2015-11-16 04:21:18', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(225, '2015-11-16 04:21:18', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(226, '2015-11-16 04:23:57', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(227, '2015-11-16 04:23:57', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(228, '2015-11-16 04:24:10', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(229, '2015-11-16 04:24:10', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(230, '2015-11-16 04:24:40', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(231, '2015-11-16 04:25:48', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(232, '2015-11-16 04:27:16', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(233, '2015-11-16 04:27:30', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(234, '2015-11-16 04:27:30', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(235, '2015-11-16 04:27:30', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(236, '2015-11-16 04:29:36', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(237, '2015-11-16 04:29:36', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(238, '2015-11-16 04:29:36', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(239, '2015-11-16 04:30:33', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(240, '2015-11-16 04:30:33', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(241, '2015-11-16 04:32:20', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(242, '2015-11-16 04:32:20', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(243, '2015-11-16 04:36:18', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(244, '2015-11-16 04:37:00', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(245, '2015-11-16 04:37:35', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(246, '2015-11-16 04:37:35', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(247, '2015-11-16 04:37:35', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(248, '2015-11-16 04:43:03', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(249, '2015-11-16 04:44:01', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(250, '2015-11-16 04:44:01', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(251, '2015-11-16 04:44:31', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(252, '2015-11-16 04:46:23', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(253, '2015-11-16 04:46:23', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(254, '2015-11-16 04:46:41', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(255, '2015-11-16 04:46:59', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(256, '2015-11-16 04:47:47', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(257, '2015-11-16 04:47:47', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(258, '2015-11-16 04:59:01', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(259, '2015-11-16 04:59:01', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(260, '2015-11-16 05:15:30', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(261, '2015-11-16 05:15:30', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(262, '2015-11-16 05:15:30', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(263, '2015-11-16 05:15:46', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(264, '2015-11-16 05:15:46', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(265, '2015-11-16 05:27:56', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(266, '2015-11-16 05:27:57', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(267, '2015-11-16 05:32:42', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(268, '2015-11-16 06:53:29', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(269, '2015-11-16 06:53:29', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(270, '2015-11-16 06:56:02', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(271, '2015-11-16 06:56:02', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(272, '2015-11-16 06:57:57', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(273, '2015-11-16 06:58:13', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(274, '2015-11-16 06:58:13', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(275, '2015-11-16 07:00:07', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(276, '2015-11-16 07:00:58', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(277, '2015-11-16 07:00:58', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(278, '2015-11-16 07:03:48', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(279, '2015-11-16 07:03:48', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(280, '2015-11-16 07:05:31', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(281, '2015-11-16 07:05:31', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(282, '2015-11-16 07:05:31', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(283, '2015-11-16 07:22:32', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(284, '2015-11-16 07:28:52', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(285, '2015-11-16 07:28:58', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(286, '2015-11-16 07:29:36', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(287, '2015-11-16 07:29:36', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(288, '2015-11-16 07:29:36', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(289, '2015-11-16 07:38:00', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(290, '2015-11-16 07:38:10', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(291, '2015-11-16 07:38:33', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(292, '2015-11-16 07:38:37', 'TITO-PC', 'root', 'class_prestamo', 'DELETE'),
(293, '2015-11-16 07:40:07', 'TITO-PC', 'root', 'class_reserva', 'DELETE'),
(294, '2015-11-16 07:40:07', 'TITO-PC', 'root', 'class_reserva', 'DELETE'),
(295, '2015-11-16 07:40:07', 'TITO-PC', 'root', 'class_reserva', 'DELETE'),
(296, '2015-11-16 07:40:07', 'TITO-PC', 'root', 'class_reserva', 'DELETE'),
(297, '2015-11-16 07:40:07', 'TITO-PC', 'root', 'class_reserva', 'DELETE'),
(298, '2015-11-16 07:40:07', 'TITO-PC', 'root', 'class_reserva', 'DELETE'),
(299, '2015-11-16 07:40:07', 'TITO-PC', 'root', 'class_reserva', 'DELETE'),
(300, '2015-11-16 07:40:22', 'TITO-PC', 'root', 'class_Estudiante', 'UPDATE'),
(301, '2015-11-16 22:35:03', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(302, '2015-11-16 23:34:40', 'TITO-PC', 'root', 'class_libro', 'INSERT'),
(303, '2015-11-16 23:35:08', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(304, '2015-11-16 23:38:20', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(305, '2015-11-16 23:38:20', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(306, '2015-11-16 23:40:42', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(307, '2015-11-16 23:40:42', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(308, '2015-11-16 23:40:43', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(309, '2015-11-16 23:40:43', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(310, '2015-11-16 23:41:29', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(311, '2015-11-16 23:41:29', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(312, '2015-11-16 23:42:31', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(313, '2015-11-16 23:42:31', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(314, '2015-11-16 23:42:31', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(315, '2015-11-16 23:43:17', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(316, '2015-11-16 23:43:17', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(317, '2015-11-16 23:43:50', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(318, '2015-11-16 23:43:50', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(319, '2015-11-16 23:43:50', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(320, '2015-11-16 23:46:06', 'TITO-PC', 'root', 'class_reserva', 'INSERT'),
(321, '2015-11-16 23:49:00', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(322, '2015-11-16 23:49:00', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(323, '2015-11-16 23:51:35', 'TITO-PC', 'root', 'calendario', 'UPDATE'),
(324, '2015-11-16 23:52:32', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(325, '2015-11-16 23:52:32', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(326, '2015-11-16 23:52:32', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(327, '2015-11-17 12:47:50', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(328, '2015-11-17 12:47:50', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(329, '2015-11-17 12:49:32', 'TITO-PC', 'root', 'class_devolucion', 'INSERT'),
(330, '2015-11-17 12:49:32', 'TITO-PC', 'root', 'class_prestamo', 'UPDATE'),
(331, '2015-11-17 12:49:33', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(332, '2015-11-17 12:51:17', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(333, '2015-11-24 16:22:30', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(334, '2016-03-17 00:30:43', 'TITO-PC', 'root', 'class_libro', 'UPDATE'),
(335, '2016-03-17 00:30:43', 'TITO-PC', 'root', 'class_prestamo', 'INSERT'),
(336, '2016-06-26 19:49:23', 'TITO-PC', 'root', 'class_libro', 'UPDATE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE IF NOT EXISTS `calendario` (
  `codCalendario` varchar(5) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`codCalendario`, `fecha`, `estado`, `descripcion`) VALUES
('1000', '2015-11-02', 'A', 'Dia de los Difuntos'),
('1001', '2015-11-17', 'A', 'Fecha de Prueba de sistema '),
('1002', '2015-11-19', 'A', 'Fecha de Presentacion');

--
-- Disparadores `calendario`
--
DELIMITER $$
CREATE TRIGGER `triggerCalendario_delete` AFTER DELETE ON `calendario`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'calendario','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerCalendario_insert` AFTER INSERT ON `calendario`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'calendario','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerCalendario_update` AFTER UPDATE ON `calendario`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'calendario','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_autor`
--

CREATE TABLE IF NOT EXISTS `class_autor` (
  `codAutor` int(11) NOT NULL,
  `nombreAutor` varchar(50) NOT NULL,
  `nacionalidadAutor` varchar(50) NOT NULL,
  `fechaNacimAutor` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_autor`
--

INSERT INTO `class_autor` (`codAutor`, `nombreAutor`, `nacionalidadAutor`, `fechaNacimAutor`) VALUES
(100, 'Ivar Hjalmar Jacobson', 'sueco', '1939-11-02'),
(101, 'LUIS JOYANES AGUILAR', 'I', '2015-11-23'),
(102, 'mario', 'A', '2015-11-21');

--
-- Disparadores `class_autor`
--
DELIMITER $$
CREATE TRIGGER `triggerAutor_delete` AFTER DELETE ON `class_autor`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_autor','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerAutor_insert` AFTER INSERT ON `class_autor`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_autor','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerAutor_update` AFTER UPDATE ON `class_autor`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_autor','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_bibliotecario`
--

CREATE TABLE IF NOT EXISTS `class_bibliotecario` (
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `turno` varchar(25) NOT NULL,
  `estado` char(1) NOT NULL,
  `codPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_bibliotecario`
--

INSERT INTO `class_bibliotecario` (`usuario`, `clave`, `turno`, `estado`, `codPersona`) VALUES
('tito_tfv@hotmail.com', '12345', '14:00 a 16:00 Hrs', 'A', 8064396);

--
-- Disparadores `class_bibliotecario`
--
DELIMITER $$
CREATE TRIGGER `triggerBibliotecario_delete` AFTER DELETE ON `class_bibliotecario`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_Bibliotecario','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerBibliotecario_insert` AFTER INSERT ON `class_bibliotecario`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_Bibliotecario','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerBibliotecario_update` AFTER UPDATE ON `class_bibliotecario`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_Bibliotecario','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_categoria`
--

CREATE TABLE IF NOT EXISTS `class_categoria` (
  `codCategoria` int(11) NOT NULL,
  `nombre_c` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion_c` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_categoria`
--

INSERT INTO `class_categoria` (`codCategoria`, `nombre_c`, `descripcion_c`, `estado`) VALUES
(11, 'IngenierÃ­a InformÃ¡tica', 'Carrera con ResoluciÃ³n 300/06', 'A'),
(21, 'Trabajo Social', 'Carrera con ResoluciÃ³n 300/06', 'A'),
(22, 'ComunicaciÃ³n Social', 'Carrera con ResoluciÃ³n 300/06', 'A'),
(32, 'TeologÃ­a', 'Carrera con ResoluciÃ³n 300/06', 'A');

--
-- Disparadores `class_categoria`
--
DELIMITER $$
CREATE TRIGGER `triggerCategoria_delete` AFTER DELETE ON `class_categoria`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_categoria','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerCategoria_insert` AFTER INSERT ON `class_categoria`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_categoria','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerCategoria_update` AFTER UPDATE ON `class_categoria`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_categoria','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_devolucion`
--

CREATE TABLE IF NOT EXISTS `class_devolucion` (
  `fechaDevolucion` date NOT NULL,
  `glosaDevolucion` varchar(100) NOT NULL,
  `codPrestamo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_devolucion`
--

INSERT INTO `class_devolucion` (`fechaDevolucion`, `glosaDevolucion`, `codPrestamo`) VALUES
('2015-11-16', 'Libro Perdido', 1000),
('2015-11-16', 'yoyi', 1001),
('2015-11-16', 'yoyi', 1002),
('2015-11-16', 'holis', 1003),
('2015-11-16', 'nose', 1006),
('2015-11-16', 'yoryina', 1007),
('2015-11-17', 'holoa', 1011),
('2015-11-16', 'hola', 1012),
('2015-11-17', 'nota', 1013),
('2015-11-17', 'nota', 1014),
('2015-11-17', 'nota', 1015),
('2015-11-17', 'devuelve satisfactoriamente en tiempo limite', 1016);

--
-- Disparadores `class_devolucion`
--
DELIMITER $$
CREATE TRIGGER `triggerDevolucion_delete` AFTER DELETE ON `class_devolucion`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_devolucion','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerDevolucion_insert` AFTER INSERT ON `class_devolucion`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_devolucion','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerDevolucion_update` AFTER UPDATE ON `class_devolucion`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_devolucion','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_editorial`
--

CREATE TABLE IF NOT EXISTS `class_editorial` (
  `codEditorial` int(11) NOT NULL,
  `nombreEditorial` varchar(60) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_editorial`
--

INSERT INTO `class_editorial` (`codEditorial`, `nombreEditorial`, `descripcion`) VALUES
(100, 'Prentice Hall', 'Prentice Hall es una editorial educativa important'),
(101, 'McGraw-Hill', 'Editorial de informatica');

--
-- Disparadores `class_editorial`
--
DELIMITER $$
CREATE TRIGGER `triggerEditorial_delete` AFTER DELETE ON `class_editorial`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_editorial','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerEditorial_insert` AFTER INSERT ON `class_editorial`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_editorial','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerEditorial_update` AFTER UPDATE ON `class_editorial`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_editorial','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_estudiante`
--

CREATE TABLE IF NOT EXISTS `class_estudiante` (
  `registro` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaCulminaion` date NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `codPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_estudiante`
--

INSERT INTO `class_estudiante` (`registro`, `fechaInicio`, `fechaCulminaion`, `estado`, `codPersona`) VALUES
(201211001, '2012-02-22', '2016-12-26', 'A', 39485493),
(201211002, '2015-10-14', '2015-10-06', 'A', 101),
(201211003, '2015-10-14', '2015-10-23', 'A', 102);

--
-- Disparadores `class_estudiante`
--
DELIMITER $$
CREATE TRIGGER `triggerEstudiante_delete` AFTER DELETE ON `class_estudiante`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_Estudiante','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerEstudiante_insert` AFTER INSERT ON `class_estudiante`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_Estudiante','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerEstudiante_update` AFTER UPDATE ON `class_estudiante`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_Estudiante','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_libro`
--

CREATE TABLE IF NOT EXISTS `class_libro` (
  `codLibro` varchar(30) NOT NULL,
  `nombreLibro` varchar(50) DEFAULT NULL,
  `numeroPag` int(11) NOT NULL,
  `ano_edicion` date NOT NULL,
  `num_ejemplares` int(11) DEFAULT NULL,
  `estado_libro` char(1) DEFAULT NULL,
  `codAutor` int(11) NOT NULL,
  `codEditorial` int(11) NOT NULL,
  `codCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_libro`
--

INSERT INTO `class_libro` (`codLibro`, `nombreLibro`, `numeroPag`, `ano_edicion`, `num_ejemplares`, `estado_libro`, `codAutor`, `codEditorial`, `codCategoria`) VALUES
('1000', 'El Lenguaje Unificado De Modelado UML 2Âº Edicion', 547, '1998-07-17', 11, 'A', 100, 100, 11),
('1001', 'Programacion En C /C++ Java Y Uml', 367, '1980-06-11', 7, 'A', 101, 101, 11),
('1002', 'Programacion mario', 454, '2004-06-16', 12, 'A', 102, 100, 11),
('1003', 'Android con Java', 500, '2015-11-16', 30, 'A', 102, 100, 11);

--
-- Disparadores `class_libro`
--
DELIMITER $$
CREATE TRIGGER `triggerLibro_delete` AFTER DELETE ON `class_libro`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_libro','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerLibro_insert` AFTER INSERT ON `class_libro`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_libro','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerLibro_update` AFTER UPDATE ON `class_libro`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_libro','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_multa`
--

CREATE TABLE IF NOT EXISTS `class_multa` (
  `descripcionMulta` varchar(100) CHARACTER SET utf8 NOT NULL,
  `precioMulta` float NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `codPrestamo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_multa`
--

INSERT INTO `class_multa` (`descripcionMulta`, `precioMulta`, `estado`, `codPrestamo`) VALUES
('nota', 10, 'I', 1013),
('nota', 10, 'I', 1014),
('nota', 10, 'I', 1015),
('nota', 56, 'A', 1003);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_persona`
--

CREATE TABLE IF NOT EXISTS `class_persona` (
  `codPersona` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `telefono` char(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `fechaNacim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_persona`
--

INSERT INTO `class_persona` (`codPersona`, `nombres`, `apellidos`, `sexo`, `telefono`, `email`, `fechaNacim`) VALUES
(101, 'Joselo', 'Abapinta Diego', 'M', '66337322', 'joselo@gmail.com', '2015-10-14'),
(102, 'Ricardo', 'Orias Galviz', 'M', '73332222', 'ricardo@hotmail.com', '2015-10-14'),
(8064396, 'Tito', 'Flores Vicente', 'M', '773-43476', 'tito_tfv@hotmail.com', '1994-02-22'),
(39485493, 'Juan Herlan', 'Flores Vicente', 'M', '765-67878', 'juan@gmil.com', '1992-10-10');

--
-- Disparadores `class_persona`
--
DELIMITER $$
CREATE TRIGGER `triggerPersona_delete` AFTER DELETE ON `class_persona`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_persona','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerPersona_insert` AFTER INSERT ON `class_persona`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_persona','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerPersona_update` AFTER UPDATE ON `class_persona`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_persona','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_prestamo`
--

CREATE TABLE IF NOT EXISTS `class_prestamo` (
  `codPrestamo` int(11) NOT NULL,
  `fechaSalida` date NOT NULL,
  `fechaDevolucion` date NOT NULL,
  `notaGlosa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `registro` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `codLibro` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_prestamo`
--

INSERT INTO `class_prestamo` (`codPrestamo`, `fechaSalida`, `fechaDevolucion`, `notaGlosa`, `estado`, `registro`, `usuario`, `codLibro`) VALUES
(1000, '2015-11-08', '2015-11-11', 'Este prestamo es Realizado para prueba', 'I', 201211001, 'tito_tfv@hotmail.com', '1000'),
(1001, '2015-11-10', '2015-11-13', 'Se presta amario', 'I', 201211001, 'tito_tfv@hotmail.com', '1002'),
(1002, '2015-11-10', '2015-11-13', 'lo que sea', 'I', 201211002, 'tito_tfv@hotmail.com', '1002'),
(1003, '2015-11-11', '2015-11-14', 'iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', 'I', 201211001, 'tito_tfv@hotmail.com', '1002'),
(1006, '2015-11-14', '2015-11-19', 'hola', 'I', 201211002, 'tito_tfv@hotmail.com', '1002'),
(1007, '2015-11-16', '2015-11-19', 'hola mundo', 'I', 201211001, 'tito_tfv@hotmail.com', '1000'),
(1009, '2015-11-16', '2015-11-19', 'hola', 'I', 201211003, 'tito_tfv@hotmail.com', '1000'),
(1011, '2015-11-16', '2015-11-19', 'oye', 'I', 201211003, 'tito_tfv@hotmail.com', '1000'),
(1012, '2015-11-16', '2015-11-19', 'hola chico', 'I', 201211003, 'tito_tfv@hotmail.com', '1000'),
(1013, '2015-11-16', '2015-11-19', 'nota', 'I', 201211002, 'tito_tfv@hotmail.com', '1003'),
(1014, '2015-11-16', '2015-11-19', 'nota', 'I', 201211002, 'tito_tfv@hotmail.com', '1003'),
(1015, '2015-11-16', '2015-11-19', 'nota', 'I', 201211002, 'tito_tfv@hotmail.com', '1003'),
(1016, '2015-11-17', '2015-11-18', 'hola\r\n', 'I', 201211003, 'tito_tfv@hotmail.com', '1000'),
(1017, '2016-03-16', '2016-03-23', '', 'A', 201211003, 'tito_tfv@hotmail.com', '1001');

--
-- Disparadores `class_prestamo`
--
DELIMITER $$
CREATE TRIGGER `triggerPrestamo_delete` AFTER DELETE ON `class_prestamo`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_prestamo','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerPrestamo_insert` AFTER INSERT ON `class_prestamo`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_prestamo','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerPrestamo_update` AFTER UPDATE ON `class_prestamo`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_prestamo','UPDATE');
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_reserva`
--

CREATE TABLE IF NOT EXISTS `class_reserva` (
  `codReserva` int(11) NOT NULL,
  `fechaReserva` date NOT NULL,
  `fechaLimite` date NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `codLibro` varchar(30) DEFAULT NULL,
  `registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `class_reserva`
--

INSERT INTO `class_reserva` (`codReserva`, `fechaReserva`, `fechaLimite`, `estado`, `codLibro`, `registro`) VALUES
(101, '2015-11-09', '2015-11-11', 'A', '1000', 201211001),
(102, '2015-11-09', '2015-11-11', 'A', '1001', 201211003),
(103, '2015-11-17', '2015-11-19', 'A', '1003', 201211001);

--
-- Disparadores `class_reserva`
--
DELIMITER $$
CREATE TRIGGER `triggerReserva_delete` AFTER DELETE ON `class_reserva`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_reserva','DELETE');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerReserva_insert` AFTER INSERT ON `class_reserva`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_reserva','INSERT');
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggerReserva_update` AFTER UPDATE ON `class_reserva`
 FOR EACH ROW BEGIN
	INSERT INTO 
				bitacora 
	VALUES(NULL,NULL,@@hostname,substring_index(user(),'@',1),'class_reserva','UPDATE');
  END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`codBitacora`);

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`codCalendario`);

--
-- Indices de la tabla `class_autor`
--
ALTER TABLE `class_autor`
  ADD PRIMARY KEY (`codAutor`);

--
-- Indices de la tabla `class_bibliotecario`
--
ALTER TABLE `class_bibliotecario`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `codPersona` (`codPersona`);

--
-- Indices de la tabla `class_categoria`
--
ALTER TABLE `class_categoria`
  ADD PRIMARY KEY (`codCategoria`);

--
-- Indices de la tabla `class_devolucion`
--
ALTER TABLE `class_devolucion`
  ADD PRIMARY KEY (`codPrestamo`);

--
-- Indices de la tabla `class_editorial`
--
ALTER TABLE `class_editorial`
  ADD PRIMARY KEY (`codEditorial`);

--
-- Indices de la tabla `class_estudiante`
--
ALTER TABLE `class_estudiante`
  ADD PRIMARY KEY (`registro`),
  ADD KEY `codPersona` (`codPersona`);

--
-- Indices de la tabla `class_libro`
--
ALTER TABLE `class_libro`
  ADD PRIMARY KEY (`codLibro`),
  ADD KEY `codAutor` (`codAutor`),
  ADD KEY `codEditorial` (`codEditorial`),
  ADD KEY `codCategoria` (`codCategoria`);

--
-- Indices de la tabla `class_multa`
--
ALTER TABLE `class_multa`
  ADD KEY `codPrestamo` (`codPrestamo`);

--
-- Indices de la tabla `class_persona`
--
ALTER TABLE `class_persona`
  ADD PRIMARY KEY (`codPersona`);

--
-- Indices de la tabla `class_prestamo`
--
ALTER TABLE `class_prestamo`
  ADD PRIMARY KEY (`codPrestamo`),
  ADD KEY `registro` (`registro`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `codLibro` (`codLibro`);

--
-- Indices de la tabla `class_reserva`
--
ALTER TABLE `class_reserva`
  ADD PRIMARY KEY (`codReserva`),
  ADD KEY `codLibro` (`codLibro`),
  ADD KEY `registro` (`registro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `codBitacora` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=337;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `class_bibliotecario`
--
ALTER TABLE `class_bibliotecario`
  ADD CONSTRAINT `class_bibliotecario_ibfk_1` FOREIGN KEY (`codPersona`) REFERENCES `class_persona` (`codPersona`);

--
-- Filtros para la tabla `class_devolucion`
--
ALTER TABLE `class_devolucion`
  ADD CONSTRAINT `class_devolucion_ibfk_1` FOREIGN KEY (`codPrestamo`) REFERENCES `class_prestamo` (`codPrestamo`);

--
-- Filtros para la tabla `class_estudiante`
--
ALTER TABLE `class_estudiante`
  ADD CONSTRAINT `class_estudiante_ibfk_1` FOREIGN KEY (`codPersona`) REFERENCES `class_persona` (`codPersona`);

--
-- Filtros para la tabla `class_libro`
--
ALTER TABLE `class_libro`
  ADD CONSTRAINT `class_libro_ibfk_1` FOREIGN KEY (`codAutor`) REFERENCES `class_autor` (`codAutor`),
  ADD CONSTRAINT `class_libro_ibfk_2` FOREIGN KEY (`codEditorial`) REFERENCES `class_editorial` (`codEditorial`),
  ADD CONSTRAINT `class_libro_ibfk_3` FOREIGN KEY (`codCategoria`) REFERENCES `class_categoria` (`codCategoria`);

--
-- Filtros para la tabla `class_multa`
--
ALTER TABLE `class_multa`
  ADD CONSTRAINT `class_multa_ibfk_1` FOREIGN KEY (`codPrestamo`) REFERENCES `class_prestamo` (`codPrestamo`);

--
-- Filtros para la tabla `class_prestamo`
--
ALTER TABLE `class_prestamo`
  ADD CONSTRAINT `class_prestamo_ibfk_1` FOREIGN KEY (`registro`) REFERENCES `class_estudiante` (`registro`),
  ADD CONSTRAINT `class_prestamo_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `class_bibliotecario` (`usuario`),
  ADD CONSTRAINT `class_prestamo_ibfk_3` FOREIGN KEY (`codLibro`) REFERENCES `class_libro` (`codLibro`);

--
-- Filtros para la tabla `class_reserva`
--
ALTER TABLE `class_reserva`
  ADD CONSTRAINT `class_reserva_ibfk_1` FOREIGN KEY (`codLibro`) REFERENCES `class_libro` (`codLibro`),
  ADD CONSTRAINT `class_reserva_ibfk_2` FOREIGN KEY (`registro`) REFERENCES `class_estudiante` (`registro`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
