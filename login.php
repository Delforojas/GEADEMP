<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login1.css">
    <title>Login</title>
</head>

<body>
    <?php
        include '../config.php';
        include("modelo/datos_conexion.php");
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    ?>

    <img src="assets/imagenes/geademp.png" class="logo">

    <div>
        <form action="controlador/controladorlogin.php" method="POST" class="signup">
            <h1>Iniciar Sesión</h1>
            <input type="text" placeholder="Introduzca matrícula*" name="usuario" id="usuario" required>
            <input type="password" placeholder="Introduzca su contraseña*" name="clave" id="clave" required>
            <button type="submit" id="cerrarVentana" value="Iniciar sesión" name="btningresar">Iniciar sesión</button>
        </form>
    </div>

</body>
</html>
