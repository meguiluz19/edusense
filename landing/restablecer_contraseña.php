<?php
// Configuración para habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conectar con la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "compra"; // El nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger el correo del formulario
$email = $conn->real_escape_string($_POST['email']);

// Verificar si el correo está registrado en la base de datos
$sql = "SELECT id_usuario, nombre FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario encontrado, generar el token para la recuperación
    $user = $result->fetch_assoc();
    $user_id = $user['id_usuario'];
    
    // Generar un token único de recuperación
    $token = bin2hex(random_bytes(50)); // Esto crea un token de 100 caracteres hexadecimales

    // Guardar el token y la fecha de expiración en la base de datos
    $expiracion = date("Y-m-d H:i:s", strtotime("+1 hour")); // El token expirará en 1 hora
    $sql = "UPDATE usuarios SET token_recuperacion = '$token', token_expiracion = '$expiracion' WHERE id_usuario = $user_id";
    
    if ($conn->query($sql) === TRUE) {
        // Crear el enlace de recuperación
        $url = "http://tusitio.com/restablecer_contraseña.php?token=$token";
        
        // Enviar el correo electrónico
        $asunto = "Recuperación de contraseña";
        $mensaje = "Hola " . $user['nombre'] . ",\n\nHemos recibido una solicitud para recuperar tu contraseña. Haz clic en el siguiente enlace para restablecerla:\n\n" . $url;
        $cabeceras = "From: no-reply@tusitio.com";
        
        if (mail($email, $asunto, $mensaje, $cabeceras)) {
            echo "Se ha enviado un correo con instrucciones para recuperar tu contraseña.";
        } else {
            echo "Hubo un error al enviar el correo. Intenta nuevamente.";
        }
    } else {
        echo "Error al generar el token. Intenta nuevamente.";
    }
} else {
    echo "No encontramos un usuario con ese correo electrónico.";
}

$conn->close();
?>
