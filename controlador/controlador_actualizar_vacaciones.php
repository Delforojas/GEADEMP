<?php
require_once("../modelo/modelo.php");


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



$enlace = obtenerConexion(); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $vacacion_id = $_POST['vacacion_id'];
    $dias_solicitados = $_POST['dias_solicitados']; 

    $vacaciones = new Vacaciones();

    $resultado = $vacaciones->manejarSolicitudVacaciones($enlace, $accion, $vacacion_id, $usuario_id, $dias_solicitados);

    
    echo $resultado;

    $dias_disponibles = $vacaciones->obtenerDiasVacacionesDisponibles($enlace, $usuario_id);
    echo "Días de vacaciones disponibles: " . htmlspecialchars($dias_disponibles) . "<br>";
}
?>

