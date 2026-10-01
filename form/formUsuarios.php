<?php
require "../includes/funciones.php";
require "../includes/users/create.php";
require "../db/conexion.php";

// $query = "INSERT * FROM usuario;";
// $usuario = mysqli_query($conex, $query);
validarSession();


$errores = [];
$exit = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["nombre"]);
    $last_name = trim($_POST["apellido"]);
    $documento = trim($_POST["documento"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $c_password = trim($_POST["c_password"]);
    $telefono = trim($_POST["telefono"]);

    $errores = Validar_usuario($name, $last_name, $documento, $email, $telefono, $password, $c_password);

    if (empty($errores)) {
        $exit = insertar_usuarios($name, $last_name, $documento, $email, $telefono, $password);
        if ($exit) {
            $name = $last_name = $documento = $email = $password = $c_password = $telefono = '';
        }
    }
}
$usuario = obtener_usuarios();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario usuarios</title>
</head>
<?php foreach ($errores as $e) echo "<p style='color:red'>$e</p>"; ?>
<body>
    <form action="" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $name ?? '' ?>"><br>
    <br>
    <label>Apellido:</label>
    <input type="text" name="apellido" value="<?php echo $last_name ?? '' ?>"><br>
    <br>
    <label>Cédula:</label>
    <input type="text" name="documento" value="<?php echo $documento ?? '' ?>"><br>
    <br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $email ?? '' ?>"><br>
    <br>
    <label>Contraseña:</label>
    <input type="password" name="password"><br>
    <br>
    <label>Confirmar Contraseña:</label>
    <input type="password" name="c_password"><br>
    <br>
    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $telefono ?? '' ?>"><br>
    <br>
    <button type="submit">Agregar</button><br>
    <br>
    <a href="../PAG/users.php">Volver a la página anterior</a><br>
</form>

</body>


</html>
