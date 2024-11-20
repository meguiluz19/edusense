<?php
// Inicia la sesión
session_start();

// Configuración de la base de datos (ajusta estos valores)
$host = 'localhost'; // o tu host
$dbname = 'compra';
$username = 'meguiluzg02';
$password = '123';

// Conectar a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($usuario && password_verify($password, $usuario['password'])) {
        // Si las credenciales son correctas, guardar los datos en la sesión
        $_SESSION['usuario'] = $usuario['email'];
        $_SESSION['id'] = $usuario['id'];

        // Redirigir a la página de usuario o dashboard
        header('Location: usuario.php');
        exit;
    } else {
        // Si las credenciales no son correctas, mostrar un error
        echo "Correo electrónico o contraseña incorrectos.";
    }
}
?>
