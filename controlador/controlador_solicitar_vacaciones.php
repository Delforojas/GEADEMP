<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Depuración: imprimir el contenido de la sesión
print_r($_SESSION);

// Verificar si se ha enviado el formulario de solicitud de vacaciones
if (isset($_POST['solicitar_vacaciones'])) {
    // Verificar si el ID del usuario está en la sesión
    if (isset($_SESSION['id'])) {
        $usuario_id = $_SESSION['id'];  // Asegúrate de usar el ID del usuario, no el nombre
        echo "ID de usuario en sesión: $usuario_id";
    } else {
        echo "Error: No se ha encontrado el ID del usuario en la sesión.";
        exit();
    }

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