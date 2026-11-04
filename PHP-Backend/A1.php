// Codigo proporcionado con vulnerabilidades.

function login($usuario, $clave) {
    global $conn; // conexión PDO
    $sql = "SELECT id, nombre, clave FROM usuarios
            WHERE usuario = '$usuario' AND clave = '$clave'";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return $row;
    } else {
        die("Error: usuario o clave incorrectos. Query: " . $sql);
    }
}


//Codigo corregido y explicado.


function login($usuario, $clave) {
    global $conn;
// Con esto se comprueba que ambos parametros sean cadenas y asi mismo no esten vacias, se hace trim al usuario para que no existan inconvenientes al momento de buscarlo.

    if (!is_string($usuario) || !is_string($clave) ||
        trim($usuario) === '' || $clave === '') {
        return false;
    }

// Aqui se utiliza un parametro de tipo usuario para poder tratar el valor como un dato, no solo como instrucciones SQL, de esta forma no se busca password dentro de la consulta si no que primero se toma el usuario y se verifica password dentro de php
    try {
        $sql = "SELECT id, nombre, clave
                FROM usuarios
                WHERE usuario = :usuario";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':usuario' => $usuario
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
// compara la contraseña introducida con el hash almacenado.
        if (!$row || !password_verify($clave, $row['clave'])) {
            return false;
        }
// Se elimina el hash de la respuesta y se recive solo el nombre de usuario
        unset($row['clave']);

        return $row;
// Registramos el error internamente en lugar de mostrarlo al usuario.
    } catch (PDOException $e) {
        error_log("Error en login: " . $e->getMessage());
        return false;
    }
}
