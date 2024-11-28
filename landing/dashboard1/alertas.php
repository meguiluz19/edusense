<?php
$temperatura = 35; // Esta sería la temperatura actual, podrías obtenerla de una base de datos o sensor
$humedad = 80; // Humedad actual

// Lógica de alertas
if ($temperatura > 30) {
    echo "<div class='alert alert-danger'>¡ALERTA! Temperatura alta: $temperatura°C</div>";
}
if ($humedad > 70) {
    echo "<div class='alert alert-warning'>¡ALERTA! Humedad alta: $humedad%</div>";
}
?>
