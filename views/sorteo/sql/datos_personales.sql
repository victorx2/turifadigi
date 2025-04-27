CREATE TABLE `datos_personales` (
  `id_datos` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_datos`),
  KEY `id_compra` (`id_compra`),
  CONSTRAINT `datos_personales_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras_boletos` (`id_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 