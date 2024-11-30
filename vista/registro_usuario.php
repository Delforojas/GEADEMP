<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include '../config.php';
include '../controlador/validar_usuario.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/principal.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/formularios.css">
    
    <title>Registro de Usuario</title>

</head>
<body>
    <h2 class="titulo-vacaciones" id="h1p">Registrar Usuario</h2>
    <header>
        <div id="daohang">
            <button><a href="<?php echo $base_url; ?>/Administradores">Volver a principal</a></button>
        </div>
    </header>
    <div class="contenedor">
        <div class="card-form">
            <form action="<?php echo $base_url; ?>/controlador/controladorregistro.php" method="POST" class="signup">
                <div class="form-title">Introduzca los datos del usuario</div>
                <div class="form-body">
                    <div class="row">
                        <input type="text" placeholder="Nombre*" name="nombre">
                    </div>
                    <div class="row">
                        <input type="text" placeholder="Apellidos*" name="apellidos">
                    </div>
                    <div class="row">
                        <input type="text" placeholder="Contraseña*" name="clave">
                    </div>
                </div>
                <div class="rule"></div>
                <div class="form-footer">
                    <button type="submit" value="Registrar" name="registro">Registrar</button>
                </div>
            </form>
          </div>

        <script src="<?php echo $base_url; ?>/assets/js/javascript.js"></script>
    
    <br>
</body>
</html>
