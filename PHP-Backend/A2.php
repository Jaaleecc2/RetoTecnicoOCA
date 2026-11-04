
function registrarPago(
    $clienteId,
    $monto,
    $formaPago,
    $fechaPago
) {
    global $conn;

    if (!is_numeric($monto) || $monto <= 0) {
        throw new InvalidArgumentException(
            "El monto debe ser mayor a cero."
        );
    }

    $transaccionIniciada = false;

    try {
        $conn->beginTransaction();
        $transaccionIniciada = true;

        $sql = "INSERT INTO pagos
                (cliente_id, monto, forma_pago, fecha_pago)
                VALUES
                (:cliente_id, :monto, :forma_pago, :fecha_pago)";

        $stmt = $conn->prepare($sql);

        $resultado = $stmt->execute([
            ':cliente_id' => $clienteId,
            ':monto' => $monto,
            ':forma_pago' => $formaPago,
            ':fecha_pago' => $fechaPago
        ]);

        if (!$resultado) {
            throw new RuntimeException(
                "No se pudo registrar el pago."
            );
        }

        $idPago = $conn->lastInsertId();

        $conn->commit();
        $transaccionIniciada = false;

        return $idPago;

    } catch (Throwable $e) {
        if ($transaccionIniciada) {
            $conn->rollBack();
        }

        throw $e;
    }
}
