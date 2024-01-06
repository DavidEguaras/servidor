CREATE TABLE USER(
    USER_ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR (50),
    EMAIL VARCHAR (100),
    PASSWORD VARCHAR (100),
    ROL VARCHAR (100)
);





CREATE TABLE ORDER(
    ORDER_ID INT AUTO_INCREMENT PRIMARY KEY,
    FK_USER_ID INT,
    ORDER_DATE DATE,
    DIRECTION VARCHAR (100),
    PAYMENT VARCHAR (100),
    FOREIGN KEY (FK_USER_ID) REFERENCES USER(USER_ID)
);

CREATE TABLE PRODUCT_TYPE(
    PRODUCT_TYPE_ID INT AUTO_INCREMENT PRIMARY KEY()
);

CREATE TABLE ORDER_DETAIL(
    DETAIL_ID INT AUTO_INCREMENT PRIMARY KEY,
    FK_ORDER_ID INT,
    QUANTITY INT,
    TOTAL_PRICE FLOAT,
    FOREIGN KEY (FK_ORDER_ID) REFERENCES ORDER(ORDER_ID)
);
