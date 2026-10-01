<?php

if (isset($_POST['validar-usuario'])) {
    $userForm = $_POST['dni-form'];
    $pwForm = $_POST['pw-form'];
    $userDB = "";
    $pwDB = "";
    $query = "SELECT * FROM usuario WHERE documento = '{$userForm}';";
    $resultado = mysqli_query($conex, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        $userDB = $usuario['documento'];
        $userPW = $usuario['password'];
        $pwDB = $userPW;
    }
    $autenticado = password_verify($pwForm, $pwDB);
    if ($userForm === $userDB && $autenticado) {
        //variable propia de php para iniciar sesión
        session_start();
        $_SESSION['documento'] = $userDB;
        header('Location: PAG/dashboard.php');
        exit;
    } else {
        echo "Usuario o contraseña incorrecto";
    }
}
