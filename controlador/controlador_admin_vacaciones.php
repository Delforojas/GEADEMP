<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    echo "Acceso denegado. Debes ser administrador para realizar esta acción.";
    exit();
}

require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();

if (isset($_POST['vacacion_id']) && isset($_POST['accion'])) {
    $vacacion_id = $_POST['vacacion_id'];
    $accion = $_POST['accion'];

    $vacaciones = new Vacaciones();

    // Obtener los datos de la solicitud de vacaciones
    $vacacion = $vacaciones->obtenerDatosVacaciones($enlace, $vacacion_id);

    if ($vacacion) {
        $usuario_id = $vacacion['usuario_id'];
        $dias_solicitados = $vacacion['dias_solicitados'];

        if ($accion === 'aprobar') {
            // Obtener los días de vacaciones disponibles del usuario
            $dias_vacaciones = $vacaciones->obtenerDiasVacacionesUsuario($enlace, $usuario_id);
            $dias_restantes = $dias_vacaciones - $dias_solicitados;

            // Comprobar si hay suficientes días disponibles
            if ($dias_restantes >= 0) {
                // Actualizar los días de vacaciones
                $vacaciones->actualizarDiasVacaciones($enlace, $usuario_id, $dias_solicitados); // Resta los días solicitados

                // Cambiar el estado de la solicitud a 'aprobado'
                $estado = 'aprobado';
            } else {
                echo "<script>alert('No puedes aprobar la solicitud porque no hay suficientes días de vacaciones disponibles.'); window.location.href='../vista/vista_vacaciones_admin.php';</script>";
                exit();
            }
        } elseif ($accion === 'rechazar') {
            // Eliminar la solicitud de vacaciones
            $consulta = "DELETE FROM vacaciones WHERE id = ?";
            $stmt = $enlace->prepare($consulta);
            $stmt->bind_param('i', $vacacion_id);
            $stmt->execute();
            $stmt->close();

            // Cambiar el estado a 'rechazado'
            $estado = 'rechazado';
        }

        // Actualizar el estado de la solicitud en la base de datos
        if ($accion === 'aprobar' || $accion === 'rechazar') {
            if ($accion === 'aprobar') {
                // Actualizar el estado a 'aprobado'
                $vacaciones->actualizarEstadoVacacion($enlace, $vacacion_id, $estado);
            } else {
                // Si fue rechazada, actualizar el estado a 'rechazado'
                $vacaciones->actualizarEstadoVacacion($enlace, $vacacion_id, $estado);
            }

            echo "Solicitud de vacaciones actualizada correctamente.";
        }
    } else {
        echo "No se encontró la solicitud de vacaciones.";
    }
} else {
    echo "No se recibieron todos los datos necesarios.";
}

mysqli_close($enlace);

// Redirigir a la vista de vacaciones admin
header("Location: ../vista/vista_vacaciones_admin.php");
exit();
?>