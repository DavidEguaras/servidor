-- Crear base de datos
DROP DATABASE IF EXISTS;
CREATE DATABASE IF NOT EXISTS EXAMEN_NORMAL;
USE EXAMEN_NORMAL;

-- Crear tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Insertar datos de ejemplo en la tabla de usuarios
INSERT INTO usuarios (username, name, rol, password, email) VALUES 
('user1', 'John Doe', 'admin', SHA1('password1'), 'john.doe@example.com'),
('user2', 'Jane Smith', 'user', SHA1('password2'), 'jane.smith@example.com');

-- Crear tabla de coches
CREATE TABLE IF NOT EXISTS coches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(50) NOT NULL,
    marca VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Insertar datos de ejemplo en la tabla de coches
INSERT INTO coches (modelo, marca, descripcion, precio) VALUES 
('Model S', 'Tesla', 'Electric car with autopilot', 79999.99),
('Mustang', 'Ford', 'Classic American muscle car', 55999.99);
