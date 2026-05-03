<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css2.css">
    <link rel="stylesheet" href="../css/css5.css">
    <link rel="stylesheet" href="../css/estilosmenudesplegable.css">
    <title>Registro de Usuario</title>

    <?php
         include('../controlador/validar_admin.php');
    ?>
</head>

<h2 class="titulo-vacaciones"id="h1p">Registrar Usuario</h2>
<header>
                            <div id="daohang">
                                <button><a href="vista_bolsa_admin.php">Volver a principal</a></button>
                            </div>
</header>
<body >
<div class="contenedor">
<div class="card-form">
  <form action="../controlador/controladorregistro.php" method="POST"class="signup">
    <div class="form-title">Introduzca los datos del usuario</div>
    <div class="form-body">
      <div class="row">
        <input type="text" placeholder="Nombre*"  name="nombre" id="Nombres">
      </div>
      <div class="row">
        <input type="text" placeholder="Apellids*"name="apellidos" id="apellidos">
      </div>
      <div class="row">
        <input type="text" placeholder="Contraseña*" name="clave" id="Contraseña">
      </div>
    </div>
    <div class="rule"></div>
    <div class="form-footer">
      <button type="submit" id="cerrarVentana" value="Registrar" name="registro">Registrar</button>
      <button type="button" id="enviarYCerrar" onclick="location.href='vista_bolsa_admin.php';">Volver</button>
    </div>
  </form>
</div>
</div>
<script src="../vista/javascript.js"></script>
</body>
