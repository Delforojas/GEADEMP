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
    <h1>Solicitudes de Vacaciones Pendientes</h1>

    <?php
    // Conectar a la base de datos e incluir el archivo con la conexión
    require_once("../modelo/datos_conexion.php");
    require_once("../modelo/modelo.php");

    // Obtener la conexión a la base de datos
    $enlace = obtenerConexion();

    // Verificar si la conexión fue exitosa
    if (!$enlace) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Consulta para obtener todas las solicitudes pendientes
    $consulta = "SELECT * FROM vacaciones WHERE estado = 'pendiente';";
    $resultado = mysqli_query($enlace, $consulta);

    // Verificar si hay solicitudes pendientes
    if (mysqli_num_rows($resultado) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Usuario ID</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de fin</th>
                    <th>Días solicitados</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($solicitud = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo $solicitud['usuario_id']; ?></td>
                        <td><?php echo $solicitud['fecha_inicio']; ?></td>
                        <td><?php echo $solicitud['fecha_fin']; ?></td>
                        <td><?php echo $solicitud['dias_solicitados']; ?></td>
                        <td><?php echo $solicitud['estado']; ?></td>
                        <td>
                            <form action="../controlador/controlador_admin_vacaciones.php" method="POST">
                                <input type="hidden" name="vacacion_id" value="<?php echo $solicitud['id']; ?>">
                                <button type="submit" name="accion" value="aprobar">Aprobar</button>
                                <button type="submit" name="accion" value="rechazar">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay solicitudes pendientes.</p>
    <?php endif;

    // Cerrar la conexión a la base de datos
    mysqli_close($enlace);
    ?>
</body>
</html>