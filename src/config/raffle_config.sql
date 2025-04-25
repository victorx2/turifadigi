-- Tabla de tipos de premios
CREATE TABLE IF NOT EXISTS tipos_premios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de premios
CREATE TABLE IF NOT EXISTS premios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipo_premio_id INT NOT NULL,
    descripcion TEXT NOT NULL,
    boletos_minimos INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tipo_premio_id) REFERENCES tipos_premios(id)
);

-- Tabla de configuración de precios
CREATE TABLE IF NOT EXISTS configuracion_precios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    precio_boleto DECIMAL(10,2) NOT NULL,
    boletos_minimos INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla principal de configuración
CREATE TABLE IF NOT EXISTS configuracion_rifa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    configuracion_precios_id INT NOT NULL,
    numero_contacto VARCHAR(50) NOT NULL,
    url_loteria VARCHAR(255) NOT NULL,
    texto_ejemplo TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (configuracion_precios_id) REFERENCES configuracion_precios(id)
);

-- Insertar tipos de premios
INSERT INTO tipos_premios (nombre) VALUES
('Premio Mayor'),
('Segundo Premio'),
('Tercer Premio');

-- Insertar premios
INSERT INTO premios (tipo_premio_id, descripcion, boletos_minimos) VALUES
(1, 'Si estás en Estados Unidos, ganas una moto\nSi estás en otro país, ganas el valor de la moto al cambio de la moneda local desde donde participes', 2),
(2, 'Un iPhone 16 Pro Max\nDisponible para cualquier país participante', 2),
(3, '$1000 en efectivo\nPara participar debes comprar 10 boletos o más\nEste premio se activa con el 50% de los boletos vendidos', 10);

-- Insertar configuración de precios
INSERT INTO configuracion_precios (precio_boleto, boletos_minimos) VALUES
(3.00, 2);

-- Insertar configuración inicial
INSERT INTO configuracion_rifa (
    titulo, 
    configuracion_precios_id,
    numero_contacto,
    url_loteria,
    texto_ejemplo
) VALUES (
    '🎉 ¡POR EL SUPERGANA! 🎉',
    1,
    '407-428-7580',
    'https://tripletachira.com/',
    'Si compras 10 boletos, participas automáticamente en el sorteo de $1000 cuando se alcance el 50% de los números vendidos. El día se anunciará públicamente.'
); 