<?php
session_start();
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();

// Verificar si se ha enviado una solicitud de aprobación o rechazo
if (isset($_POST['aprobar']) || isset($_POST['rechazar'])) {
    $idSolicitud = $_POST['idSolicitud'];
    $nuevoEstado = isset($_POST['aprobar']) ? "Aceptada" : "Rechazada";

    // Actualizar el estado de la solicitud en la tabla `Solicitud`
    $query = "UPDATE Solicitud SET estado = ? WHERE idSolicitud = ?";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("si", $nuevoEstado, $idSolicitud);

    if ($stmt->execute()) {
        // Después de actualizar, eliminar la solicitud
        $deleteQuery = "DELETE FROM Solicitud WHERE idSolicitud = ?";
        $stmtDelete = $enlace->prepare($deleteQuery);
        $stmtDelete->bind_param("i", $idSolicitud);

        if ($stmtDelete->execute()) {
            $_SESSION['mensaje'] = "Solicitud actualizada y eliminada exitosamente.";
        } else {
            $_SESSION['mensaje_error'] = "Error al eliminar la solicitud.";
        }

        $stmtDelete->close();
    } else {
        $_SESSION['mensaje_error'] = "Error al actualizar la solicitud.";
    }

    $stmt->close();
    mysqli_close($enlace);

    header("Location: ../vista/vista_vacaciones_admin.php");
    exit();
}
?>
