<?php
require_once("../modelo/modelo.php");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$enlace = obtenerConexion(); // Mantener la conexión en el controlador
$vacaciones = new Vacaciones(); // Crear instancia de la clase Vacaciones

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idVacaciones = htmlspecialchars($_POST['idVacaciones']);

    $diasSolicitados = $vacaciones->obtenerDiasSolicitados1($enlace,$idVacaciones);
    $idUsuario = $vacaciones->obtenerIdUsuarioPorVacaciones($enlace,$idVacaciones);
    $diasTotales = $vacaciones->obtenerDiasTotalesUsuario($enlace,$idUsuario);

    if (isset($_POST['aprobar'])) {
        $nuevosDiasTotales = $diasTotales - $diasSolicitados;

        if ($nuevosDiasTotales < 0) {
            echo '<script>
                    alert("No puedes aprobar esta solicitud porque te quedarías sin días disponibles.");
                    window.location.href = "../vista/vista_vacaciones_admin.php";
                  </script>';
            exit();
        }

        $vacaciones->actualizarDiasTotales($enlace,$idUsuario, $nuevosDiasTotales);
        $vacaciones->actualizarEstadoSolicitud($enlace,$idVacaciones, 2); // Estado 2: Aprobada
    } elseif (isset($_POST['rechazar'])) {
        $vacaciones->actualizarEstadoSolicitud($enlace, $idVacaciones, 3); // Estado 3: Rechazada
    }

    header('Location: ../vista/vista_vacaciones_admin.php');
    exit();
}
?>
