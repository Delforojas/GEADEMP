
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css2.css">
    <link rel="stylesheet" href="../css/estilosmenudesplegable.css">
    <title>Gestión de Vacaciones - Administrador</title>
    <?php
         include('../controlador/validar_admin.php');
    ?>
   
</head>
<body>
   
    <h1 class="titulo-vacaciones"id="h1p">Solicitud de Vacaciones Pendientes</h1>
    <header>
        <div id="daohang">
            <button><a href="vista_bolsa_admin.php">Volver</a></button>
        </div>
    </header>

    <?php
    include('../controlador/aprobacion_vacaciones.php'); 
    ?>
    <script src="../vista/javascript.js"></script>
</body>
</html>