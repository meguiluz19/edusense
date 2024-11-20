<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "meguiluzg02";
    $password = "123";
    $dbname = "compra";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $plan = $conn->real_escape_string($_POST['plan']);

    // Generar credenciales únicas
    $usuario = strtolower(str_replace(' ', '', $nombre)) . rand(100, 999);
    $password = bin2hex(random_bytes(4));

    // Guardar en la base de datos
    $sql = "INSERT INTO compras (nombre, email, telefono, direccion, plan, usuario, password) 
            VALUES ('$nombre', '$email', '$telefono', '$direccion', '$plan', '$usuario', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['password'] = $password;

        // Redirigir a credenciales.php
        header("Location: credenciales.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
