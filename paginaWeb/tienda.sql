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

-- Insertar valores en la tabla USER
INSERT INTO USER (username, name, rol, password, email, active) VALUES
('admin1', 'Admin User 1', 'admin', 'adminpass1', 'admin1@example.com', TRUE),
('customer1', 'Customer User 1', 'customer', 'customerpass1', 'customer1@example.com', TRUE),
('admin2', 'Admin User 2', 'admin', 'adminpass2', 'admin2@example.com', TRUE),
('customer2', 'Customer User 2', 'customer', 'customerpass2', 'customer2@example.com', TRUE);

-- Insertar valores en la tabla PRODUCT_TYPE
INSERT INTO PRODUCT_TYPE (category, name, price, brand, description, active) VALUES
('Electronics', 'Cabra Montesa', 599.99, 'BrandA', 'Recogida en tienda', TRUE),
('Clothing', 'Wallmart Kratos', 19.99, 'BrandB', 'Figura no muy fidedigna', TRUE),
('Electronics', 'Poster de El Papa', 999.99, 'BrandC', 'El Papa jugando al basket🥶', TRUE),
('Clothing', 'Jeans', 49.99, 'BrandD', 'Stylish denim jeans', TRUE);

-- Insertar valores en la tabla PRODUCT
INSERT INTO PRODUCT (color, size, stock, image_route, PT_ID, active) VALUES
('Black', 'Medium', 100, '/images/camiseta.jpg', 1, TRUE),
('White', 'Large', 50, '/images/laptop.jpg', 2, TRUE),
('Silver', 'One Size', 30, '/images/lavadora.jpg', 3, TRUE),
('Blue', '32', 70, '/images/s20.jpg', 4, TRUE);


-- Insertar valores en la tabla ORDERS
INSERT INTO ORDERS (order_date, direction, payment, total, USER_ID) VALUES
('2024-05-21 10:00:00', '123 Main St', 'Credit Card', 619.98, 2),
('2024-05-22 11:30:00', '456 Oak St', 'PayPal', 49.99, 4);

-- Insertar valores en la tabla ORDER_DETAIL
INSERT INTO ORDER_DETAIL (quantity, total_price, ORDER_ID, PRODUCT_ID) VALUES
(1, 599.99, 1, 1),
(1, 19.99, 1, 2),
(1, 49.99, 2, 4);



