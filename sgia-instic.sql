-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2021 a las 22:29:28
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgia-instic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ano_academico`
--

CREATE TABLE `ano_academico` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `nome_ano_academico` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ano_lectivo`
--

CREATE TABLE `ano_lectivo` (
  `id` int(11) NOT NULL,
  `nome_ano_lectivo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `ano_lectivo_id` int(11) DEFAULT NULL,
  `nome_curso` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinador` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dicsiplina`
--

CREATE TABLE `dicsiplina` (
  `id` int(11) NOT NULL,
  `semestre_id` int(11) DEFAULT NULL,
  `nome_discilpina` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cant_horas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL,
  `nome_estudiante` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_dicsiplina`
--

CREATE TABLE `estudiante_dicsiplina` (
  `estudiante_id` int(11) NOT NULL,
  `dicsiplina_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE `semestre` (
  `id` int(11) NOT NULL,
  `ano_academico_id` int(11) DEFAULT NULL,
  `nome_semestre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `semestre_id` int(11) DEFAULT NULL,
  `nome_turma` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delegado` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turma_estudiante`
--

CREATE TABLE `turma_estudiante` (
  `turma_id` int(11) NOT NULL,
  `estudiante_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ano_academico`
--
ALTER TABLE `ano_academico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_71DC1E3787CB4A1F` (`curso_id`);

--
-- Indices de la tabla `ano_lectivo`
--
ALTER TABLE `ano_lectivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CA3B40ECBDBCD812` (`ano_lectivo_id`);

--
-- Indices de la tabla `dicsiplina`
--
ALTER TABLE `dicsiplina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_69B687C35577AFDB` (`semestre_id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiante_dicsiplina`
--
ALTER TABLE `estudiante_dicsiplina`
  ADD PRIMARY KEY (`estudiante_id`,`dicsiplina_id`),
  ADD KEY `IDX_80C3196959590C39` (`estudiante_id`),
  ADD KEY `IDX_80C31969A368F575` (`dicsiplina_id`);

--
-- Indices de la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_71688FBC1C419774` (`ano_academico_id`);

--
-- Indices de la tabla `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2B0219A65577AFDB` (`semestre_id`);

--
-- Indices de la tabla `turma_estudiante`
--
ALTER TABLE `turma_estudiante`
  ADD PRIMARY KEY (`turma_id`,`estudiante_id`),
  ADD KEY `IDX_10ED437ACEBA2CFD` (`turma_id`),
  ADD KEY `IDX_10ED437A59590C39` (`estudiante_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ano_academico`
--
ALTER TABLE `ano_academico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ano_lectivo`
--
ALTER TABLE `ano_lectivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dicsiplina`
--
ALTER TABLE `dicsiplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semestre`
--
ALTER TABLE `semestre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ano_academico`
--
ALTER TABLE `ano_academico`
  ADD CONSTRAINT `FK_71DC1E3787CB4A1F` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`);

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `FK_CA3B40ECBDBCD812` FOREIGN KEY (`ano_lectivo_id`) REFERENCES `ano_lectivo` (`id`);

--
-- Filtros para la tabla `dicsiplina`
--
ALTER TABLE `dicsiplina`
  ADD CONSTRAINT `FK_69B687C35577AFDB` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id`);

--
-- Filtros para la tabla `estudiante_dicsiplina`
--
ALTER TABLE `estudiante_dicsiplina`
  ADD CONSTRAINT `FK_80C3196959590C39` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_80C31969A368F575` FOREIGN KEY (`dicsiplina_id`) REFERENCES `dicsiplina` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `FK_71688FBC1C419774` FOREIGN KEY (`ano_academico_id`) REFERENCES `ano_academico` (`id`);

--
-- Filtros para la tabla `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `FK_2B0219A65577AFDB` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id`);

--
-- Filtros para la tabla `turma_estudiante`
--
ALTER TABLE `turma_estudiante`
  ADD CONSTRAINT `FK_10ED437A59590C39` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_10ED437ACEBA2CFD` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
