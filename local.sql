-- Creación de la base de datos "local"
CREATE DATABASE IF NOT EXISTS local;

-- Selección de la base de datos "local"
USE local;

-- Creación de la tabla "indumentaria"
CREATE TABLE IF NOT EXISTS indumentaria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

-- Creación de la tabla "ingresos"
CREATE TABLE IF NOT EXISTS ingresos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_indumentaria INT,
    fecha_ingreso DATE NOT NULL,
    cantidad_ingreso INT NOT NULL,
    FOREIGN KEY (id_indumentaria) REFERENCES indumentaria(id)
);

-- Creación de la tabla "egresos"
CREATE TABLE IF NOT EXISTS egresos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_indumentaria INT,
    fecha_egreso DATE NOT NULL,
    cantidad_egreso INT NOT NULL,
    FOREIGN KEY (id_indumentaria) REFERENCES indumentaria(id)
);
