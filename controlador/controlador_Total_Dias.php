<?php

require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php"); // Incluye la clase Vacaciones
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$enlace = obtenerConexion();
$vacaciones = new Vacaciones();


$idUsuario = $_SESSION['idUsuario'] ?? null;


$resultado = $vacaciones->totalDiasSolicitados($enlace, $idUsuario);

if ($resultado) {
    // Calcular los días restantes
    $calculo = $vacaciones->calcularDiasRestantes($resultado);

    if ($calculo) {
        $diasTotales = $calculo['diasTotales'];
        $totalDiasSolicitados = $calculo['diasDisfrutados'];
        $diasRestantes = $calculo['diasRestantes'];

        // Llamar a mostrarDiasVacaciones para generar el HTML
        echo $vacaciones->mostrarDiasVacaciones($diasTotales, $totalDiasSolicitados, $diasRestantes);
    } else {
        echo "Error: No se pudo calcular los días restantes.";
    }
} else {
    echo "Error al realizar la consulta: " . $enlace->error;
}

mysqli_close($enlace);
?>
