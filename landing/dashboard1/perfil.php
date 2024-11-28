<form action="update_profile.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['nombre']; ?>" class="form-control">
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" class="form-control">
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
