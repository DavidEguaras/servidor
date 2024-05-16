SELECT PT_ID FROM PRODUCT_TYPE 
    WHERE PRICE > 10;


    
SELECT PT_ID FROM PRODUCT_TYPE 
    WHERE PRICE > 10 AND description LIKE "%zapatillas%";

SELECT DISTINCT (PT_ID) FROM PRODUCT_TYPE 
    JOIN PRODUCT USING(PRODUCT_TYPE.PT_ID = PRODUCT.PT_ID)
    WHERE stock > 0 
    AND description = "zapatillas"
    AND color = "Negro"
    AND Pro;

color, size, category, price, brand