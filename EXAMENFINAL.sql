DROP DATABASE IF EXISTS EXAMENFINAL;
CREATE DATABASE EXAMENFINAL;
USE EXAMENFINAL;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(50) UNIQUE,
    token VARCHAR(32),
    caduca TIMESTAMP DEFAULT (CURRENT_TIMESTAMP + INTERVAL 10 DAY)
);

-- Inserción de registros de ejemplo
INSERT INTO Usuarios (user, token, caduca) VALUES
    ('usuario1', 'Tk3N4uWx8zY7mBv1R6qA2pXc9E5sFdGh', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 DAY)),
    ('usuario2', 'A2pXc9E5sFdGhTk3N4uWx8zY7mBv1R', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 DAY)),
    ('admin', 'E5sFdGhTk3N4uWx8zY7mBv1R6qA2pXc9', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 DAY));

CREATE TABLE CochesDeSegundaMano (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    año_fabricacion INT,
    kilometraje INT,
    precio DECIMAL(10,2),
    color VARCHAR(20),
    descripcion TEXT
);

-- Inserción de registros de ejemplo
INSERT INTO CochesDeSegundaMano (marca, modelo, año_fabricacion, kilometraje, precio, color, descripcion) VALUES
('Toyota', 'Corolla', 2018, 35000, 15000.00, 'Gris', 'Excelente estado, único dueño.'),
('Honda', 'Civic', 2017, 42000, 14000.00, 'Azul', 'Servicios al día, sin choques.'),
('Ford', 'Focus', 2019, 28000, 17000.00, 'Blanco', 'Buen estado, mantenimiento completo.'),
('Chevrolet', 'Cruze', 2016, 50000, 12000.00, 'Negro', 'Interior impecable, poco uso.'),
('Volkswagen', 'Golf', 2015, 60000, 10000.00, 'Plata', 'Detalles estéticos menores, mecánica excelente.'),
('Nissan', 'Sentra', 2018, 32000, 16000.00, 'Rojo', 'Sin problemas mecánicos, mantenimiento reciente.'),
('Hyundai', 'Elantra', 2017, 38000, 13000.00, 'Negro', 'Perfecto estado, único propietario.'),
('Toyota', 'Camry', 2016, 45000, 13500.00, 'Azul', 'Funciona perfectamente, todas las revisiones en concesionario.'),
('Honda', 'Accord', 2019, 24000, 18000.00, 'Gris', 'Buen estado general, motor potente.'),
('Ford', 'Fiesta', 2015, 55000, 9500.00, 'Rojo', 'Buen funcionamiento, ideal para ciudad.'),
('Chevrolet', 'Malibu', 2017, 42000, 14500.00, 'Blanco', 'Buen estado, todas las comodidades.'),
('Volkswagen', 'Jetta', 2018, 34000, 15500.00, 'Negro', 'Excelente rendimiento, bajo consumo de combustible.'),
('Nissan', 'Altima', 2016, 48000, 12500.00, 'Plata', 'Nunca chocado, mantenimiento al día.'),
('Hyundai', 'Sonata', 2017, 40000, 14000.00, 'Azul', 'Funciona sin problemas, detalles exteriores menores.'),
('Toyota', 'Yaris', 2015, 58000, 9000.00, 'Blanco', 'Económico y confiable, ideal para viajes cortos.'),
('Honda', 'Fit', 2018, 32000, 16000.00, 'Verde', 'Mantenimientos al día, muy cuidado.'),
('Ford', 'Mustang', 2016, 45000, 25000.00, 'Negro', 'Potente y deportivo, en excelente estado.'),
('Chevrolet', 'Spark', 2017, 39000, 11000.00, 'Gris', 'Perfecto para la ciudad, bajo consumo de gasolina.'),
('Volkswagen', 'Beetle', 2015, 56000, 12000.00, 'Rojo', 'Diseño clásico, buen funcionamiento.'),
('Nissan', 'Versa', 2018, 33000, 13500.00, 'Blanco', 'Práctico y económico, bajo mantenimiento.');
