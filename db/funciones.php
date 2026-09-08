<?php

function obtener_usuarios()
{
    try {
        //Pasos para ejecutar una base de datos
        //1. Importar la conexión
        require 'conexion.php';

        //2. Consukltar la base de datos
        //; interno se refiere a la base de datos el externo se refiere a php
        $sql = "SELECT * FROM usuario;";
        $query = mysqli_query($conex, $sql);

        //3. Ejecutar la consulta con mysqli
        //$query = mysqli_query($conex, $sql);

        mysqli_query($conex, $sql);

        //4. Acceder a los resultados

        //asoc: trae el nombre de la columnas, trae el primer dato de la base de datos
        //all: traigame todo de ususario, trae los numeros dentro de un array interno
        //array: trae tanto como el identificador como el nombre de la columna
        //field: trae absolutamente tod el tipo de información que tenga dentro de la base de datos

        // echo '<pre>';
        // var_dump(mysqli_fetch_assoc($query));
        // echo '</pre>';

        // opcional 5. cierre de conexión
        //es opcional porque generalmente al realizar una base de datos, una vez que php detecta una conexión abierta él mismito realiza una conexion a la base de datos

        //$cierre = mysqli_close($conex);
        //var_dump($cierre);

        return $query;
    } catch (\Throwable $th) {
        var_dump($th);
    }
}



function insertar_usuarios(string $name, string $last_name, string $documento, string $email, string $telefono, string $password)
{
    try {
        require 'conexion.php';

        $password = password_hash($password, PASSWORD_BCRYPT);

        $name = mysqli_real_escape_string($conex, $name);
        $last_name = mysqli_real_escape_string($conex, $last_name);
        $documento = mysqli_real_escape_string($conex, $documento);
        $email = mysqli_real_escape_string($conex, $email);
        $telefono = mysqli_real_escape_string($conex, $telefono);
        $password = mysqli_real_escape_string($conex, $password);

        $sql = "INSERT INTO usuario (nombre, apellido, documento, email, telefono, password) VALUES ('$name', '$last_name', '$documento', '$email', '$telefono', '$password');";
        
        $query = mysqli_query($conex, $sql);

        if (!$query) {
            die(mysqli_error($conex));
        }

        return $query;
    } catch (\Throwable $th) {
        var_dump($th);
        return false;
    }
}


function Validar_usuario(string $name, string $last_name, string $documento, string $email, string $telefono, string $password, string $c_password)
{
    $errores = [];

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
    require './db/conexion.php';
    $email = mysqli_real_escape_string($conex, $email);
    $sql = "SELECT idUsuario FROM usuario WHERE email = '$email'";
    $query = mysqli_query($conex, $sql);

    return mysqli_num_rows($query) > 0;
}
