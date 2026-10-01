<?php

function obtener_usuarios()
{
    try {
        //Pasos para ejecutar una base de datos
        //1. Importar la conexión
        require "./../db/conexion.php";

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

function insertar_usuarios($name, $last_name, $documento, $email, $telefono, $password)
{
    try {
        global $conex;
        require_once __DIR__ . '/../../db/conexion.php';

        $name = mysqli_real_escape_string($conex, $name);
        $last_name = mysqli_real_escape_string($conex, $last_name);
        $documento = mysqli_real_escape_string($conex, $documento);
        $email = mysqli_real_escape_string($conex, $email);
        $password = mysqli_real_escape_string($conex, password_hash($password, PASSWORD_BCRYPT));
        $telefono = mysqli_real_escape_string($conex, $telefono);

        $sql = "INSERT INTO usuario (nombre, apellido, documento, email, telefono, password)
            VALUES ('$name', '$last_name', '$documento', '$email', '$telefono', '$password')";

        $resultado = mysqli_query($conex, $sql);
        if (!$resultado) die(mysqli_error($conex));

        header("Location: ../PAG/users.php?status=0");
        exit;
    } catch (\Throwable $th) {
        var_dump($th);
        return false;
    }
}
