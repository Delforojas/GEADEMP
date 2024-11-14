
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css2.css">
    <link rel="stylesheet" href="../css/estilosmenudesplegable.css">
    <link rel="stylesheet" href="../assets/css/vistavacaciones.css">

    <title>Gestión de Vacaciones - Administrador</title>
    <?php
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
         include('../controlador/validar_admin.php');
    ?>
   
</head>
<body>
   
    <h1 class="titulo-vacaciones"id="h1p">AREA DE ADMINISTRRADORES</h1>
    <header>
        <div id="daohang">
            <button><a href="vista_bolsa_admin.php">Volver</a></button>
        </div>
    </header>
    <div class="contenido-include">
    <?php
    include('../controlador/controlador_gestion_vacaciones.php'); 
    ?>
    </div>
    <script src="../vista/javascript.js"></script>
</body>
</html>