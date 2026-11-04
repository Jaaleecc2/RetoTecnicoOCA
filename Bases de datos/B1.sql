
SELECT TOP (5)
    c.id,
    c.nombre,
    c.nit,
    SUM(p.monto) AS total_pagado
FROM clientes AS c
INNER JOIN pagos AS p
    ON c.id = p.cliente_id
WHERE p.fecha_pago >= DATEADD(DAY, -90, GETDATE())
  AND p.fecha_pago <= GETDATE()
GROUP BY
    c.id,
    c.nombre,
    c.nit
ORDER BY
    total_pagado DESC,
    c.id ASC;
