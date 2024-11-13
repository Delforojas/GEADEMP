<?php
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$idUsuario = $_SESSION['idUsuario'] ?? null;

if (!$idUsuario) {
    header("Location: login.php");
    exit();
}

$enlace = obtenerConexion(); // Asegúrate de que la conexión esté disponible

// Inicializa días totales
diasTotales($enlace, $idUsuario);

// Verificar si hay días totales disponibles
if ($diasTotales <= 0) {
    echo '<script>
            alert("No puedes solicitar más vacaciones, ya que no tienes días disponibles.");
          </script>';
    exit();
}

// Inicializa días solicitados
$diasSolicitados = 0;

// Procesar solicitud de vacaciones
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aprobar'])) {
    $idVacaciones = $_POST['idVacaciones'] ?? null; // ID de la solicitud a aprobar

    diasSolicitados($enlace, $idVacaciones);

    // Verificar que los días solicitados no excedan el límite de 30
    if ($diasSolicitados > 30) {
        echo '<script>
                alert("No puedes solicitar más de 30 días de vacaciones.");
                window.location.href = "../vista/vista_vacaciones.php";
              </script>';
        exit();
    }

    // Restar días solicitados de los días totales
    $nuevosDiasTotales = $diasTotales - $diasSolicitados;

    // Verificar que no queden días negativos
    if ($nuevosDiasTotales < 0) {
        echo '<script>
                alert("No puedes aprobar esta solicitud porque no te quedan días disponibles.");
                window.location.href = "../vista/vista_vacaciones.php";
              </script>';
        exit();
    }

    // Actualizar los días totales
    actualizarDiasTotales($enlace, $nuevosDiasTotales, $idUsuario);

    echo '<script>
            alert("Solicitud aprobada. Días totales actualizados.");
            window.location.href = "../vista/vista_vacaciones.php";
          </script>';
}

// Obtener de nuevo los días solicitados para mostrar en la vista
totalDiasSolicitados($enlace, $idUsuario);

// Calcular días restantes
$diasRestantes = $diasTotales - ($diasSolicitados ?? 0); 

// Verificar que los días restantes no sean negativos
if ($diasRestantes <= 0) {
    echo '<script>
            alert("No te quedan más vacaciones para este año.");
          </script>';
    echo '<h1>Días Totales de Vacaciones: ' . htmlspecialchars($diasTotales) . '</h1>';
    echo '<h1>Días Solicitados: ' . htmlspecialchars($diasSolicitados ?? 0) . '</h1>'; // Usar 0 si no hay solicitudes
    echo '<h1>Días Restantes hola: ' . htmlspecialchars($diasRestantes) . '</h1>';
    exit();
}

// Cerrar la conexión
$enlace->close(); // Cerrar la conexión para mysqli

// Imprimir el contenido directamente en la vista
echo '<h1>Días Totales de Vacaciones: ' . htmlspecialchars($diasTotales) . '</h1>';
echo '<h1>Días Solicitados: ' . htmlspecialchars($diasSolicitados ?? 0) . '</h1>'; // Usar 0 si no hay solicitudes
echo '<h1>Días Restantes hola: ' . htmlspecialchars($diasRestantes) . '</h1>';
?>
