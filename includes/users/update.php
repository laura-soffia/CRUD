<?php
include "../../db/conexion.php";
include "../../includes/funciones.php";
validarSession();

$idUser = (int) $_GET['id'];
$errores = [];

$res = mysqli_query($conex, "SELECT * FROM usuario WHERE idUsuario = $idUser");
$data = mysqli_fetch_assoc($res);

if (isset($_POST['editar'])) {
    $documento    = trim($_POST['documento']);
    $name         = trim($_POST['nombre']);
    $last_name    = trim($_POST['apellido']);
    $email        = trim($_POST['email']);
    $telefono     = trim($_POST['telefono']);
    $old_password = trim($_POST['old_password']);
    $new_password = trim($_POST['new_password']);
    $c_password   = trim($_POST['c_password']);

    if (!$documento) $errores[] = "Ingrese el documento";
    if (!$name) $errores[] = "Ingrese el nombre";
    if (!$last_name) $errores[] = "Ingrese el apellido";
    if (!$telefono) $errores[] = "Ingrese el teléfono";

    if (!$email) {
        $errores[] = "Ingrese el email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no es válido";
    } else {
        $e = mysqli_real_escape_string($conex, $email);
        $r = mysqli_query($conex, "SELECT idUsuario FROM usuario WHERE email = '$e' AND idUsuario != $idUser");
        if (mysqli_num_rows($r) > 0) $errores[] = "El email ya está registrado";
    }

    // Contraseña: solo se cambia si escriben una nueva
    $passFinal = $data['password'];
    if ($new_password !== '') {
        if (!password_verify($old_password, $data['password'])) $errores[] = "La contraseña actual es incorrecta";
        if ($new_password !== $c_password) $errores[] = "La contraseña no coincide";
        $passFinal = password_hash($new_password, PASSWORD_BCRYPT);
    }


    if (!$errores) {
        $documento = mysqli_real_escape_string($conex, $documento);
        $name      = mysqli_real_escape_string($conex, $name);
        $last_name = mysqli_real_escape_string($conex, $last_name);
        $email     = mysqli_real_escape_string($conex, $email);
        $telefono  = mysqli_real_escape_string($conex, $telefono);
        $passFinal = mysqli_real_escape_string($conex, $passFinal);

        $sql = "UPDATE usuario SET documento='$documento', nombre='$name', apellido='$last_name',
                email='$email', password='$passFinal', telefono='$telefono'
                WHERE idUsuario = $idUser";

        $ok = mysqli_query($conex, $sql);
        if (!$ok) die("Error SQL: " . mysqli_error($conex));

        header("Location: ../../PAG/users.php?status=2");
        exit;
    }


}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Actualizar usuario</title></head>
<body>
<h2>Actualización de usuarios</h2>

<?php foreach ($errores as $error) echo "<p style='color:red'>" . htmlspecialchars($error) . "</p>"; ?>

<form action="" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($data['nombre']); ?>"><br><br>
    <label>Apellido:</label>
    <input type="text" name="apellido" value="<?php echo htmlspecialchars($data['apellido']); ?>"><br><br>
    <label>Cédula:</label>
    <input type="text" name="documento" value="<?php echo htmlspecialchars($data['documento']); ?>"><br><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>"><br><br>
    <label>Contraseña actual:</label>
    <input type="password" name="old_password"><br><br>
    <label>Nueva contraseña (opcional):</label>
    <input type="password" name="new_password"><br><br>
    <label>Confirmar nueva contraseña:</label>
    <input type="password" name="c_password"><br><br>
    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo htmlspecialchars($data['telefono']); ?>"><br><br>
    <button type="submit" name="editar">Actualizar</button><br><br>
    <a href="../../PAG/users.php">Volver a la página anterior</a>
</form>
</body>
</html>