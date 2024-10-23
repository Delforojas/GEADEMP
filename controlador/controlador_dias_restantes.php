<?php
require_once("../modelo/modelo.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Crear un objeto Vacaciones
$vacaciones = new Vacaciones();

// Obtener conexión a la base de datos
$enlace = obtenerConexion(); 

// Llamar a la función para obtener las vacaciones del usuario
$vacaciones_data = $vacaciones->obtenerVacacionesPorUsuario($enlace, $usuario_id);

// Obtener días de vacaciones disponibles
$dias_vacaciones = $vacaciones->obtenerDiasVacacionesUsuario($enlace, $usuario_id);

// Inicializar días solicitados
$dias_solicitados = 0; 

// Si hay datos de vacaciones, obtener los días solicitados
if (!empty($vacaciones_data) && is_array($vacaciones_data)) {
    // Sumar todos los días solicitados de las solicitudes de vacaciones que estén aprobadas
    foreach ($vacaciones_data as $vacacion) {
        if (isset($vacacion['estado']) && $vacacion['estado'] === 'aprobado') { // Verificar si la solicitud está aprobada
            $dias_solicitados += $vacacion['dias_solicitados']; // Sumar días solicitados solo si están aprobados
        }
    }
}

// Calcular días restantes
$dias_restantes = 30 - $dias_solicitados;

// Mostrar la información de días restantes
$vacaciones->mostrarDiasRestantes($dias_restantes);

mysqli_close($enlace);
?>


