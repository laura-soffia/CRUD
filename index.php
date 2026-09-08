<?php
session_start();
require './db/funciones.php';
require 'db/conexion.php';



$errores = [];
$exito = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'])) {
    $name = trim($_POST["nombre"]);
    $last_name = trim($_POST["apellido"]);
    $documento = trim($_POST["documento"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $c_password = trim($_POST["c_password"]);
    $telefono = trim($_POST["telefono"]);

    $errores = Validar_usuario($name, $last_name, $documento, $email, $telefono, $password, $c_password);

    if (empty($errores)) {
        $exito = insertar_usuarios($name, $last_name, $documento, $email, $telefono, $password);
        if ($exito) {
            $name = $last_name = $documento = $email = $password = $c_password = $telefono = '';
        }
    }
}


$usuarios = obtener_usuarios();


if(isset($_POST['validar-usuario'])){
    $userForm = $_POST['dni-form'] ;
    $pwForm = $_POST['pw-form'] ;
    $userDB = "" ;
    $pwDB = "" ;

    $query = "SELECT * FROM usuario WHERE documento = '{$userForm}';";
    $resultado = mysqli_query($conex, $query);

if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);
    $userDB = $usuario['documento'];
    $userPW = $usuario['password'];
    $pwDB = $userPW;
}
    $autenticado = password_verify($pwForm, $pwDB);
    if($userForm === $userDB && $autenticado){
    $_SESSION['documento'] = $userDB;
    header('Location: bienvenida.php');
    exit;
} else {
    echo "Usuario o contraseña incorrecto";
}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo conexión DB</title>
</head>

<body>
    <form action="" method="POST">
        <label for="dni-form">Documento Usuario</label>
        <input type="number" name="dni-form">
        <label for="pw-form">Contraseña</label>
        <input type="password" name="pw-form">

        <input type="submit" value="Enviar" name="validar-usuario">
    </form>
    <h1>conexión con mySqli</h1>

    <h2>Agregar Usuario</h2>

    <?php if (!empty($errores)) { ?>

        <div>
            <?php foreach ($errores as $error) { ?>
                <p> <?php echo $error ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if ($exito): ?>
        <p>Usuario agregado correctamente</p>
    <?php endif; ?>

    <form action="" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $name ?? '' ?>"><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?php echo $last_name ?? '' ?>"><br>

        <label>Cédula:</label>
        <input type="text" name="documento" value="<?php echo $documento ?? '' ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email ?? '' ?>"><br>

        <label>Contraseña:</label>
        <input type="password" name="password"><br>

        <label>Confirmar Contraseña:</label>
        <input type="password" name="c_password"><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $telefono ?? '' ?>"><br>

        <button type="submit">Agregar</button>
    </form>

    <hr>

    <div>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user = mysqli_fetch_assoc($usuarios)) {

                ?>
                    <tr>
                        <td><?php echo $user["nombre"]; ?></td>
                        <td><?php echo $user["apellido"]; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

</body>

</html>