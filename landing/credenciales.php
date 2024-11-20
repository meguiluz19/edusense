<?php
// Asegúrate de iniciar la sesión para compartir datos entre scripts
session_start();

// Verifica si las credenciales existen en la sesión
if (!isset($_SESSION['usuario']) || !isset($_SESSION['password'])) {
    echo "No se encontraron credenciales. Por favor, completa el formulario de compra.";
    exit;
}

$usuario = $_SESSION['usuario'];
$password = $_SESSION['password'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credenciales Generadas</title>
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
        .credentials {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }
        .advertencia {
            background-color: #ffcc00;
            color: #000;
            padding: 15px;
            font-weight: bold;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Advertencia de guardar credenciales -->
        <div class="advertencia">
            <strong>¡Advertencia!</strong> Guarda tus credenciales de inicio de sesión. Las necesitarás para futuros inicios de sesión.
        </div>
        
        <h1>Credenciales Generadas</h1>
        <p class="credentials">Usuario: <strong><?php echo $usuario; ?></strong></p>
        <p class="credentials">Contraseña: <strong><?php echo $password; ?></strong></p>
        <p>Guarda estas credenciales para futuros inicios de sesión.</p>

        <!-- Botón para redirigir al login -->
        <a href="login.html" class="btn">Iniciar Sesión</a>
    </div>
</body>
</html>
