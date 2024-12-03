<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'edusensecontact@gmail.com';  // Cambia esto por tu correo
    $mail->Password = 'clrq upfi jgsw jevu';        // Cambia esto por tu contraseña
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Configuración del correo
    $mail->setFrom('edusensecontact@gmail.com', 'Mario Eguiluz');
    $mail->Subject = 'Notificación de Alta';
    $mail->isHTML(true); // Enviar el correo en formato HTML
    $mail->Body = '<h1>Hola</h1><p>Un nuevo usuario se ha registrado exitosamente.</p>';
    $mail->AltBody = 'Un nuevo usuario se ha registrado exitosamente.';

    // Añadir destinatarios
    foreach ([ 
        'mvillanuevac08@educantabria.es',
        'ggarciad01@educantabria.es',
        'afernandezv23@educantabria.es',
        'sjimenezc04@educantabria.es',
        'meguiluzg02@educantabria.es',
        'marioegui19@gmail.com',
    ] as $email) {
        $mail->addAddress($email, str_replace('@educantabria.es', '', $email));
    }

    // Enviar el correo
    $mail->send();
    echo 'Se ha notificado de su alta exitosamente.'; // Respuesta de éxito
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}"; // Respuesta de error si no se puede enviar el correo
}
?>
