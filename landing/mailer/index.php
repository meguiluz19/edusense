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
    $mail->Subject = 'Nuevo Alta';
    $mail->Body = '<h1>EduSense</h1><p>Se ha registrado un nuevo alta.</p>';
    $mail->AltBody = 'Este es el texto alternativo para clientes que no soportan HTML.';

    // Enviar el correo
	foreach([
		'mvillanuevac08@educantabria.es','ggarciad01@educantabria.es',
		'afernandezv23@educantabria.es','sjimenezc04@educantabria.es','meguiluzg02@educantabria.es','marioegui19@gmail.com',
	] as $email){
		$mail->addAddress($email, str_replace('@educantabria.es','',$email)); // Destinatario
		$mail->send();
	}
    echo '';

} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}

echo '
<!doctype html>
<html>
<head>
	<title>Notificación de Alta</title>
	<link rel="stylesheet" href="estilo.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f9;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
		.container {
			background: #fff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			text-align: center;
		}
		h1 {
			margin-bottom: 20px;
		}
		.btn {
			background-color: #4CAF50;
			color: white;
			padding: 15px 32px;
			text-align: center;
			font-size: 16px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			text-decoration: none;
			display: inline-block;
			margin-top: 20px;
		}
		.btn:hover {
			background-color: #45a049;
		}
		.btn-secondary {
			background-color: #007BFF;
		}
		.btn-secondary:hover {
			background-color: #0056b3;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Notificación Enviada</h1>
		<p>Se ha notificado exitosamente del alta.</p>
		<a href="../login.html" class="btn btn-secondary">Iniciar Sesión</a>
	</div>
</body>
</html>
';
?>
