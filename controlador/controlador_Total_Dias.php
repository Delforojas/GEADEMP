<?php

require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$idUsuario = $_SESSION['idUsuario'] ?? null;

if (!$idUsuario) {
    header("Location: login.php");
    exit();
}


$vacaciones = new Vacaciones();

// Obtener información de vacaciones del usuario
$datosVacaciones = $vacaciones->obtenerVacacionesPorUsuario($enlace, $idUsuario);

// Extraer las variables para usarlas en la vista
$diasTotales =30;
$diasSolicitados = $datosVacaciones['diasSolicitados'];
$diasRestantes = $diasTotales - $diasSolicitados;

// Cerrar la conexión
mysqli_close($enlace);

// Imprimir el contenido directamente en la vista
echo '<p>Días Totales de Vacaciones: ' . htmlspecialchars($diasTotales) . '</p>';
echo '<p>Días Solicitados: ' . htmlspecialchars($diasSolicitados) . '</p>';
echo '<p>Días Restantes: ' . htmlspecialchars($diasRestantes) . '</p>';
