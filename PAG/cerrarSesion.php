<?php
//Destruye la sesión y regresa al index.php, cierra sesión
session_start();  //recupera la sesión activa, esto es necesario para poder destruirla
session_destroy(); //borra todos los datos de la sesión, el $_SESSION['documento'] desaparece
header('Location: ../index.php'); //redirige de vuelta al login.
exit;