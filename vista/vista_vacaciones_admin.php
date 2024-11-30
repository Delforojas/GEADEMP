<?php
    include '../config.php'; // Incluir el archivo de configuración
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
     include('../controlador/validar_admin.php');
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/principal.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/estilosmenudesplegable.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/vistavacaciones.css">

    <title>Gestión de Vacaciones - Administrador</title>
    
</head>
<body>
   
    <h1 class="titulo-vacaciones"id="h1p">AREA DE ADMINISTRRADORES</h1>
    <header>
        <div id="daohang">
            <button><a href="<?php echo $base_url; ?>/Administradores">Volver</a></button>
        </div>
    </header>
    <div class="contenido-include">
    <?php
    include("../controlador/controlador_gestion_vacaciones.php");
    ?>
    </div>
    <script src="<?php echo $base_url; ?>/assets/js/javascript.js"></script>
</body>
</html>