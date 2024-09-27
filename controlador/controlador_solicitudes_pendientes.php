<?php
// Incluir la conexión a la base de datos y el modelo
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$enlace = obtenerConexion(); // Obtener la conexión a la base de datos

$vacaciones = new Vacaciones();

$solicitudes_pendientes = $vacaciones->obtenerSolicitudesPendientes($enlace);

$vacaciones->mostrarSolicitudesPendientes($enlace);

// Cerrar la conexión a la base de datos
mysqli_close($enlace);
?>