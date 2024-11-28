<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "meguiluzg02";
$password = "123";
$dbname = "compra";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$usuario = $conn->real_escape_string($_POST['usuario']);
$passwordInput = $conn->real_escape_string($_POST['pass']);
$ip_address = $_SERVER['REMOTE_ADDR']; // Obtener la IP del usuario

// Configuración: número máximo de intentos y tiempo de bloqueo
$max_intentos = 3;
$tiempo_bloqueo = 1; // en minutos

// Verificar los intentos de acceso fallidos desde esta IP
$sql_intentos = "SELECT COUNT(*) AS intentos, MAX(fecha) AS ultima_fecha FROM intentos_acceso 
                 WHERE ip_address = '$ip_address' AND fecha > (NOW() - INTERVAL $tiempo_bloqueo MINUTE)";
$result_intentos = $conn->query($sql_intentos);
$row = $result_intentos->fetch_assoc();

// Si ya está bloqueado por superar el límite
if ($row['intentos'] >= $max_intentos) {
    $ultima_fecha = strtotime($row['ultima_fecha']);
    $tiempo_restante = $tiempo_bloqueo * 60 - (time() - $ultima_fecha);

    if ($tiempo_restante > 0) {
        echo "<script>
                alert('Ha superado el número máximo de intentos fallidos. Intente de nuevo en " . ceil($tiempo_restante / 60) . " minutos.');
                window.location.href = 'login.html';
              </script>";
        exit;
    }
}

// Verificar si las credenciales son correctas
$sql = "SELECT * FROM compras WHERE usuario = '$usuario' AND password = '$passwordInput'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    // Credenciales válidas
    $user = $result->fetch_assoc();
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['nombre'] = $user['nombre'];

    // Eliminar registros de intentos fallidos para esta IP
    $sql_clear_intentos = "DELETE FROM intentos_acceso WHERE ip_address = '$ip_address'";
    $conn->query($sql_clear_intentos);

    // Actualizar el estado de "logueado" en la base de datos
    $sql_update = "UPDATE compras SET usuario_logueado = 1 WHERE usuario = '$usuario'";
    $conn->query($sql_update);

    // Redirigir a la página protegida
    header("Location: dashboard.php");
    exit;
} else {
    // Registrar el intento fallido
    $sql_intento_fallido = "INSERT INTO intentos_acceso (usuario, ip_address, fecha) VALUES ('$usuario', '$ip_address', NOW())";
    $conn->query($sql_intento_fallido);

    // Contar los intentos fallidos actuales después del registro
    $sql_intentos_actuales = "SELECT COUNT(*) AS intentos FROM intentos_acceso 
                              WHERE ip_address = '$ip_address' AND fecha > (NOW() - INTERVAL $tiempo_bloqueo MINUTE)";
    $result_intentos_actuales = $conn->query($sql_intentos_actuales);
    $intentos_actuales = $result_intentos_actuales->fetch_assoc()['intentos'];

    if ($intentos_actuales >= $max_intentos) {
        echo "<script>
                alert('Ha superado el número máximo de intentos fallidos. Intente de nuevo en $tiempo_bloqueo minuto(s).');
                window.location.href = 'login.html';
              </script>";
    } else {
        echo "<script>
                alert('Credenciales incorrectas. Inténtelo de nuevo.');
                window.location.href = 'login.html';
              </script>";
    }
}

$conn->close();
?>
