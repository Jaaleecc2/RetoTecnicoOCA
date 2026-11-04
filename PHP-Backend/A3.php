// Codigo original 

function diasMora($fechaVencimiento, $fechaPago) {
    $dias = (strtotime($fechaPago) - strtotime($fechaVencimiento)) / 86400;
    return $dias;
}

//Solucion propuesta 

//Se establece una zona horaria, tomando en consideracion si el sistema se encuentra en otro pais.
function diasMora($fechaVencimiento, $fechaPago) {
    $zonaHoraria = new DateTimeZone('America/Guatemala');
//se convierten las cadenas a fechas 
    $vencimiento = DateTimeImmutable::createFromFormat(
        '!Y-m-d',
        $fechaVencimiento,
        $zonaHoraria
    );

    $pago = DateTimeImmutable::createFromFormat(
        '!Y-m-d',
        $fechaPago,
        $zonaHoraria
    );
// se validan las fechas
    if (
        !$vencimiento ||
        !$pago ||
        $vencimiento->format('Y-m-d') !== $fechaVencimiento ||
        $pago->format('Y-m-d') !== $fechaPago
    ) {
        throw new InvalidArgumentException(
            "Las fechas deben ser válidas y tener formato Y-m-d."
        );
    }
// se eliminan errores por dias de mora negativa 
    if ($pago <= $vencimiento) {
        return 0;
    }
// entrega la difernencia de 2 fechas
    return (int) $vencimiento->diff($pago)->days;
}
