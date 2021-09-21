-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-09-2021 a las 06:12:22
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
                            `id` int(11) NOT NULL,
                            `nombre` varchar(45) NOT NULL,
                            `apellido` varchar(45) NOT NULL,
                            `tipo_documento` enum('CC','Tarjeta','Pasaporte') NOT NULL,
                            `numero_documento` bigint(20) NOT NULL,
                            `celular` bigint(20) NOT NULL,
                            `direccion` varchar(45) DEFAULT NULL,
                            `ciudad` varchar(45) DEFAULT NULL,
                            `fecha` datetime(6) NOT NULL,
                            `hora` datetime(6) NOT NULL,
                            `gastos_labanderia` bigint(10) DEFAULT NULL,
                            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                            `habitaciones_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE `dia` (
                       `id` int(11) NOT NULL,
                       `nombre_ingreso` varchar(45) NOT NULL,
                       `volor` bigint(20) NOT NULL,
                       `fecha` datetime(4) NOT NULL,
                       `ingresos_id` int(11) NOT NULL,
                       `Mes_id` int(11) NOT NULL,
                       `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
                             `id` int(11) NOT NULL,
                             `nombre` varchar(45) DEFAULT NULL,
                             `apellido` varchar(45) DEFAULT NULL,
                             `cargo` varchar(45) DEFAULT NULL,
                             `tipo_documento` enum('CC','Tarjeta','Pasaporte') DEFAULT NULL,
                             `documento` bigint(20) DEFAULT NULL,
                             `turno` enum('Dia','Tarde','Noche') NOT NULL,
                             `Salario` bigint(20) NOT NULL,
                             `celular` bigint(20) DEFAULT NULL,
                             `direccion` varchar(45) DEFAULT NULL,
                             `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                             `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
                          `id` int(11) NOT NULL,
                          `Nombre_gasto` varchar(45) NOT NULL,
                          `Valor` bigint(20) NOT NULL,
                          `Fecha` datetime(6) NOT NULL,
                          `inventario_idproducto` int(11) NOT NULL,
                          `dia_id` int(11) NOT NULL,
                          `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
                                `id` int(10) UNSIGNED NOT NULL,
                                `numero_habitacion` bigint(5) UNSIGNED NOT NULL,
                                `cantidad_personas` bigint(5) NOT NULL,
                                `precio` bigint(20) NOT NULL,
                                `Dia_ingresos_idingresos` int(11) NOT NULL,
                                `Estado` enum('','Caselado','No canselado') NOT NULL,
                                `inventario_idproducto` int(11) NOT NULL,
                                `ingresos_idingresos` int(11) NOT NULL,
                                `dia_id` int(11) NOT NULL,
                                `dia_id1` int(11) NOT NULL,
                                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
                            `id` int(11) NOT NULL,
                            `nombre_ingreso` varchar(45) DEFAULT NULL,
                            `volor` bigint(20) NOT NULL,
                            `fecha` datetime(4) NOT NULL,
                            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            `inventario_id` int(11) NOT NULL,
                            `dia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
                              `id` int(11) NOT NULL,
                              `Dia_ingresos_idingresos` int(11) NOT NULL,
                              `dia_id` int(11) NOT NULL,
                              `Mes_id` int(11) NOT NULL,
                              `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                              `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limpiesa`
--

CREATE TABLE `limpiesa` (
                            `id` int(11) NOT NULL,
                            `nuemro_habitacion` bigint(5) NOT NULL,
                            `fecha` datetime(6) NOT NULL,
                            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                            `empleados_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mes`
--

CREATE TABLE `mes` (
                       `id` int(11) NOT NULL,
                       `enero` varchar(45) DEFAULT NULL,
                       `febrero` varchar(45) DEFAULT NULL,
                       `marzo` varchar(45) DEFAULT NULL,
                       `abril` varchar(45) DEFAULT NULL,
                       `mayo` varchar(45) DEFAULT NULL,
                       `junio` varchar(45) DEFAULT NULL,
                       `agosto` varchar(45) DEFAULT NULL,
                       `septiebre` varchar(45) DEFAULT NULL,
                       `octubre` varchar(45) DEFAULT NULL,
                       `noviembre` varchar(45) DEFAULT NULL,
                       `diciembre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
                             `id` int(11) NOT NULL,
                             `nombre_producto` varchar(45) NOT NULL,
                             `cantidad` int(11) NOT NULL,
                             `precio` bigint(20) NOT NULL,
                             `fecha` datetime(6) NOT NULL,
                             `precio_venta` bigint(20) NOT NULL,
                             `inventario_idproducto` int(11) NOT NULL,
                             `ventas_idventas` int(11) NOT NULL,
                             `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                             `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
                          `id` int(11) NOT NULL,
                          `nombre_producto` varchar(45) NOT NULL,
                          `precio` bigint(20) NOT NULL,
                          `fecha` datetime(6) NOT NULL,
                          `cantidad` bigint(20) NOT NULL,
                          `Dia_ingresos_idingresos` int(11) NOT NULL,
                          `dia_id` int(11) NOT NULL,
                          `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientes_habitaciones1_idx` (`habitaciones_id`);

