<?php
//login

include "./db/conexion.php";
include "PAG/sigIn.php";

// $errores = [];
// $exito = false;
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'])) {
//     $name = trim($_POST["nombre"]);
//     $last_name = trim($_POST["apellido"]);
//     $documento = trim($_POST["documento"]);
//     $email = trim($_POST["email"]);
//     $password = trim($_POST["password"]);
//     $c_password = trim($_POST["c_password"]);
//     $telefono = trim($_POST["telefono"]);
//     $errores = Validar_usuario($name, $last_name, $documento, $email, $telefono, $password, $c_password);
//     if (empty($errores)) {
//         $exit = insertar_usuarios($name, $last_name, $documento, $email, $telefono, $password);
//         if ($exit) {
//             $name = $last_name = $documento = $email = $password = $c_password = $telefono = '';
//         }
//     }
// }

//usuarios
// include "includes/users/create.php";
// $usuarios = obtener_usuarios();
//SI EXISTE

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Conexion DB</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="POST">
        <label for="dni-form">Documento Usuario</label>
        <input type="number" name="dni-form">
        <label for="pw-form">Contraseña</label>
        <input type="password" name="pw-form">
        <input type="submit" value="Enviar" name="validar-usuario">
    </form>
</body>
</html>