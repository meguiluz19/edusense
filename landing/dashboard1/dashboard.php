<?php
session_start(); // Asegúrate de que la sesión esté iniciada para acceder a los datos del usuario.
if (!isset($_SESSION['usuario'])) {
    header('Location: login.html'); // Redirige al login si no hay sesión.
    exit();
}
$usuario = $_SESSION['usuario']; // Obtener el nombre de usuario de la sesión
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | EduSense</title>
    <!-- Agregar tu CSS y librerías -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" id="sidebar">
            <h3>EduSense</h3>
            <ul class="nav flex-column">
                <!-- Saludo con el usuario -->
                <li class="nav-item">
                    <h5>Bienvenido, <?php echo $usuario; ?>!</h5>
                </li>

                <!-- Botones de Temperatura y Humedad -->
                <li class="nav-item">
                    <a href="dashboard.php?view=temperatura" class="btn btn-danger mb-2 w-100">Temperatura</a>
                </li>
                <li class="nav-item">
                    <a href="dashboard.php?view=humedad" class="btn btn-primary mb-2 w-100">Humedad</a>
                </li>

                <!-- Paneles desplegables -->
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#alertas">
                        Alertas
                    </a>
                    <div class="collapse" id="alertas">
                        <ul class="list-unstyled">
                            <li><a href="alertas.php">Ver alertas</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#perfil">
                        Perfil de Usuario
                    </a>
                    <div class="collapse" id="perfil">
                        <ul class="list-unstyled">
                            <li><a href="perfil.php">Configurar perfil</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        
        <!-- Main content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h2>Panel de Control</h2>

                <!-- Mostrar el contenido según la vista (Temperatura/Humedad) -->
                <?php
                if (isset($_GET['view']) && $_GET['view'] == 'temperatura') {
                    echo "<div class='alert alert-danger'>Panel de Temperatura</div>";
                    // Aquí agregarías más lógica para mostrar la temperatura o alertas
                } elseif (isset($_GET['view']) && $_GET['view'] == 'humedad') {
                    echo "<div class='alert alert-primary'>Panel de Humedad</div>";
                    // Aquí agregarías más lógica para mostrar la humedad o alertas
                } else {
                    echo "<p>Seleccione una opción.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
