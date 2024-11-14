<?php
require_once("../modelo/modelo.php");

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$enlace = obtenerConexion();
$vacaciones = new Vacaciones();

// Verificar si se ha enviado una solicitud de aprobación o rechazo
if (isset($_POST['aprobar']) || isset($_POST['rechazar'])) {
    $idVacaciones = $_POST['idVacaciones'];
    $nuevoEstado = isset($_POST['aprobar']) ? "Aceptada" : "Rechazada";

    // Llamar al método actualizarSolicitud de la clase Vacaciones
    if ($vacaciones->actualizarSolicitud($enlace, $idVacaciones, $nuevoEstado)) {
        // Si se actualizó el estado correctamente, eliminar el registro de vacaciones
        if ($vacaciones->eliminarVacaciones($enlace, $idVacaciones)) {
            $_SESSION['mensaje'] = "Solicitud procesada y eliminada exitosamente.";
        } else {
            $_SESSION['mensaje_error'] = "Error al eliminar el registro de vacaciones.";
        }
    } else {
        $_SESSION['mensaje_error'] = "Error al actualizar el estado de la solicitud.";
    }

    // Redirige de vuelta a la vista
    header("Location: ../vista/vista_vacaciones_admin.php");
    exit();
}

// Si no se ha procesado una solicitud, cargar las solicitudes pendientes
$solicitudes = $vacaciones->solicitudesPendientes($enlace);

// Mostrar mensaje de éxito o error si existe
if (isset($_SESSION['mensaje'])) {
    echo "<p>" . htmlspecialchars($_SESSION['mensaje']) . "</p>";
    unset($_SESSION['mensaje']);
} elseif (isset($_SESSION['mensaje_error'])) {
    echo "<p>" . htmlspecialchars($_SESSION['mensaje_error']) . "</p>";
    unset($_SESSION['mensaje_error']);
}

mysqli_close($enlace);
echo $vacaciones->tablaSolicitudes($solicitudes);
?>


