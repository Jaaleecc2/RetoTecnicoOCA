
-- B3: Diagnóstico y optimización de consultas lentas
-- en la tabla pagos.

-- 1. Revisaría el plan de ejecución real para
-- identificar Table Scans, Index Scans, Key Lookups
-- y diferencias entre filas estimadas y reales.

-- 2. Mediría el rendimiento actual utilizando
-- SET STATISTICS IO ON y SET STATISTICS TIME ON,
-- para establecer una referencia inicial.

-- 3. Revisaría los índices existentes y evaluaría
-- crear un índice sobre fecha_pago si el plan y
-- los patrones de consulta justifican su uso.


-- 4. Optimizaría la consulta evitando SELECT *,
-- funciones sobre fecha_pago y conversiones
-- innecesarias que dificulten usar el índice.

-- 5. Revisaría las estadísticas y el estado de
-- los índices, realizando mantenimiento únicamente
-- cuando las mediciones lo justifiquen.

-- 6. Si el problema persiste, evaluaría índices
-- compuestos, índices de cobertura, particionamiento
-- o archivado de información histórica.

-- Finalmente, compararía los tiempos y lecturas
-- antes y después para validar la mejora.
