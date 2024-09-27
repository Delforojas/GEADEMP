<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se ha enviado el formulario de solicitud de vacaciones
if (isset($_POST['solicitar_vacaciones'])) {
    // Obtener el ID del usuario desde la sesión
    $usuario_id = $_SESSION['usuario_id'];  // ID del usuario en sesión
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Conectar a la base de datos
    require_once("../modelo/datos_conexion.php");
    require_once("../modelo/modelo.php");

    $enlace = obtenerConexion();

    $vacaciones = new Vacaciones();

    $dias_solicitados = $vacaciones->calcularDiasSolicitados($fecha_inicio, $fecha_fin);

    $vacaciones->insertarSolicitudVacaciones($enlace, $usuario_id, $fecha_inicio, $fecha_fin, $dias_solicitados);

}
?>