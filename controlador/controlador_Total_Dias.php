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
$diasTotales = 30; // Establecido en 30, según la información proporcionada

// Obtener días totales de vacaciones de la base de datos (si es necesario)
$sqlTotales = "SELECT v.diasTotales 
               FROM Usuariovacaciones uv 
               JOIN vacaciones v ON uv.idVacaciones = v.idVacaciones 
               WHERE uv.idUsuario = ?";

$stmtTotales = $enlace->prepare($sqlTotales);
$stmtTotales->bind_param("i", $idUsuario);
$stmtTotales->execute();
$stmtTotales->bind_result($diasTotalesDB);
$stmtTotales->fetch();
$stmtTotales->close();



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

    // Obtener días solicitados
    $sqlSolicitados = "SELECT diasSolicitados 
                       FROM vacaciones 
                       WHERE idVacaciones = ?";
    $stmtSolicitados = $enlace->prepare($sqlSolicitados);
    $stmtSolicitados->bind_param("i", $idVacaciones);
    $stmtSolicitados->execute();
    $stmtSolicitados->bind_result($diasSolicitados);
    $stmtSolicitados->fetch();
    $stmtSolicitados->close();

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
                window.location.href = "../vista/vacaciones.php";
              </script>';
        exit();
    }

    // Actualizar los días totales
    $sqlActualizar = "UPDATE vacaciones 
                      SET diasTotales = ? 
                      WHERE idUsuario = ?";
    $stmtActualizar = $enlace->prepare($sqlActualizar);
    $stmtActualizar->bind_param("ii", $nuevosDiasTotales, $idUsuario);
    $stmtActualizar->execute();
    $stmtActualizar->close();

    echo '<script>
            alert("Solicitud aprobada. Días totales actualizados.");
            window.location.href = "../vista/vacaciones.php";
          </script>';
}

// Obtener de nuevo los días solicitados para mostrar en la vista
$sqlSolicitados = "SELECT SUM(v.diasSolicitados) AS diasSolicitados 
                   FROM Usuariovacaciones uv 
                   JOIN vacaciones v ON uv.idVacaciones = v.idVacaciones 
                   JOIN solicitud s ON v.idSolicitud = s.idSolicitud 
                   WHERE uv.idUsuario = ? AND s.estado IN ('Pendiente', 'Aprobado')";
$stmtSolicitados = $enlace->prepare($sqlSolicitados);
$stmtSolicitados->bind_param("i", $idUsuario);
$stmtSolicitados->execute();
$stmtSolicitados->bind_result($diasSolicitados);
$stmtSolicitados->fetch();
$stmtSolicitados->close();

// Calcular días restantes
$diasRestantes = $diasTotales - ($diasSolicitados ?? 0); 

// Verificar que los días restantes no sean negativos
if ($diasRestantes <= 0) {
    echo '<script>
            alert("No te quedan más vacaciones para este año.");
          </script>';
    echo '<h1>Días Totales de Vacaciones: ' . htmlspecialchars($diasTotales) . '</h1>';
    echo '<h1>Días Solicitados: ' . htmlspecialchars($diasSolicitados ?? 0) . '</h1>'; // Usar 0 si no hay solicitudes
    echo '<h1>Días Restantes: ' . htmlspecialchars($diasRestantes) . '</h1>';
    exit();
}

// Cerrar la conexión
$enlace->close(); // Cerrar la conexión para mysqli

// Imprimir el contenido directamente en la vista
echo '<h1>Días Totales de Vacaciones: ' . htmlspecialchars($diasTotales) . '</h1>';
echo '<h1>Días Solicitados: ' . htmlspecialchars($diasSolicitados ?? 0) . '</h1>'; // Usar 0 si no hay solicitudes
echo '<h1>Días Restantes: ' . htmlspecialchars($diasRestantes) . '</h1>';
?>
