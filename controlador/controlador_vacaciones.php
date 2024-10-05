<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la conexión a la base de datos
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

$usuario_id = $_SESSION['usermame'];

$vacaciones = new Vacaciones();

$tablaVacaciones = $vacaciones->obtenerVacaciones($enlace, $usuario_id);

mysqli_close($enlace);

echo $tablaVacaciones;
?>