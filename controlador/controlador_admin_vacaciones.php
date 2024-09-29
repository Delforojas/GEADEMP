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

    
    $vacacion = $vacaciones->obtenerDatosVacacion1($enlace, $vacacion_id);

    if ($vacacion) {
        $usuario_id = $vacacion['usuario_id'];
        $dias_solicitados = $vacacion['dias_solicitados'];

        if ($accion === 'aprobar') {
           
            $dias_vacaciones = $vacaciones->obtenerDiasVacacionesUsuario($enlace, $usuario_id);

        
            $dias_restantes = $dias_vacaciones - $dias_solicitados;

            $vacaciones->actualizarDiasVacaciones($enlace, $usuario_id, $dias_restantes);

           
            $estado = 'aprobado';
        } elseif ($accion === 'rechazar') {
            $estado = 'rechazado';
        }

        if ($vacaciones->actualizarEstadoVacacion($enlace, $vacacion_id, $estado)) {
            echo "Solicitud de vacaciones actualizada correctamente.";
        } else {
            echo "Error al actualizar la solicitud.";
        }

    } else {
        echo "No se encontró la solicitud de vacaciones.";
    }

} else {
    echo "No se recibieron todos los datos necesarios.";
}


mysqli_close($enlace);

header("Location: ../vista/vista_vacaciones_admin.php");
exit();
?>
