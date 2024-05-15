-- Eliminar la base de datos si existe
DROP DATABASE IF EXISTS tienda;

-- Crear la base de datos
CREATE DATABASE tienda;

-- Conectar a la base de datos tienda
USE tienda;

-- Crear las tablas
CREATE TABLE USER (
    USER_ID INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    rol VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE PRODUCT_TYPE(
    PT_ID INT PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    brand VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE PRODUCT(
    PRODUCT_ID INT PRIMARY KEY AUTO_INCREMENT,
    color VARCHAR(255) NOT NULL,
    size VARCHAR(255) NOT NULL,
    stock INT NOT NULL,
    image_route VARCHAR(255) NOT NULL,
    PT_ID INT,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (PT_ID) REFERENCES PRODUCT_TYPE(PT_ID)
);

CREATE TABLE CART(
    CART_ID INT PRIMARY KEY AUTO_INCREMENT,
    last_update DATE NOT NULL,
    quantity INT NOT NULL,
    USER_ID INT,
    PRODUCT_ID INT,
    FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID),
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCT(PRODUCT_ID)
);

CREATE TABLE ORDERS(
    ORDER_ID INT PRIMARY KEY AUTO_INCREMENT,
    order_date TIMESTAMP NOT NULL,
    direction VARCHAR(255) NOT NULL,
    payment VARCHAR(255) NOT NULL,
    total FLOAT NOT NULL,
    USER_ID INT,
    FOREIGN KEY (USER_ID) REFERENCES USER(USER_ID)
);

CREATE TABLE ORDER_DETAIL (
    DETAIL_ID INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT NOT NULL,
    total_price FLOAT NOT NULL,
    ORDER_ID INT,
    PRODUCT_ID INT,
    FOREIGN KEY (ORDER_ID) REFERENCES ORDERS(ORDER_ID),
    FOREIGN KEY (PRODUCT_ID) REFERENCES PRODUCT(PRODUCT_ID)
);




-- Insertar usuarios
INSERT INTO USER (username, name, rol, password, email) VALUES
('usuario1', 'Juan Pérez', 'cliente', 'contraseña1', 'juan@example.com'),
('usuario2', 'María López', 'cliente', 'contraseña2', 'maria@example.com'),
('admin1', 'Admin Admin', 'administrador', 'adminpass', 'admin@example.com');

-- Insertar tipos de productos
INSERT INTO PRODUCT_TYPE (category, name, price, brand, description) VALUES
('Electrónica', 'Smartphone', 500.00, 'Samsung', 'Smartphone Samsung Galaxy S20'),
('Electrodomésticos', 'Lavadora', 800.00, 'Whirlpool', 'Lavadora de carga frontal'),
('Ropa', 'Camiseta', 20.00, 'Nike', 'Camiseta deportiva Nike'),
('Electrónica', 'Laptop', 1200.00, 'Dell', 'Laptop Dell XPS 13');

-- Insertar productos
INSERT INTO PRODUCT (color, size, stock, image_route, PT_ID) VALUES
('Negro', 'Grande', 50, '/images/s20.jpg', 1),
('Blanco', 'Mediano', 30, '/images/lavadora.jpg', 2),
('Rojo', 'Pequeño', 100, '/images/camiseta.jpg', 3),
('Plata', 'Mediano', 20, '/images/laptop.jpg', 4);

-- Insertar elementos en el carrito
INSERT INTO CART (last_update, quantity, USER_ID, PRODUCT_ID) VALUES
('2024-05-15', 2, 1, 1),
('2024-05-15', 1, 1, 2),
('2024-05-15', 3, 2, 3),
('2024-05-15', 1, 3, 4);

-- Insertar órdenes
INSERT INTO ORDERS (order_date, direction, payment, total, USER_ID) VALUES
('2024-05-15 10:30:00', 'Calle 123', 'Tarjeta de crédito', 1200.00, 1),
('2024-05-15 11:45:00', 'Avenida Principal', 'PayPal', 100.00, 2),
('2024-05-15 12:15:00', 'Plaza Central', 'Efectivo', 2400.00, 3);

-- Insertar detalles de órdenes
INSERT INTO ORDER_DETAIL (quantity, total_price, FK_ORDER_ID, PRODUCT_ID) VALUES
(2, 1000.00, 1, 1),
(1, 800.00, 1, 2),
(3, 60.00, 2, 3),
(1, 1200.00, 3, 4);
