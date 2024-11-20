<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al login
    header("Location: login.php");
    exit();
}

// Si está autenticado, mostrar el dashboard
echo "Bienvenido al Dashboard, " . $_SESSION['user_email'];
?>

<!-- Aquí puedes agregar contenido de tu dashboard -->
<a href="logout.php">Cerrar sesión</a>
