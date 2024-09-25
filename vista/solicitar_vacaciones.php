<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Vacaciones</title>
</head>
<body>
    <h1>Solicitar Vacaciones</h1>

    <form action="../controlador/controlador_solicitar_vacaciones.php" method="POST">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" required>
        
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" required>
        
        <label for="dias_solicitados">Total dias :</label>
       
        
        
        <button type="submit" name="solicitar_vacaciones">Solicitar Vacaciones</button>
    </form>
</body>
</html>