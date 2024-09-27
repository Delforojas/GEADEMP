<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    echo "Debes iniciar sesión para ver tus vacaciones.";
    exit();
}

// Incluir la conexión a la base de datos
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

$usuario_id = $_SESSION['usuario_id'];

$vacaciones = new Vacaciones();

$tablaVacaciones = $vacaciones->obtenerVacaciones($enlace, $usuario_id);

mysqli_close($enlace);

echo $tablaVacaciones;
?>