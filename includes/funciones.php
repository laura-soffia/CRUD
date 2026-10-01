<?php

function Validar_usuario(string $name, string $last_name, string $documento, string $email, string $telefono, string $password, string $c_password)
{
    $errores = [];

    //empty es igual a vacío
    if (empty($name)) $errores[] = 'Ingrese el nombre';
    if (empty($last_name)) $errores[] = 'Ingrese el apellido';
    if (empty($documento)) $errores[] = 'Ingrese el documento';
    if (empty($email)) $errores[] = 'Ingrese el email';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = 'El email no es válido';
    elseif (email_existe($email)) $errores[] = 'El email ya está registrado';
    if (empty($password)) $errores[] = 'Ingrese la contraseña';
    //elseif (strlen($password) < 6) $errores[] = 'La contraseña debe contener al menos 6 caracteres';
    elseif ($password !== $c_password) $errores[] = 'La contraseña no coincide';
    if (empty($telefono)) $errores[] = 'Ingrese el teléfono';

    return $errores;
}

function email_existe(string $email): bool
{
    require './../db/conexion.php';
    $email = mysqli_real_escape_string($conex, $email);
    $sql = "SELECT idUsuario FROM usuario WHERE email = '$email'";
    $query = mysqli_query($conex, $sql);

    return mysqli_num_rows($query) > 0;
}


function validarSession(){
    session_start();
    if (!isset($_SESSION['documento'])){
        header("Location: ../index.php");
    }
}

function debug($arg){
    echo "<pre>";
    var_dump($arg);
    echo "</pre>";
    exit;
}
