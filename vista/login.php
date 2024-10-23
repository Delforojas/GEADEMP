<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css6.css">
    <title>Login</title>
</head>

<body>
                <?php
                    include("../modelo/datos_conexion.php");
                    include("../controlador/controladorlogin.php");
                ?>
<div class="card-form">
  <form action="../controlador/controladorlogin.php" method="POST"class="signup">
    <div class="form-title">Iniciar Sesion</div>
    <div class="form-body">
      <div class="row">
        <input type="text" placeholder="Introduzca Usuario*"  name="usuario" id="usuario"  required>
      </div>
      <div class="row">
        <input type="text" placeholder="Introduzca su contraseña*" name="clave" id="Contraseña" required>
      </div>
    </div>
    <div class="rule"></div>
    <div class="form-footer">
        <button type="submit" id="cerrarVentana" value="Iniciar sesion" name="btningresar">Iniciar sesión</button>
    </div>
  </form>
</div>

</body>
                
        