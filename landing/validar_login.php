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
$ip_address = $_SERVER['REMOTE_ADDR'];  // Obtener la IP del usuario

// Verificar los intentos de acceso fallidos desde esta IP
$sql_intentos = "SELECT COUNT(*) AS intentos FROM intentos_acceso WHERE ip_address = '$ip_address' AND fecha > (NOW() - INTERVAL 15 MINUTE)";
$result_intentos = $conn->query($sql_intentos);
$row = $result_intentos->fetch_assoc();

if ($row['intentos'] >= 5) {
    echo "<script>
            alert('Ha superado el número máximo de intentos fallidos. Intente de nuevo más tarde.');
            window.location.href = 'login.html';
          </script>";
    exit;
}

// Verificar si las credenciales son correctas
$sql = "SELECT * FROM compras WHERE usuario = '$usuario' AND password = '$passwordInput'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    // Credenciales válidas
    $user = $result->fetch_assoc();
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['nombre'] = $user['nombre'];

    // Actualizar el estado de "logueado" en la base de datos
    $sql_update = "UPDATE compras SET usuario_logueado = 1 WHERE usuario = '$usuario'";
    $conn->query($sql_update);

    // Redirigir a la página protegida
    header("Location: dashboard.php");
    exit;
} else {
    // Registrar el intento fallido
    $sql_intento_fallido = "INSERT INTO intentos_acceso (usuario, ip_address) VALUES ('$usuario', '$ip_address')";
    $conn->query($sql_intento_fallido);

    echo "<script>
            alert('Credenciales incorrectas. Inténtelo de nuevo.');
            window.location.href = 'login.html';
          </script>";
}

$conn->close();
?>
