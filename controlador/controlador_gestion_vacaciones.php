<?php
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();

// Verificar si se ha enviado una solicitud de aprobación o rechazo
if (isset($_POST['aprobar']) || isset($_POST['rechazar'])) {
    $idVacaciones = $_POST['idVacaciones'];
    $nuevoEstado = isset($_POST['aprobar']) ? "Aceptada" : "Rechazada";

    // Actualizar el estado de la solicitud en la tabla `solicitud`
    actualizarSolicitud($enlace, $nuevoEstado, $idVacaciones);

    // Después de actualizar el estado, eliminar el registro de la tabla `vacaciones`
    eliminarVacaciones($enlace, $idVacaciones);

    if (isset($_SESSION['mensaje'])) {
        $_SESSION['mensaje'] = "Solicitud procesada y eliminada exitosamente.";
    } else {
        $_SESSION['mensaje_error'] = "Error al procesar la solicitud.";
    }

    mysqli_close($enlace);

    // Redirige de vuelta a la vista
    header("Location: ../vista/vista_vacaciones_admin.php");
    exit();
}

// Si no se ha procesado una solicitud, cargar las solicitudes pendientes
$solicitudes = SolicitudesPendientes($enlace);

mysqli_close($enlace);

// Mostrar mensaje de éxito o error si existe
if (isset($_SESSION['mensaje'])) {
    echo "<p>" . htmlspecialchars($_SESSION['mensaje']) . "</p>";
    unset($_SESSION['mensaje']);
}

// Mostrar la tabla de solicitudes pendientes
tablaSolicitudesPendientes($solicitudes);
?>