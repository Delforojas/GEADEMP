<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>
                <?php
                    include("../modelo/datos_conexion.php");
                    include("../controlador/controladorlogin.php");
                ?>
   

<div >  
    <h1 class="tituloadmin">ACCESO DENEGADO <br>No tienes permiso para entrar en este area</h1>
  <form action="../controlador/controladorlogin.php" method="POST"class="signup">
    <h1 >Iniciar Sesion <br> Administrador </h3>
        <input type="text" placeholder="Introduzca matricula*"  name="usuario" id="usuario"  required>
        <input type="text" placeholder="Introduzca su contraseña administrador*" name="clave" id="clave" required>
        <button type="submit" id="cerrarVentana" value="Iniciar sesion"name="btningresar">Iniciar sesión</button>
 
  </form>
</div>

<script src="app.js"></script>

</body>