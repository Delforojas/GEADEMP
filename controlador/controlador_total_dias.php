<?php
require_once("../modelo/modelo.php");

// Verificar si la sesión no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$vacaciones = new Vacaciones();


$vacaciones_data = $vacaciones->obtenerVacacionesPorUsuario($enlace, $usuario_id);

$vacaciones->mostrarVacaciones($vacaciones_data);
?>