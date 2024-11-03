<?php
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();

// Verificar si se ha enviado una solicitud de aprobación o rechazo
if (isset($_POST['aprobar']) || isset($_POST['rechazar'])) {
    $idVacaciones = $_POST['idVacaciones'];
    $nuevoEstado = isset($_POST['aprobar']) ? "Aceptada" : "Rechazada";

    // Actualizar el estado de la solicitud en la tabla `solicitud`
    $query = "UPDATE solicitud SET estado = ? WHERE idSolicitud = (SELECT idSolicitud FROM vacaciones WHERE idVacaciones = ?)";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("si", $nuevoEstado, $idVacaciones);

    if ($stmt->execute()) {
        // Después de actualizar el estado, elimina el registro de la tabla `vacaciones`
        $deleteQuery = "DELETE FROM vacaciones WHERE idVacaciones = ?";
        $stmtDelete = $enlace->prepare($deleteQuery);
        $stmtDelete->bind_param("i", $idVacaciones);

        if ($stmtDelete->execute()) {
            $_SESSION['mensaje'] = "Solicitud procesada y eliminada exitosamente.";
        } else {
            $_SESSION['mensaje_error'] = "Error al eliminar el registro de vacaciones.";
        }
        $stmtDelete->close();
    } else {
        $_SESSION['mensaje_error'] = "Error al actualizar el estado de la solicitud.";
    }

    $stmt->close();
    mysqli_close($enlace);

    // Redirige de vuelta a la vista
    header("Location: ../vista/vista_vacaciones_admin.php");
    exit();
}

// Si no se ha procesado una solicitud, cargar las solicitudes pendientes
$query = "
    SELECT v.idVacaciones, u.nombre, u.apellidos, v.fecha_inicio, v.fecha_fin, v.diasSolicitados, s.estado, s.idSolicitud
    FROM vacaciones v
    JOIN usuariovacaciones uv ON v.idVacaciones = uv.idVacaciones
    JOIN usuario u ON uv.idUsuario = u.idUsuario
    JOIN solicitud s ON v.idSolicitud = s.idSolicitud
    WHERE s.estado = 'pendiente'";
$resultado = $enlace->query($query);
$solicitudes = $resultado->fetch_all(MYSQLI_ASSOC);

mysqli_close($enlace);

// Mostrar mensaje de éxito o error si existe
if (isset($_SESSION['mensaje'])) {
    echo "<p>" . htmlspecialchars($_SESSION['mensaje']) . "</p>";
    unset($_SESSION['mensaje']);
}
?>

<?php if (!empty($solicitudes)): ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID de Vacaciones</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Días Solicitados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?= htmlspecialchars($solicitud['idVacaciones']) ?></td>
                    <td><?= htmlspecialchars($solicitud['nombre']) ?></td>
                    <td><?= htmlspecialchars($solicitud['apellidos']) ?></td>
                    <td><?= htmlspecialchars($solicitud['fecha_inicio']) ?></td>
                    <td><?= htmlspecialchars($solicitud['fecha_fin']) ?></td>
                    <td><?= htmlspecialchars($solicitud['diasSolicitados']) ?></td>
                    <td>
                        <form action="../controlador/aprobar_rechazar_vacaciones.php" method="post">
                            <input type="hidden" name="idVacaciones" value="<?= htmlspecialchars($solicitud['idVacaciones']) ?>">
                            <button type="submit" name="aprobar">Aprobar</button>
                            <button type="submit" name="rechazar">Rechazar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay solicitudes de vacaciones pendientes.</p>
<?php endif; ?>
