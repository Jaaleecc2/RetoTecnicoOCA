-- Consulta inicial 

SELECT `id`, `nombre`
FROM `clientes`
ORDER BY `nombre`
LIMIT 20 OFFSET 40;

-- Consulta propuesta


SELECT
    [id],
    [nombre]
FROM [clientes]
ORDER BY [nombre]
OFFSET 40 ROWS
FETCH NEXT 20 ROWS ONLY;
