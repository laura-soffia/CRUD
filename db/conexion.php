<?php
//Esta es otra ofrma de hacerlo pero es mejor la de abajo :)
// $hostname = "";
// $username = "";
// $password = "";
// $database = "";

// mysqli_connect("localhost", "root", "1234", "");

$hostname = "localhost";
$username = "root";
$password = "1234";
$database = "BibliotecasSena";

//Esta función sirve no solo para hacer una conexión sino también para 
$conex = mysqli_connect($hostname, $username, $password, $database);

// echo '<pre>';
// var_dump($conex);
// echo '</pre>';

// if (!$conex){
//     echo "Hubo un error";
//     exit;
// }

echo '<pre>';

$conex = mysqli_connect($hostname, $username, $password, $database);

