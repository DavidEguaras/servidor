DROP DATABASE tienda;
CREATE DATABASE tienda;
USE tienda;
--agregar variables booleanas
CREATE TABLE USER (
    USER_ID INT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    rol VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);


CREATE TABLE PRODUCT_TYPE(
    PT_ID INT PRIMARY KEY,
    category ENUM('camiseta', 'sudadera') NOT NULL,
    name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    brand VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL
);

CREATE TABLE PRODUCT(
    PRODUCT_ID INT PRIMARY KEY,
    color VARCHAR(255) NOT NULL,
    size VARCHAR(255) NOT NULL,
    stock int NOT NULL,
    image VARCHAR (255) NOT NULL,
    FK_PT_ID INT,
    FOREIGN KEY (FK_PT_ID) REFERENCES PRODUCT_TYPE(PT_ID)
);

CREATE TABLE CART(
    CART_ID INT PRIMARY KEY,
    last_update DATE NOT NULL,
    quantity INT NOT NULL,
    FK_USER_ID INT,
    FK_PRODUCT_ID INT,
    FOREIGN KEY (FK_USER_ID) REFERENCES USER(USER_ID),
    FOREIGN KEY (FK_PRODUCT_ID) REFERENCES PRODUCT(PRODUCT_ID)
);

CREATE TABLE ORDERS(
    ORDER_ID INT PRIMARY KEY,
    order_date DATE NOT NULL,
    direction VARCHAR(255) NOT NULL,
    payment VARCHAR(255) NOT NULL,
    total FLOAT NOT NULL,
    FK_USER_ID INT,
    FOREIGN KEY (FK_USER_ID) REFERENCES USER(USER_ID)
);

CREATE TABLE ORDER_DETAIL (
    DETAIL_ID INT PRIMARY KEY,
    quantity INT NOT NULL,
    total_price FLOAT NOT NULL,
    FK_ORDER_ID INT,
    FK_PRODUCT_ID INT,
    FOREIGN KEY (FK_ORDER_ID) REFERENCES ORDERS(ORDER_ID),
    FOREIGN KEY (FK_PRODUCT_ID) REFERENCES PRODUCT(PRODUCT_ID)
);



-- USER table
INSERT INTO USER (USER_ID, username, name, rol, password, email) 
VALUES 
(1, 'john_doe', 'John Doe', 'customer', 'password123', 'john@example.com');

-- PRODUCT_TYPE table
INSERT INTO PRODUCT_TYPE (PT_ID, category, name, price, brand, description) 
VALUES 
(1, 'camiseta', 'Basic T-Shirt', 19.99, 'XYZ Brand', 'A basic cotton t-shirt for everyday wear');

-- PRODUCT table
INSERT INTO PRODUCT (PRODUCT_ID, color, size, stock, image, FK_PT_ID) 
VALUES 
(1, 'black', 'M', 50, 'tshirt_black_m.jpg', 1);

-- CART table
INSERT INTO CART (CART_ID, last_update, quantity, FK_USER_ID, FK_PRODUCT_ID) 
VALUES 
(1, '2024-04-03', 2, 1, 1);

-- ORDERS table
INSERT INTO ORDERS (ORDER_ID, order_date, direction, payment, total, FK_USER_ID) 
VALUES 
(1, '2024-04-03', '123 Street Ave, City, Country', 'Credit Card', 39.98, 1);

-- ORDER_DETAIL table
INSERT INTO ORDER_DETAIL (DETAIL_ID, quantity, total_price, FK_ORDER_ID, FK_PRODUCT_ID) 
VALUES 
(1, 2, 39.98, 1, 1);
