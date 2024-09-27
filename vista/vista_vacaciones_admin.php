<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo1.css">
    <title>Gestión de Vacaciones - Administrador</title>
    <?php
         include('../controlador/validar_admin.php');
    ?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            margin: 5px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <form action="vista_bolsa_admin.php"> <!-- Evita el envío del formulario -->
            <button id=""class="btn-volver">Volver</button>
    </form>
    <h1>Solicitudes de Vacaciones Pendientes</h1>

    <?php
         include('../controlador/controlador_solicitudes_pendientes.php');
    ?>
</body>
</html>