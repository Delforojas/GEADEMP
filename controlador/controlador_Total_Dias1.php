<?php

require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username']) || !isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener datos del usuario de la sesión
$usuario = $_SESSION['username'];
$idUsuario = $_SESSION['idUsuario'];

$enlace = obtenerConexion();
if (!$enlace) {
    die("Error al conectar a la base de datos.");
}

$vacaciones = new Vacaciones();

// Obtener días totales
$diasTotales = $vacaciones->diasTotales1($enlace, $idUsuario);
if (!$diasTotales) {
    die("Error al obtener los días totales1.");
}

// Verificar si hay días totales disponibles
if ($diasTotales <= 0) {
    echo '<script>alert("No puedes solicitar más vacaciones, ya que no tienes días disponibles.");</script>';
    exit();
}

// Inicializa días solicitados
$diasSolicitados = 0;

// Procesar solicitud de vacaciones
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aprobar'])) {
    $idVacaciones = $_POST['idVacaciones'] ?? null;

    if (!$idVacaciones) {
        die("ID de vacaciones no válido.");
    }

    $diasSolicitados = $vacaciones->diasSolicitados($enlace, $idVacaciones);
    if (!$diasSolicitados) {
        die("Error al obtener los días solicitados2.");
    }

    if ($diasSolicitados > 30) {
        echo '<script>
                alert("No puedes solicitar más de 30 días de vacaciones.");
                window.location.href = "../vista/vista_vacaciones.php";
              </script>';
        exit();
    }

    $nuevosDiasTotales = $diasTotales - $diasSolicitados;

    if ($nuevosDiasTotales < 0) {
        echo '<script>
                alert("No puedes aprobar esta solicitud porque no te quedan días disponibles.");
                window.location.href = "../vista/vista_vacaciones.php";
              </script>';
        exit();
    }

    $vacaciones->actualizarDiasTotales($enlace, $nuevosDiasTotales, $idUsuario);

    echo '<script>
            alert("Solicitud aprobada. Días totales actualizados.");
            window.location.href = "../vista/vista_vacaciones.php";
          </script>';
    exit();
}

// Obtener días solicitados
$diasSolicitados = $vacaciones->totalDiasSolicitados($enlace, $idUsuario);
if (!$diasSolicitados) {
    $diasSolicitados = 0; // Inicializa a 0 si no hay solicitudes
}

// Calcular días restantes
$diasRestantes = $diasTotales - $diasSolicitados;

echo '<pre>';
var_dump($diasTotales, $diasSolicitados, $diasRestantes);
echo '</pre>';

// Imprimir el contenido directamente en la vista
echo '<h1>Días Totales de Vacaciones: ' . htmlspecialchars($diasTotales) . '</h1>';
echo '<h1>Días Solicitados: ' . htmlspecialchars($diasSolicitados) . '</h1>';
echo '<h1>Días Restantes: ' . htmlspecialchars($diasRestantes) . '</h1>';

$enlace->close();
?>
