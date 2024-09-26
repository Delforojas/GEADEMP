<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo1.css">
    <title>Vacaciones del Usuario</title>
    <?php
         include('../controlador/validar_usuario.php');
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
    </style>
</head>
<body>
    <h1>Vacaciones solicitadas</h1>

    <!-- Mostrar la tabla de vacaciones generada por el controlador -->
    <?php include("../controlador/controlador_vacaciones.php") ?>

    <!-- Incluir el controlador para obtener el total de días de vacaciones -->
    <h2>Total de días de vacaciones disponibles: 
    <?php 
if (isset($_SESSION['username'])) {
    $usuario = $_SESSION['username'];
} else {
    $usuario = "Usuario";  // Por defecto, si no está en la sesión
}

$dias_totales = include("../controlador/controlador_total_dias.php");
echo "$usuario, te quedan $dias_totales días de vacaciones.";
?>
    </h2>

</body>
</html>
