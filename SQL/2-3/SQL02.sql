SELECT quantity,COUNT(quantity)
FROM t_sales
GROUP BY quantity
HAVING COUNT(quantity) > 1;