<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo1.css">

    <title>Bolsa Administradores</title>
    <?php
        session_start(); // Inicia la sesión
        // Verifica si el usuario ha iniciado sesión
        if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Redirige si no hay sesión
        exit(); // Detiene la ejecución después de redirigir
        }
        $usuario = $_SESSION['username']; // Obtiene el nombre del usuario de la sesión
        // Si ha iniciado sesión, muestra el mensaje de bienvenida
        echo "<div id='contenedor-bienvenida'>
                    <img src='imagenes/logo.png' alt='Imagen de bienvenida' id='imagen-bienvenida'>
                    <p id='bienve'>Bienvenido, $usuario   </p>
                    <form action='../controlador/salir.php' method='post'>
                        <button type='submit' class='btn-salir'>Salir</button>
                    </form>
                </div>"
        ?>
        
    
</head>
<body>
  <div>
    <?php include('../controlador/bolsa_general.php');?>
  </div>
</body>