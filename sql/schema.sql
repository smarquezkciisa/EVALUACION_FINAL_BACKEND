
CREATE DATABASE IF NOT EXISTS todocamisetas;
USE todocamisetas;

CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_comercial VARCHAR(100),
    rut VARCHAR(20),
    direccion VARCHAR(100),
    categoria ENUM('Regular', 'Preferencial'),
    contacto_nombre VARCHAR(100),
    contacto_email VARCHAR(100),
    porcentaje_oferta DECIMAL(5,2)
);

CREATE TABLE IF NOT EXISTS camisetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    club VARCHAR(100),
    pais VARCHAR(50),
    tipo VARCHAR(50),
    color VARCHAR(50),
    precio DECIMAL(10,2),
    detalles TEXT,
    codigo_producto VARCHAR(30) UNIQUE,
    precio_oferta DECIMAL(10,2)
);

CREATE TABLE IF NOT EXISTS tallas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(5)
);

CREATE TABLE IF NOT EXISTS camiseta_talla (
    camiseta_id INT,
    talla_id INT,
    PRIMARY KEY (camiseta_id, talla_id),
    FOREIGN KEY (camiseta_id) REFERENCES camisetas(id) ON DELETE CASCADE,
    FOREIGN KEY (talla_id) REFERENCES tallas(id) ON DELETE CASCADE
);
