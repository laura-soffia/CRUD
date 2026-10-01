<?php
    require "../includes/users/create.php";
    require "../includes/funciones.php";
    validarSession();
    $usuarios = obtener_usuarios();
?>
<?php
// session_start();  //Página protegida: solo se ve si hay una sesión activa ($_SESSION['documento']), muestra el saludo al usuario logueado.
// if (!isset($_SESSION['documento'])) {
//     header('Location: index.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>
<body>
    <h1>Bienvenido, usuario <?php echo htmlspecialchars($_SESSION['documento']); ?></h1>
    <p>Has iniciado sesión con éxito. ╰(*°▽°*)╯</p>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <a href="../form/formUsuarios.php">Nuevo usuario✍️(◔◡◔)</a>
    <table>
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>idUsuario</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($user = mysqli_fetch_assoc($usuarios)) {

                ?>
                    <tr>
                        <td><?php echo $user["documento"]; ?></td>
                        <td><?php echo $user["nombre"]; ?></td>
                        <td><?php echo $user["apellido"]; ?></td>
                        <td><?php echo $user["email"]; ?></td>
                        <td><?php echo $user["telefono"]; ?></td>
                        <td><?php echo $user["idUsuario"]; ?></td>
                        <td>
                        <a href="../includes/users/delete.php?id=<?php echo $user ['idUsuario'];?>" onclick="return confirm('Estás seguro que deseas eliminar este usuario?')">Eliminar ┗|｀O′|┛</a>
                        <a href="../includes/users/update.php?id=<?php echo $user ['idUsuario'];?>">Actualizar (╹ڡ╹ )</a>
                        </td>                 
                    </tr>
                <?php
                }
                ?>
        </tbody>
    </table>

    <a href="dashboard.php">Volver al panel principal 👈(ﾟヮﾟ👈)</a>
</body>
</html>