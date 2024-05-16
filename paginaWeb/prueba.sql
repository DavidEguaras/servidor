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

-- por cada filtro, se agrega al query una condicion AND y se iguala( 
-- salvo en algun caso como por ejemplo el precio que simplemente seria poner un <)
--Ya que al ser clave valor le pasamos un array con estos valores y por cada filtro agregamos un AND al select