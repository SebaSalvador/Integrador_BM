-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-06-2024 a las 06:45:36
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdprestamos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categoria`
--

CREATE DATABASE IF NOT EXISTS `bdprestamos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `bdprestamos`;

CREATE TABLE `tb_categoria` (
  `id_cat` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_categoria`
--

INSERT INTO `tb_categoria` (`id_cat`, `nombre`) VALUES
(10, 'Literarios y Linguisticos'),
(11, 'Cientificos'),
(12, 'Tecnicos'),
(13, 'Divulgativos'),
(14, 'Ilustrativos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estado`
--

CREATE TABLE `tb_estado` (
  `id_est` int(11) NOT NULL,
  `estado` varchar(32) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_estado`
--

INSERT INTO `tb_estado` (`id_est`, `estado`, `descripcion`) VALUES
(0, 'No disponible', 'El libro no esta disponible por diversos motivos, tales como: daños o esta desaparecido'),
(1, 'Disponible', 'El libro esta disponible para un nuevo prestamo'),
(2, 'Solicitado', 'El libro ha sido solicitado por un usuario y esta en espera de ser recogido'),
(3, 'Prestado', 'El libro ha sido prestado a un usuario'),
(4, 'Carro de estanteria', 'El libro ha sido entregado y esta en proceso de ser devuelto a la estanteria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_libro`
--

CREATE TABLE `tb_libro` (
  `id_lib` int(11) NOT NULL,
  `id_est` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `titulo` varchar(32) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `autor` varchar(64) NOT NULL,
  `fec_pub` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_libro`
--

INSERT INTO `tb_libro` (`id_lib`, `id_est`, `id_cat`, `titulo`, `descripcion`, `autor`, `fec_pub`) VALUES
(100, 1, 10, 'El principito', 'El Principito narra la historia de un niño príncipe que vive en un pequeño asteroide y que cae a la Tierra, donde conoce a un piloto varado en el desierto. Ambos entablan una conversación en clave poética donde hablan de filosofía, de crítica social, del amor, del honor y de mucho de lo que nos hace humanos.', 'Antoine de Saint Exupery', '1951-09-20'),
(101, 1, 11, 'Cosmos', 'Cosmos trata de la ciencia en su contexto humano más amplio y explica cómo la ciencia y la civilización se desarrollan conjuntamente. La obra aborda también el tema de las misiones espaciales destinadas a explorar los planetas más próximos a la Tierra, del origen de la vida, de la muerte del Sol, de la evolución de las galaxias y de los orígenes de la materia, los soles y los mundos, así como también los más recientes descubrimientos sobre la vida fuera de la Tierra.', 'Carl Sagan', '1981-01-01'),
(102, 1, 12, 'Code Complete (2 Edition)', 'Ampliamente considerada una de las mejores guías prácticas de programación, el CODE COMPLETE original de Steve McConnell ha ayudado a los desarrolladores a escribir mejor software durante más de una década. Ahora, este libro clásico ha sido completamente actualizado y revisado con prácticas de vanguardia y cientos de nuevos ejemplos de código que ilustran el arte y la ciencia de la construcción de software.', 'Steve McConnell', '2004-07-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_mensaje`
--

CREATE TABLE `tb_mensaje` (
  `id_men` int(11) NOT NULL,
  `id_per` int(11) NOT NULL,
  `asunto` varchar(32) NOT NULL,
  `detalle` text NOT NULL,
  `fec_env` date NOT NULL,
  `hor_env` varchar(16) NOT NULL,
  `estado` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_observacion`
--

CREATE TABLE `tb_observacion` (
  `id_lib` int(11) NOT NULL,
  `descripcion` varchar(32) NOT NULL,
  `fec_obs` date NOT NULL,
  `condicion` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_persona`
--

CREATE TABLE `tb_persona` (
  `id_per` int(11) NOT NULL,
  `nom_ape` varchar(64) NOT NULL,
  `edad` int(11) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `direccion` varchar(64) DEFAULT NULL,
  `telefono` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_persona`
--

INSERT INTO `tb_persona` (`id_per`, `nom_ape`, `edad`, `correo`, `direccion`, `telefono`) VALUES
(52336803, 'PAOLO GABRIEL RODRIGEZ PEREZ', 22, 'rodriguezpaolog@gmail.com', 'Masia Guadalupe 9 Puerta 234', '995200665'),
(53123564, 'MARIA ELENA ZAPATA SANCHEZ', 20, 'zapatamariae@gmail.com', 'Riera Rebeca 14', '995236708'),
(74588241, 'ERNESTO GARCIA MEDINA', 21, 'garciaernesto@hotmail.com', 'Vía Verónica 74', '902533687');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_prestamo`
--

CREATE TABLE `tb_prestamo` (
  `id_pre` int(11) NOT NULL,
  `id_per` int(11) NOT NULL,
  `id_lib` int(11) NOT NULL,
  `fec_pre` date NOT NULL,
  `hor_pre` varchar(16) NOT NULL,
  `fec_dev` date NOT NULL,
  `hor_dev` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_sancion`
--

CREATE TABLE `tb_sancion` (
  `id_san` int(11) NOT NULL,
  `id_per` int(11) NOT NULL,
  `dias_san` int(11) NOT NULL,
  `fec_ini` date NOT NULL,
  `razon` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipousuario`
--

CREATE TABLE `tb_tipousuario` (
  `id_tipo` int(11) NOT NULL,
  `rango` varchar(32) NOT NULL,
  `descripcion` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_tipousuario`
--

INSERT INTO `tb_tipousuario` (`id_tipo`, `rango`, `descripcion`) VALUES
(0, 'Cliente', 'Solo consultas de libros y registro de prestamos'),
(1, 'Empleado', 'Gestion de prestamos y consultas sin restriccion'),
(2, 'Administrador', 'Todos los permisos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id_per` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `estado` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_per`, `id_tipo`, `pass`, `estado`) VALUES
(52336803, 0, '123456', 'Activo'),
(53123564, 1, 'emp24*', 'Activo'),
(74588241, 0, 'abcdef', 'Activo'),
(75123456, 1, '123456', 'Activo');
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `tb_libro`
--
ALTER TABLE `tb_libro`
  ADD PRIMARY KEY (`id_lib`),
  ADD KEY `id_est` (`id_est`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indices de la tabla `tb_mensaje`
--
ALTER TABLE `tb_mensaje`
  ADD PRIMARY KEY (`id_men`),
  ADD KEY `id_per` (`id_per`);

--
-- Indices de la tabla `tb_observacion`
--
ALTER TABLE `tb_observacion`
  ADD PRIMARY KEY (`id_lib`);

--
-- Indices de la tabla `tb_persona`
--
ALTER TABLE `tb_persona`
  ADD PRIMARY KEY (`id_per`);

--
-- Indices de la tabla `tb_prestamo`
--
ALTER TABLE `tb_prestamo`
  ADD PRIMARY KEY (`id_pre`),
  ADD KEY `id_per` (`id_per`),
  ADD KEY `id_lib` (`id_lib`);

--
-- Indices de la tabla `tb_sancion`
--
ALTER TABLE `tb_sancion`
  ADD PRIMARY KEY (`id_san`),
  ADD KEY `id_per` (`id_per`);

--
-- Indices de la tabla `tb_tipousuario`
--
ALTER TABLE `tb_tipousuario`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_per`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_libro`
--
ALTER TABLE `tb_libro`
  ADD CONSTRAINT `tb_libro_ibfk_1` FOREIGN KEY (`id_est`) REFERENCES `tb_estado` (`id_est`),
  ADD CONSTRAINT `tb_libro_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `tb_categoria` (`id_cat`);

--
-- Filtros para la tabla `tb_mensaje`
--
ALTER TABLE `tb_mensaje`
  ADD CONSTRAINT `tb_mensaje_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `tb_persona` (`id_per`);

--
-- Filtros para la tabla `tb_observacion`
--
ALTER TABLE `tb_observacion`
  ADD CONSTRAINT `tb_observacion_ibfk_1` FOREIGN KEY (`id_lib`) REFERENCES `tb_libro` (`id_lib`);

--
-- Filtros para la tabla `tb_prestamo`
--
ALTER TABLE `tb_prestamo`
  ADD CONSTRAINT `tb_prestamo_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `tb_persona` (`id_per`),
  ADD CONSTRAINT `tb_prestamo_ibfk_2` FOREIGN KEY (`id_lib`) REFERENCES `tb_libro` (`id_lib`);

--
-- Filtros para la tabla `tb_sancion`
--
ALTER TABLE `tb_sancion`
  ADD CONSTRAINT `tb_sancion_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `tb_persona` (`id_per`);

--
-- Filtros para la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `tb_usuario_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `tb_persona` (`id_per`),
  ADD CONSTRAINT `tb_usuario_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tb_tipousuario` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
