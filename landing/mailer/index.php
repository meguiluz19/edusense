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
    $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'edusensecontact@gmail.com'; // Cambia esto por tu correo
    //$mail->Password = 'Edusense123'; // Cambia esto por tu contraseña
	$mail->Password = 'clrq upfi jgsw jevu'; // Cambia esto por tu contraseña
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS
    $mail->Port = 587; // Puerto 587 para STARTTLS, 465 para SSL

    // Configuración del correo
    $mail->setFrom('edusensecontact@gmail.com', 'Mario Eguiluz'); // Remitente
    $mail->addAddress('edusensecontact@gmail.com', 'David (profe)'); // Destinatario

    // Contenido del correo
    $mail->isHTML(true); // Indicar que el correo tendrá HTML
    $mail->Subject = 'Correo de Prueba';
    $mail->Body = '<h1>Hola</h1><p>Este es un correo de prueba enviado desde PHPMailer.</p>';
    $mail->AltBody = 'Este es el texto alternativo para clientes que no soportan HTML.';

    // Enviar el correo
	foreach([
		'mvillanuevac08@educantabria.es','ggarciad01@educantabria.es',
		'afernandezv23@educantabria.es','sjimenezc04@educantabria.es','meguiluzg02@educantabria.es','marioegui19@gmail.com',
	] as $email){
		$mail->addAddress($email, str_replace('@educantabria.es','',$email)); // Destinatario
		$mail->send();
	}
    echo 'Correo enviado exitosamente.';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}


echo '
<!doctype html>
<html>
<head>
	<title>holamundo</title>
	<link rel="stylesheet" href="estilo.css">
</head>
<body>
';



echo '
</body>
</html>
';