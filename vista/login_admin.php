<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir Font Awesome para los iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="login-content">
            <form method="post" action="">
                <h2 class="title text-center">Bienvenido</h2>

                <div class="i text-center">
                    <i class="fas fa-user fa-3x"></i> <!-- Ícono del usuario -->
                </div>

                <?php
                    include("../modelo/datos_conexion.php");
                    include("../controlador/controladoradmin.php");
                ?>

                <div class="mb-3">
                    <h5>Usuario</h5>
                    <input id="usuario" type="text" class="form-control" name="usuario">
                </div>

                <div class="mb-3">
                    <h5>Contraseña</h5>
                    <input id="clave" type="password" class="form-control" name="clave">
                </div>

                <div class="text-center">
                    <input name="btningresar" type="submit" class="btn btn-primary" value="INICIAR SESIÓN">

                
                </div>
            </form>        
        </div>
        