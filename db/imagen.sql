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

-- Volcando estructura para tabla emfrichc_emfrich.imagen
CREATE TABLE IF NOT EXISTS `imagen` (
  `imagenId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `categoriaId` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` enum('slider','producto') NOT NULL,
  `extension` varchar(50) NOT NULL,
  PRIMARY KEY (`imagenId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
