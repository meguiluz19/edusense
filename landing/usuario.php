<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html');
    exit;
}

echo "Bienvenido, " . $_SESSION['usuario'];
// Aquí puedes añadir más contenido para el usuario autenticado
?>
