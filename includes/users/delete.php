<?php
require_once __DIR__ . "/../../db/conexion.php";
require_once __DIR__ . "/../funciones.php";
validarSession();

$idUser = (int) $_GET['id']; // cast a int: evita inyección SQL
$query = "DELETE FROM usuario WHERE idUsuario = $idUser;"; // antes decía "DELETE * FROM" (SQL inválido)
$result = mysqli_query($conex, $query);

$state = ($result) ? 4 : 5;
header("Location: ../../PAG/users.php?state=$state");
exit;
