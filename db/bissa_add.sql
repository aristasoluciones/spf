-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.21-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para emfrichc_emfrich

-- Volcando estructura para tabla emfrichc_emfrich.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` char(64) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla emfrichc_emfrich.rolepermissions
CREATE TABLE IF NOT EXISTS `rolepermissions` (
  `RoleID` int(11) NOT NULL,
  `PermissionID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY (`RoleID`,`PermissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla emfrichc_emfrich.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` varchar(128) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla emfrichc_emfrich.userroles
CREATE TABLE IF NOT EXISTS `userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla emfrichc_emfrich.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuarioId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apaterno` varchar(255) NOT NULL,
  `amaterno` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `activo` enum('0','1') NOT NULL,
  `dependenciaId` int(11) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `noExterior` varchar(255) NOT NULL,
  `colonia` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `activado` enum('si','no') NOT NULL,
  `role_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`usuarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
