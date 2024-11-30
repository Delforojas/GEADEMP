<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");
include("../config.php");

$idUsuario = $_SESSION['idUsuario'] ?? null;

if (!$idUsuario) {
    header("Location: " . $base_url . "/Login");
    exit();
}

$enlace = obtenerConexion();
$vacaciones = new Vacaciones();


// Obtener días solicitados
$totalDiasSolicitados = $vacaciones->totalDiasSolicitados1($enlace, $idUsuario);

// Calcular días restantes
$diasTotales = 30;
$diasRestantes = $diasTotales - $totalDiasSolicitados;
$_SESSION['diasRestantes'] = $diasRestantes;

// Procesar solicitud de vacaciones
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['solicitar_vacaciones'])) {
    $fecha_inicio = $_POST['fecha_inicio'] ?? null;
    $fecha_fin = $_POST['fecha_fin'] ?? null;

    if (!$fecha_inicio || !$fecha_fin || strtotime($fecha_inicio) > strtotime($fecha_fin)) {
        echo "<script>alert('Fechas de solicitud no válidas.');</script>";
        echo "<script>window.location.href = '" . $base_url . "/SolicitarVacaciones';</script>";
        exit();
    }

    $diasSolicitados = $vacaciones->calcularDiasSolicitados($fecha_inicio, $fecha_fin);

    if ($diasRestantes <= 0 || $diasSolicitados > $diasRestantes) {
        echo "<script>alert('No tienes días suficientes. Días restantes: {$diasRestantes}.');</script>";
        echo "<script>window.location.href = '" . $base_url . "/SolicitarVacaciones';</script>";
        exit();
    }

    $idVacaciones = $vacaciones->insertarVacaciones($enlace, $fecha_inicio, $fecha_fin, $diasSolicitados);

    if ($idVacaciones && $vacaciones->VacacionesUsuario($enlace, $idUsuario, $idVacaciones)) {
        $_SESSION['diasRestantes'] -= $diasSolicitados;
        echo "<script>alert('Solicitud de vacaciones enviada con éxito.');</script>";
    } else {
        echo "<script>alert('Error al procesar la solicitud.');</script>";
    }

    echo "<script>window.location.href = '" . $base_url . "/Vacaciones';</script>";;
    exit();
}
?>