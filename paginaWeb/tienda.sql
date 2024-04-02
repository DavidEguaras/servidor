
    
    CREATE TABLE USER (
        USER_ID INT AUTO_INCREMENT PRIMARY KEY,
        NAME VARCHAR(50),
        EMAIL VARCHAR(100),
        PASSWORD VARCHAR(100),
        ROL VARCHAR(100)
    );

    CREATE TABLE ORDERS (
        ORDER_ID INT AUTO_INCREMENT PRIMARY KEY,
        FK_USER_ID INT,
        ORDER_DATE DATE,
        DIRECTION VARCHAR(100),
        PAYMENT VARCHAR(100),
        FOREIGN KEY (FK_USER_ID) REFERENCES USER(USER_ID)
    );

    CREATE TABLE PRODUCT_TYPE (
        PTYPE_ID INT AUTO_INCREMENT PRIMARY KEY,
        CATEGORY VARCHAR(100),
        NAME VARCHAR(100),
        PRICE FLOAT,
        BRAND VARCHAR(100),
        DESCRIPTION VARCHAR(200)
    );

    CREATE TABLE PRODUCT (
        PRODUCT_ID INT AUTO_INCREMENT PRIMARY KEY,
        FK_PTYPE_ID INT,
        COLOR VARCHAR(100),
        SIZE VARCHAR(100),
        STOCK INT,
        FOREIGN KEY (FK_PTYPE_ID) REFERENCES PRODUCT_TYPE(PTYPE_ID)
    );

    CREATE TABLE ORDER_DETAIL (
        DETAIL_ID INT AUTO_INCREMENT PRIMARY KEY,
        FK_ORDER_ID INT,
        FK_PRODUCT_ID INT,
        QUANTITY INT,
        TOTAL_PRICE FLOAT,
        FOREIGN KEY (FK_ORDER_ID) REFERENCES ORDERS(ORDER_ID),
        FOREIGN KEY (FK_PRODUCT_ID) REFERENCES PRODUCT(PRODUCT_ID)
    );

    CREATE TABLE CART (
        CART_ID INT AUTO_INCREMENT PRIMARY KEY,
        FK_USER_ID INT,
        FK_PRODUCT_ID INT,
        LAST_UPDATE DATE,
        TOTAL_MONEY FLOAT,
        FOREIGN KEY (FK_USER_ID) REFERENCES USER(USER_ID),
        FOREIGN KEY (FK_PRODUCT_ID) REFERENCES PRODUCT(PRODUCT_ID)
    );
