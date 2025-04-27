CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `titular` varchar(100) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','verificado','rechazado') NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`id_pago`),
  KEY `id_compra` (`id_compra`),
  CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras_boletos` (`id_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 