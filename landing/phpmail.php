<?php
// Incluye PHPMailer
require 'vendor/autoload.php'; // Cambia a la ruta correcta si no usas Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();                                  // Usar SMTP
    $mail->Host = 'smtp.gmail.com';                   // Servidor SMTP (por ejemplo, Gmail)
    $mail->SMTPAuth = true;                           // Habilitar autenticación SMTP
    $mail->Username = 'tu-email@gmail.com';           // Tu correo electrónico
    $mail->Password = 'tu-contraseña-o-app-password'; // Tu contraseña o contraseña de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Tipo de cifrado (TLS)
    $mail->Port = 587;                                // Puerto para TLS

    // Configuración del correo
    $mail->setFrom('tu-email@gmail.com', 'Tu Nombre');     // Remitente
    $mail->addAddress('destinatario@example.com', 'Nombre del Destinatario'); // Destinatario
    $mail->addReplyTo('respuesta@example.com', 'Responder a'); // Opcional: correo de respuesta

    // Archivos adjuntos (opcional)
    // $mail->addAttachment('/ruta/al/archivo.txt'); // Archivo adjunto
    // $mail->addAttachment('/ruta/a/imagen.jpg', 'nombre.jpg'); // Archivo con nombre personalizado

    // Contenido del mensaje
    $mail->isHTML(true);                                  // Configurar el contenido como HTML
    $mail->Subject = 'Asunto del correo';                 // Asunto
    $mail->Body    = '<h1>Este es un mensaje HTML</h1><p>Enviado desde PHPMailer</p>'; // Cuerpo en HTML
    $mail->AltBody = 'Este es el texto plano para clientes que no soportan HTML';       // Texto alternativo

    // Enviar el correo
    $mail->send();
    echo 'Mensaje enviado correctamente.';
} catch (Exception $e) {
    echo "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}";
}
