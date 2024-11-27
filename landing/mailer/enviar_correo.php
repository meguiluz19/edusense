<?php
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $plan = $_POST['plan'];

    // Crear la instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'edusensecontact@gmail.com'; // Cambia esto por tu correo
        //$mail->Password = 'Edusense123'; // Cambia esto por tu contraseña
        $mail->Password = 'clrq upfi jgsw jevu'; // Cambia esto por tu contraseña (o contraseña de aplicación)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom('edusensecontact@gmail.com', 'Mario Eguiluz'); // Remitente
        $mail->addAddress($email, $nombre); // Dirección de correo proporcionada en el formulario

        // Contenido del correo
        $mail->isHTML(true); // Indicar que el correo tendrá HTML
        $mail->Subject = 'Confirmación de Compra';
        $mail->Body = "
            <h1>¡Gracias por tu compra!</h1>
            <p>Has seleccionado el <strong>$plan</strong>.</p>
            <p>Datos de la compra:</p>
            <ul>
                <li><strong>Nombre:</strong> $nombre</li>
                <li><strong>Correo Electrónico:</strong> $email</li>
                <li><strong>Teléfono:</strong> $telefono</li>
                <li><strong>Dirección:</strong> $direccion</li>
                <li><strong>Plan Seleccionado:</strong> $plan</li>
            </ul>
        ";
        $mail->AltBody = 'Este es el texto alternativo para clientes que no soportan HTML.';

        // Enviar el correo
        $mail->send();

        echo 'Correo enviado exitosamente a ' . $email;
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
} else {
    echo 'Método no permitido.';
}
?>
