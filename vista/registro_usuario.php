<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/estilo1.css">
    <title>Registro de Usuario</title>
    <?php
         include('../controlador/validar_admin.php');
    ?>
 
</head>
<body>
<h2 class=btn-volver>Registrar</h2>

<div >
            <form action="../controlador/controladorregistro.php" method="POST" >
                <?php
                include("../controlador/controladorregistro.php");
                ?>
                        <label for="Nombres">Nombres:</label>
                        <input type="text" name="nombre" id="Nombres">

                        <label for="Usuario">Usuario:</label>
                        <input type="text" name="usuario" id="Usuario">

                        <label for="Contraseña">Contraseña:</label>
                        <input type="text" name="clave" id="Contraseña">

                        <input class="boton" type="submit"id="cerrarVentana" value="Registrar"class="btn-volver" name="registro">
                        <a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>

            </form>
</div>
</body>