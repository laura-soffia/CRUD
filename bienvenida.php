<?php
session_start();  //Página protegida: solo se ve si hay una sesión activa ($_SESSION['documento']), muestra el saludo al usuario logueado.
if (!isset($_SESSION['documento'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
</head>
<body>
    <h1>Bienvenido, usuario <?php echo htmlspecialchars($_SESSION['documento']); ?></h1>
    <p>Has iniciado sesión con éxito.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
