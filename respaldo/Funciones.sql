
DELIMITER //

CREATE FUNCTION ContarElementosCarrito(usuarioid INT)
RETURNS INT
BEGIN
    DECLARE contador INT;

    SELECT COUNT(*) INTO contador
    FROM (
        SELECT DISTINCT Carr_ID
        FROM Carrito c
        JOIN Producto p ON c.Prod_ID = p.Prod_ID
        JOIN Producto_Info pi ON p.Prod_ID = pi.Prod_ID
        LEFT JOIN Videos v ON p.Prod_ID = v.Prod_ID
        LEFT JOIN Fotos_1 f ON p.Prod_ID = f.Prod_ID
        LEFT JOIN Categorias ct ON pi.Cate_ID = ct.Cate_ID
        WHERE c.Carr_Estatus = 1 AND c.Usua_ID = usuarioid
        GROUP BY c.Prod_ID
    ) AS subconsulta;

    RETURN contador;
END //

DELIMITER ;



-- Ejemplo de uso de la función
SELECT ContarElementosCarrito(26) AS CantidadRepetidos;




DELIMITER //

CREATE FUNCTION CalcularSumaVentasPorProducto(ventpProdID INT)
RETURNS DECIMAL(10, 2)
BEGIN
    DECLARE sumaTotal DECIMAL(10, 2);

    SELECT SUM(vp.Ventp_Precio_total) INTO sumaTotal
    FROM Venta_por_producto vp
    JOIN Venta v ON vp.Venta_ID = v.Vent_ID
    WHERE vp.ventp_Prod_ID = ventpProdID AND vp.Ventp_Estatus = 1;

    RETURN sumaTotal;
END //

DELIMITER ;


-- Ejemplo de uso de la función
SELECT CalcularSumaVentasPorProducto(1) AS SumaVentasPorProducto;
