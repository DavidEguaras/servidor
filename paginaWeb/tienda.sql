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
    imageRoute VARCHAR(255) NOT NULL,
    FK_PT_ID INT,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (FK_PT_ID) REFERENCES PRODUCT_TYPE(PT_ID)
);

CREATE TABLE CART(
    CART_ID INT PRIMARY KEY AUTO_INCREMENT,
    last_update DATE NOT NULL,
    quantity INT NOT NULL,
    FK_USER_ID INT,
    FK_PRODUCT_ID INT,
    FOREIGN KEY (FK_USER_ID) REFERENCES USER(USER_ID),
    FOREIGN KEY (FK_PRODUCT_ID) REFERENCES PRODUCT(PRODUCT_ID)
);

CREATE TABLE ORDERS(
    ORDER_ID INT PRIMARY KEY AUTO_INCREMENT,
    order_date TIMESTAMP NOT NULL,
    direction VARCHAR(255) NOT NULL,
    payment VARCHAR(255) NOT NULL,
    total FLOAT NOT NULL,
    FK_USER_ID INT,
    FOREIGN KEY (FK_USER_ID) REFERENCES USER(USER_ID)
);

CREATE TABLE ORDER_DETAIL (
    DETAIL_ID INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT NOT NULL,
    total_price FLOAT NOT NULL,
    FK_ORDER_ID INT,
    FK_PRODUCT_ID INT,
    FOREIGN KEY (FK_ORDER_ID) REFERENCES ORDERS(ORDER_ID),
    FOREIGN KEY (FK_PRODUCT_ID) REFERENCES PRODUCT(PRODUCT_ID)
);
