<?php
session_start();
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

if ($enlace->connect_error) {
    die("Conexión fallida: " . $enlace->connect_error);
}

// Consulta para obtener la suma de los días solicitados aprobados
$query = "SELECT SUM(diasSolicitados) AS totalDiasSolicitados FROM vacaciones WHERE idSolicitud = 2";
$resultado = $enlace->query($query);

if ($resultado) {
    $fila = $resultado->fetch_assoc();
    $totalDiasSolicitados = $fila['totalDiasSolicitados'] ?? 0;

    // Restar los días solicitados al total de 30 días disponibles
    $diasTotales = 30;
    $diasRestantes = $diasTotales - $totalDiasSolicitados;

    // Mostrar los días restantes
    echo "<p>Días Totales de Vacaciones: " . htmlspecialchars($diasTotales) . "</p>";
    echo "<p>Días Disfrutados: " . htmlspecialchars($totalDiasSolicitados) . "</p>";
    echo "<p>Días Restantes: " . htmlspecialchars($diasRestantes) . "</p>";
} else {
    echo "Error al realizar la consulta: " . $enlace->error;
}

mysqli_close($enlace);

// Redirigir a la vista para mostrar los resultados
header("Location: ../vista/vista_vacaciones.php");
exit();
?>
