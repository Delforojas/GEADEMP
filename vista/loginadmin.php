<?php
    // Activar reporte de errores para depuración
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    include '../config.php'; // Incluir el archivo de configuración
    include("../modelo/datos_conexion.php");
    include("../controlador/controladorlogin.php");
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/login1.css">
    <title>Login</title>
</head>

<body>
            

<div >  
    <h1 class="titulo-vaca">ACCESO DENEGADO <br>No tienes permiso para entrar en este area</h1>
  <form action="<?php echo $base_url; ?>/controlador/controladorlogin.php" method="POST"class="signup">
    <h1 >Iniciar Sesion <br> Administrador </h3>
        <input type="text" placeholder="Introduzca matricula*"  name="usuario" id="usuario"  required>
        <input type="text" placeholder="Introduzca su contraseña administrador*" name="clave" id="clave" required>
        <button type="submit" id="cerrarVentana" value="Iniciar sesion"name="btningresar">Iniciar sesión</button>
 
  </form>
</div>

<script src="<?php echo $base_url; ?>/assets/js/app.js"></script>

</body>