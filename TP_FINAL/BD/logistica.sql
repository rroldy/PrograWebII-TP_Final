-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2015 a las 22:44:22
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `logistica`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `f_Service_x_km`(`in_kms` INT(20), `in_id_transporte` INT(20)) RETURNS varchar(50) CHARSET latin1
    READS SQL DATA
    DETERMINISTIC
begin declare v_kms_max int(20); declare v_id_Servicio int(10); declare v_cant_serv int; /*Que service le corresponde*/ select max(km) into v_kms_max from t_servicios s where s.km <= in_kms; select id_servicio into v_id_Servicio from t_servicios where km = v_kms_max; /*Verificar si lo tiene hecho*/ select count(id_servreal) into v_cant_Serv from t_servrealizados where id_transporte = in_id_transporte and id_servicio = v_id_Servicio; RETURN v_cant_Serv; end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_acoplado`
--

CREATE TABLE IF NOT EXISTS `t_acoplado` (
  `nro_chasis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_acoplado`
--

INSERT INTO `t_acoplado` (`nro_chasis`) VALUES
('NNB10000008P'),
('NNB20000009P'),
('WDB00000006P'),
('WDB00000007P'),
('WDB00000008P'),
('WDB00000009P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_chofer`
--

CREATE TABLE IF NOT EXISTS `t_chofer` (
  `legajo` int(11) NOT NULL,
  `tipo_licencia` int(11) NOT NULL,
  `numero_licencia` int(11) NOT NULL,
  `disponible` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_chofer`
--

INSERT INTO `t_chofer` (`legajo`, `tipo_licencia`, `numero_licencia`, `disponible`) VALUES
(10003, 1, 78777, 0),
(10004, 1, 72277, 0),
(10005, 2, 78177, 0),
(10006, 3, 78007, 0),
(10010, 3, 78997, 1),
(10011, 3, 7297, 1),
(121321312, 2, 1515, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_chofer_viaje`
--

CREATE TABLE IF NOT EXISTS `t_chofer_viaje` (
  `cod_viaje` varchar(50) NOT NULL,
  `legajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_chofer_viaje`
--

INSERT INTO `t_chofer_viaje` (`cod_viaje`, `legajo`) VALUES
('100', 10003),
('100', 10004),
('101', 10005),
('102', 10006),
('9999', 10006);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_empleado`
--

CREATE TABLE IF NOT EXISTS `t_empleado` (
  `id_empleado` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `legajo` int(11) NOT NULL,
  `tipo_doc` varchar(50) NOT NULL,
  `nro_doc` int(15) NOT NULL,
  `cuil` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `codigo_postal` int(11) DEFAULT NULL,
  `id_rol` int(2) NOT NULL,
  `password` varchar(20) NOT NULL,
  `visible` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_empleado`
--

INSERT INTO `t_empleado` (`id_empleado`, `usuario`, `legajo`, `tipo_doc`, `nro_doc`, `cuil`, `nombre`, `apellido`, `fecha_nac`, `direccion`, `localidad`, `provincia`, `pais`, `codigo_postal`, `id_rol`, `password`, `visible`) VALUES
(1, 'rdario', 10000, 'DNI', 1234567, '12-12-12', 'Ruben', 'Dario', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 1, '1234567', 1),
(2, 'jramon', 10001, 'DNI', 1234227, '14-14-14', 'Juan', 'Ramon', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 2, '1234567', 1),
(3, 'jporcel', 10002, 'DNI', 1234117, '15-15-15', 'Jorge', 'Porcel', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 2, '1234567', 1),
(4, 'rportales', 10003, 'DNI', 1235557, '16-16-16', 'Raul', 'Portales', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 3, '1234567', 1),
(5, 'mviale', 10004, 'DNI', 1221267, '34-34-34', 'Mauro', 'Viale', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 3, '1234567', 1),
(6, 'tristan', 10005, 'DNI', 1221267, '43-43-43', 'Tristan', 'Tristan', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 3, '1234567', 1),
(7, 'aolmedo', 10006, 'DNI', 1221267, '34524', 'Alberto', 'Olmedo', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 3, '1234567', 1),
(8, 'bleuman', 10007, 'DNI', 1221267, '564', 'Bergara', 'Leuman', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1717, 4, '1234567', 1),
(9, 'rgiordano', 10008, 'DNI', 1221267, '767', 'Reboerto', 'Giordano', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 4, '1234567', 1),
(10, 'mromano', 10009, 'DNI', 1221267, '234324', 'Miguel', 'Romano', '1990-01-01', 'Casacuberta 520', 'Castelar', 'Buenos Aires', 'Argentina', 1712, 4, '1234567', 1),
(11, 'pwalker', 10010, 'DNI', 1122127, '43-432-41', 'Paul', 'Walker', '1975-05-14', 'Park Avenue 5120', 'Manhatan', 'New York', 'EE.UU.', 112, 3, '1234567', 1),
(12, 'dtoretto', 10011, 'DNI', 4212671, '124-524-0', 'Dominic', 'Toretto', '0000-00-00', 'Washintong 21220', 'Florida', 'Utah', 'EE.UU.', 71, 3, '1234567', 1),
(13, 'Dangelicci', 121321312, 'DNI', 2147483647, '123123', 'Daniel', 'Angelicci', '1950-01-01', 'fasfasasff', 'jkjbkjbk', 'hufuyfu', 'kjbjkb', 5656, 3, '1234567', 0),
(14, 'fafafa', 120102021, 'DNI', 12121212, 'zdfzxc21321', 'DADA', 'HDHD', '1990-08-08', 'xacxczxc 34qwer', 'sadfsda', 'kjbkjb', 'jbkjbkj', 51515, 4, '23erwersdfsd', 0),
(15, 'fhahsfahfash', 2147483647, 'DNI', 20013912, '1232133132', 'dsafdfdsaasdf', 'dcfdfssadfdsa', '1995-01-01', 'xzcxzcc 123', 'xfdsf', 'jdjd', 'bdbd', 128218, 1, '1234567', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_mecanico`
--

CREATE TABLE IF NOT EXISTS `t_mecanico` (
  `legajo` int(11) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `disponible` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_mecanico`
--

INSERT INTO `t_mecanico` (`legajo`, `matricula`, `disponible`) VALUES
(10007, '2277', 1),
(10008, '777123', 0),
(10009, '77441', 1),
(120102021, '12312312', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_posicion`
--

CREATE TABLE IF NOT EXISTS `t_posicion` (
  `id_posicion` int(11) NOT NULL,
  `cod_qr` varchar(50) NOT NULL,
  `cod_viaje` varchar(50) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `cant_combustible` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `kms_recorridos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_posicion`
--

INSERT INTO `t_posicion` (`id_posicion`, `cod_qr`, `cod_viaje`, `lugar`, `cant_combustible`, `importe`, `kms_recorridos`, `fecha`, `lat`, `lng`) VALUES
(1, 'AAAA', '100', 'Santa Fe', 10, 150, 80, '2015-09-30 00:00:00', -31.610229, -60.697334),
(2, 'AAAB', '100', 'Villa Maria', 8, 140, 100, '2015-09-30 00:00:00', -32.411659, -63.241627),
(3, 'AAAC', '100', 'Carlos Paz', 5, 90, 70, '2015-09-30 00:00:00', -31.425085, -64.500427);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_reparacion`
--

CREATE TABLE IF NOT EXISTS `t_reparacion` (
  `id_reparacion` int(11) NOT NULL,
  `cod_reparacion` varchar(50) NOT NULL,
  `nro_chasis` varchar(50) NOT NULL,
  `legajo` int(11) NOT NULL,
  `id_tipo_repuesto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `costo` int(11) NOT NULL,
  `km_unidad` int(11) NOT NULL,
  `repuesto` varchar(100) DEFAULT NULL,
  `finalizada` int(1) NOT NULL,
  `visible` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_reparacion`
--

INSERT INTO `t_reparacion` (`id_reparacion`, `cod_reparacion`, `nro_chasis`, `legajo`, `id_tipo_repuesto`, `fecha`, `costo`, `km_unidad`, `repuesto`, `finalizada`, `visible`) VALUES
(1, '100', 'WDB00000001P', 10007, 1, '2015-09-30', 1500, 15000, 'Biela uhuh1221', 0, 1),
(2, '101', 'WDB00000008P', 10007, 1, '2014-09-30', 23000, 50000, 'Cubiertas', 0, 1),
(3, '123', 'WGD90000032P', 10008, 2, '2015-04-30', 100, 1000, 'optica derecha', 0, 1),
(4, '666', 'WDB00000006P', 10007, 1, '2015-11-21', 5000, 16000, 'motor y bujias', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_rol`
--

CREATE TABLE IF NOT EXISTS `t_rol` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_rol`
--

INSERT INTO `t_rol` (`id_rol`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Chofer'),
(4, 'Mecanico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_servicios`
--

CREATE TABLE IF NOT EXISTS `t_servicios` (
  `id_servicio` int(10) NOT NULL,
  `km` int(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_servicios`
--

INSERT INTO `t_servicios` (`id_servicio`, `km`, `descripcion`, `activo`) VALUES
(1, 15000, 'Reemplazar el aceite de motor y revision 15.000 km  ', 0),
(2, 30000, 'Reemplazar el aceite de motor y revision 30.000 km', 0),
(3, 45000, 'Reemplazar el aceite de motor y revision 45.000 km', 0),
(4, 60000, 'Reemplazar el aceite de motor y revision 60.000 km', 0),
(5, 0, 'Service inicial de Entrega', 0),
(6, 75000, 'Reemplazar el aceite de motor y revision 75.000 km  ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_servrealizados`
--

CREATE TABLE IF NOT EXISTS `t_servrealizados` (
  `id_servreal` int(10) NOT NULL,
  `id_transporte` int(11) NOT NULL,
  `id_servicio` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_servrealizados`
--

INSERT INTO `t_servrealizados` (`id_servreal`, `id_transporte`, `id_servicio`) VALUES
(3, 1, 5),
(4, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_licencia`
--

CREATE TABLE IF NOT EXISTS `t_tipo_licencia` (
  `id_tipo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_tipo_licencia`
--

INSERT INTO `t_tipo_licencia` (`id_tipo`, `descripcion`) VALUES
(1, 'C - Camion sin acoplado ni semiacoplado'),
(2, 'E.1 - Camiones articulados, con acoplado o semiaco'),
(3, 'E.2 - Maquinaria especial no agrícola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_repuesto`
--

CREATE TABLE IF NOT EXISTS `t_tipo_repuesto` (
  `id_tipo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_tipo_repuesto`
--

INSERT INTO `t_tipo_repuesto` (`id_tipo`, `descripcion`) VALUES
(1, 'interno'),
(2, 'externo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_transporte`
--

CREATE TABLE IF NOT EXISTS `t_tipo_transporte` (
  `id_tipo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_tipo_transporte`
--

INSERT INTO `t_tipo_transporte` (`id_tipo`, `descripcion`) VALUES
(1, 'vehiculo'),
(2, 'acoplado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_transporte`
--

CREATE TABLE IF NOT EXISTS `t_transporte` (
  `id_transporte` int(11) NOT NULL,
  `nro_chasis` varchar(50) NOT NULL,
  `patente` varchar(50) NOT NULL,
  `id_tipo` int(2) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `fecha_fabricacion` date NOT NULL,
  `visible` int(1) NOT NULL,
  `disponible` int(1) NOT NULL,
  `reparacion` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_transporte`
--

INSERT INTO `t_transporte` (`id_transporte`, `nro_chasis`, `patente`, `id_tipo`, `marca`, `modelo`, `fecha_fabricacion`, `visible`, `disponible`, `reparacion`) VALUES
(1, 'WDB00000001P', 'OMG454', 1, 'Mercedes Benz', 'FPN', '2015-01-01', 1, 0, 0),
(2, 'WDB00000002P', 'OOG414', 1, 'Scania', 'R470', '2010-01-01', 1, 0, 0),
(3, 'WDB00000003P', 'AAA114', 1, 'Mercedes Benz', 'Zetros', '2014-01-01', 1, 0, 0),
(4, 'WDB00000004P', 'BBB454', 1, 'Honda', 'Civic', '2009-01-01', 1, 0, 0),
(5, 'WDB00000005P', 'CCC454', 1, 'Iveco', 'Cursor', '2007-01-01', 1, 1, 0),
(6, 'WDB00000006P', '101CCC454', 2, 'Sola Y Brusa', 'Cerealero', '2008-01-01', 1, 0, 1),
(7, 'WDB00000007P', '101OMG454', 2, 'Sola Y Brusa', 'Termico', '2005-01-01', 1, 0, 0),
(8, 'WDB00000008P', '101OOG454', 2, 'Sola Y Brusa', 'Porta-Contenedor', '2009-01-01', 1, 0, 0),
(9, 'WDB00000009P', '101AAA454', 2, 'Sola Y Brusa', 'Cerealero', '2011-01-01', 1, 0, 0),
(10, 'WDB00555001P', 'BUC246', 1, 'Iveco', 'Cursor', '2010-10-01', 1, 1, 0),
(11, 'WGD90000032P', 'XYZ666', 1, 'Scania', 'Todo Terreno', '2015-01-11', 1, 1, 1),
(12, 'NNB10000008P', 'OOG444', 2, 'Sola Y Brusa', 'Aduanero', '2014-12-01', 1, 1, 0),
(13, 'NNB20000009P', 'AAA234', 2, 'Sola Y Brusa', 'Caudales', '2013-04-04', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_vehiculo`
--

CREATE TABLE IF NOT EXISTS `t_vehiculo` (
  `nro_chasis` varchar(50) NOT NULL,
  `nro_motor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_vehiculo`
--

INSERT INTO `t_vehiculo` (`nro_chasis`, `nro_motor`) VALUES
('WDB00000005P', 'B18C2014658'),
('WDB00000004P', 'B18C2014659'),
('WDB00000003P', 'B18C2014660'),
('WDB00000002P', 'B18C2014661'),
('WDB00000001P', 'B18C2014662'),
('WDB00555001P', 'B18C2777758'),
('WGD90000032P', 'B18C7878778');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_viaje`
--

CREATE TABLE IF NOT EXISTS `t_viaje` (
  `id_viaje` int(11) NOT NULL,
  `cod_viaje` varchar(50) NOT NULL,
  `tipo_carga` varchar(50) NOT NULL,
  `origen` varchar(50) NOT NULL,
  `destino` varchar(50) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `tipo_viaje` varchar(50) NOT NULL,
  `finalizado` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_viaje`
--

INSERT INTO `t_viaje` (`id_viaje`, `cod_viaje`, `tipo_carga`, `origen`, `destino`, `cliente`, `tipo_viaje`, `finalizado`) VALUES
(1, '100', 'cereal', 'Santa Fe', 'Cordoba', 'Sancor', 'comercial1', 0),
(2, '101', 'cereal', 'Santa Fe', 'Cordoba', 'Sancor', 'comercial', 0),
(3, '102', 'cereal', 'Buenos Aires', 'La Pampa', 'Don Corleone', 'particular', 0),
(4, '103', 'cereal', 'Buenos Aires', 'La Pampa', 'Don Corleone', 'particular', 0),
(5, '9999', 'Alimento', 'BS AS', 'Tierra del Fuego', 'Darano Facundo', 'Comercial', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_viaje_transporte`
--

CREATE TABLE IF NOT EXISTS `t_viaje_transporte` (
  `cod_viaje` varchar(50) NOT NULL,
  `nro_chasis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_viaje_transporte`
--

INSERT INTO `t_viaje_transporte` (`cod_viaje`, `nro_chasis`) VALUES
('100', 'WDB00000001P'),
('101', 'WDB00000002P'),
('9999', 'WDB00000002P'),
('102', 'WDB00000003P'),
('103', 'WDB00000004P'),
('100', 'WDB00000006P'),
('101', 'WDB00000007P'),
('102', 'WDB00000008P'),
('9999', 'WDB00000008P'),
('103', 'WDB00000009P');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_transportes_km`
--
CREATE TABLE IF NOT EXISTS `v_transportes_km` (
`id_transporte` int(11)
,`kms` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_transportes_km`
--
DROP TABLE IF EXISTS `v_transportes_km`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transportes_km` AS select `tr`.`id_transporte` AS `id_transporte`,sum(`po`.`kms_recorridos`) AS `kms` from ((`t_transporte` `tr` join `t_viaje_transporte` `via` on((`via`.`nro_chasis` = `tr`.`nro_chasis`))) join `t_posicion` `po` on((`po`.`cod_viaje` = `via`.`cod_viaje`))) where (`tr`.`id_tipo` = 1) group by `tr`.`id_transporte`;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_acoplado`
--
ALTER TABLE `t_acoplado`
  ADD PRIMARY KEY (`nro_chasis`);

--
-- Indices de la tabla `t_chofer`
--
ALTER TABLE `t_chofer`
  ADD PRIMARY KEY (`legajo`),
  ADD KEY `fk_chofer_tipo_licencia` (`tipo_licencia`);

--
-- Indices de la tabla `t_chofer_viaje`
--
ALTER TABLE `t_chofer_viaje`
  ADD PRIMARY KEY (`cod_viaje`,`legajo`),
  ADD KEY `fk_chofer_viaje_legajo` (`legajo`);

--
-- Indices de la tabla `t_empleado`
--
ALTER TABLE `t_empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `legajo` (`legajo`),
  ADD KEY `fk_rol` (`id_rol`);

--
-- Indices de la tabla `t_mecanico`
--
ALTER TABLE `t_mecanico`
  ADD PRIMARY KEY (`legajo`);

--
-- Indices de la tabla `t_posicion`
--
ALTER TABLE `t_posicion`
  ADD PRIMARY KEY (`id_posicion`),
  ADD UNIQUE KEY `cod_qr` (`cod_qr`),
  ADD KEY `fk_posicion_cod_viaje` (`cod_viaje`);

--
-- Indices de la tabla `t_reparacion`
--
ALTER TABLE `t_reparacion`
  ADD PRIMARY KEY (`id_reparacion`),
  ADD UNIQUE KEY `cod_reparacion` (`cod_reparacion`),
  ADD KEY `fk_reparacion_nro_chasis` (`nro_chasis`),
  ADD KEY `fk_reparacion_legajo` (`legajo`),
  ADD KEY `fk_reparacion_tipo_repuesto` (`id_tipo_repuesto`);

--
-- Indices de la tabla `t_rol`
--
ALTER TABLE `t_rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `t_servicios`
--
ALTER TABLE `t_servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `t_servrealizados`
--
ALTER TABLE `t_servrealizados`
  ADD PRIMARY KEY (`id_servreal`);

--
-- Indices de la tabla `t_tipo_licencia`
--
ALTER TABLE `t_tipo_licencia`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `t_tipo_repuesto`
--
ALTER TABLE `t_tipo_repuesto`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `t_tipo_transporte`
--
ALTER TABLE `t_tipo_transporte`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `t_transporte`
--
ALTER TABLE `t_transporte`
  ADD PRIMARY KEY (`id_transporte`),
  ADD UNIQUE KEY `nro_chasis` (`nro_chasis`),
  ADD UNIQUE KEY `patente` (`patente`),
  ADD KEY `fk_tipo` (`id_tipo`);

--
-- Indices de la tabla `t_vehiculo`
--
ALTER TABLE `t_vehiculo`
  ADD PRIMARY KEY (`nro_chasis`),
  ADD UNIQUE KEY `nro_motor` (`nro_motor`);

--
-- Indices de la tabla `t_viaje`
--
ALTER TABLE `t_viaje`
  ADD PRIMARY KEY (`id_viaje`),
  ADD UNIQUE KEY `cod_viaje` (`cod_viaje`);

--
-- Indices de la tabla `t_viaje_transporte`
--
ALTER TABLE `t_viaje_transporte`
  ADD PRIMARY KEY (`cod_viaje`,`nro_chasis`),
  ADD KEY `fk_nro_chasis_transporte` (`nro_chasis`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_empleado`
--
ALTER TABLE `t_empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `t_posicion`
--
ALTER TABLE `t_posicion`
  MODIFY `id_posicion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_reparacion`
--
ALTER TABLE `t_reparacion`
  MODIFY `id_reparacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `t_servicios`
--
ALTER TABLE `t_servicios`
  MODIFY `id_servicio` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `t_servrealizados`
--
ALTER TABLE `t_servrealizados`
  MODIFY `id_servreal` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `t_transporte`
--
ALTER TABLE `t_transporte`
  MODIFY `id_transporte` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `t_viaje`
--
ALTER TABLE `t_viaje`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_acoplado`
--
ALTER TABLE `t_acoplado`
  ADD CONSTRAINT `fk_acoplado_nro_chasis` FOREIGN KEY (`nro_chasis`) REFERENCES `t_transporte` (`nro_chasis`);

--
-- Filtros para la tabla `t_chofer`
--
ALTER TABLE `t_chofer`
  ADD CONSTRAINT `fk_chofer_legajo` FOREIGN KEY (`legajo`) REFERENCES `t_empleado` (`legajo`),
  ADD CONSTRAINT `fk_chofer_tipo_licencia` FOREIGN KEY (`tipo_licencia`) REFERENCES `t_tipo_licencia` (`id_tipo`);

--
-- Filtros para la tabla `t_chofer_viaje`
--
ALTER TABLE `t_chofer_viaje`
  ADD CONSTRAINT `fk_chofer_viaje_cod_viaje` FOREIGN KEY (`cod_viaje`) REFERENCES `t_viaje` (`cod_viaje`),
  ADD CONSTRAINT `fk_chofer_viaje_legajo` FOREIGN KEY (`legajo`) REFERENCES `t_chofer` (`legajo`);

--
-- Filtros para la tabla `t_empleado`
--
ALTER TABLE `t_empleado`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `t_rol` (`id_rol`);

--
-- Filtros para la tabla `t_mecanico`
--
ALTER TABLE `t_mecanico`
  ADD CONSTRAINT `fk_mecanico_legajo` FOREIGN KEY (`legajo`) REFERENCES `t_empleado` (`legajo`);

--
-- Filtros para la tabla `t_posicion`
--
ALTER TABLE `t_posicion`
  ADD CONSTRAINT `fk_posicion_cod_viaje` FOREIGN KEY (`cod_viaje`) REFERENCES `t_viaje` (`cod_viaje`);

--
-- Filtros para la tabla `t_reparacion`
--
ALTER TABLE `t_reparacion`
  ADD CONSTRAINT `fk_reparacion_legajo` FOREIGN KEY (`legajo`) REFERENCES `t_mecanico` (`legajo`),
  ADD CONSTRAINT `fk_reparacion_nro_chasis` FOREIGN KEY (`nro_chasis`) REFERENCES `t_transporte` (`nro_chasis`),
  ADD CONSTRAINT `fk_reparacion_tipo_repuesto` FOREIGN KEY (`id_tipo_repuesto`) REFERENCES `t_tipo_repuesto` (`id_tipo`);

--
-- Filtros para la tabla `t_transporte`
--
ALTER TABLE `t_transporte`
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `t_tipo_transporte` (`id_tipo`);

--
-- Filtros para la tabla `t_vehiculo`
--
ALTER TABLE `t_vehiculo`
  ADD CONSTRAINT `fk_vehiculo_nro_chasis` FOREIGN KEY (`nro_chasis`) REFERENCES `t_transporte` (`nro_chasis`);

--
-- Filtros para la tabla `t_viaje_transporte`
--
ALTER TABLE `t_viaje_transporte`
  ADD CONSTRAINT `fk_cod_viaje_viaje` FOREIGN KEY (`cod_viaje`) REFERENCES `t_viaje` (`cod_viaje`),
  ADD CONSTRAINT `fk_nro_chasis_transporte` FOREIGN KEY (`nro_chasis`) REFERENCES `t_transporte` (`nro_chasis`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