--
-- Indices de la tabla `dia`
--
ALTER TABLE `dia`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dia_ingresos1_idx` (`ingresos_id`),
  ADD KEY `fk_dia_Mes1_idx` (`Mes_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gastos_inventario1_idx` (`inventario_idproducto`),
  ADD KEY `fk_gastos_dia1_idx` (`dia_id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_habitaciones_inventario1_idx` (`inventario_idproducto`),
  ADD KEY `fk_habitaciones_dia1_idx` (`dia_id1`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ingresos_inventario1_idx` (`inventario_id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventario_Mes1_idx` (`Mes_id`);

--
-- Indices de la tabla `limpiesa`
--
ALTER TABLE `limpiesa`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_limpiesa_empleados1_idx` (`empleados_id`);

--
-- Indices de la tabla `mes`
--
ALTER TABLE `mes`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_inventario1_idx` (`inventario_idproducto`),
  ADD KEY `fk_productos_ventas1_idx` (`ventas_idventas`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
    ADD PRIMARY KEY (`id`,`Dia_ingresos_idingresos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dia`
--
ALTER TABLE `dia`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mes`
--
ALTER TABLE `mes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
    ADD CONSTRAINT `fk_clientes_habitaciones1` FOREIGN KEY (`habitaciones_id`) REFERENCES `habitaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dia`
--
ALTER TABLE `dia`
    ADD CONSTRAINT `fk_dia_Mes1` FOREIGN KEY (`Mes_id`) REFERENCES `mes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dia_ingresos1` FOREIGN KEY (`ingresos_id`) REFERENCES `ingresos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
    ADD CONSTRAINT `fk_gastos_dia1` FOREIGN KEY (`dia_id`) REFERENCES `dia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gastos_inventario1` FOREIGN KEY (`inventario_idproducto`) REFERENCES `inventario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
    ADD CONSTRAINT `fk_habitaciones_dia1` FOREIGN KEY (`dia_id1`) REFERENCES `dia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_habitaciones_inventario1` FOREIGN KEY (`inventario_idproducto`) REFERENCES `inventario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
    ADD CONSTRAINT `fk_ingresos_inventario1` FOREIGN KEY (`inventario_id`) REFERENCES `inventario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
    ADD CONSTRAINT `fk_inventario_Mes1` FOREIGN KEY (`Mes_id`) REFERENCES `mes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `limpiesa`
--
ALTER TABLE `limpiesa`
    ADD CONSTRAINT `fk_limpiesa_empleados1` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
    ADD CONSTRAINT `fk_productos_inventario1` FOREIGN KEY (`inventario_idproducto`) REFERENCES `inventario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_ventas1` FOREIGN KEY (`ventas_idventas`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
