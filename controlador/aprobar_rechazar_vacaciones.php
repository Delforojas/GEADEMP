<?php
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idVacaciones = htmlspecialchars($_POST['idVacaciones']);

    // Obtener días solicitados de la solicitud
    $sqlSolicitados = "SELECT diasSolicitados FROM Vacaciones WHERE idVacaciones = ?";
    $stmtSolicitados = $enlace->prepare($sqlSolicitados);
    $stmtSolicitados->bind_param("i", $idVacaciones);
    $stmtSolicitados->execute();
    $stmtSolicitados->bind_result($diasSolicitados);
    $stmtSolicitados->fetch();
    $stmtSolicitados->close();

    // Obtener el idUsuario a partir de Usuariovacaciones
    $sqlUsuario = "SELECT uv.idUsuario FROM Usuariovacaciones uv WHERE uv.idVacaciones = ?";
    $stmtUsuario = $enlace->prepare($sqlUsuario);
    $stmtUsuario->bind_param("i", $idVacaciones);
    $stmtUsuario->execute();
    $stmtUsuario->bind_result($idUsuario);
    $stmtUsuario->fetch();
    $stmtUsuario->close();

    // Obtener días totales del usuario
    $sqlTotales = "SELECT v.diasTotales 
            FROM vacaciones v 
            JOIN Usuariovacaciones uv ON v.idVacaciones = uv.idVacaciones 
            WHERE uv.idUsuario = ?";
    
    $stmtTotales = $enlace->prepare($sqlTotales);
    $stmtTotales->bind_param("i", $idUsuario);
    $stmtTotales->execute();
    $stmtTotales->bind_result($diasTotales);
    $stmtTotales->fetch();
    $stmtTotales->close();

    if (isset($_POST['aprobar'])) {
        // Calcular nuevos días totales
        $nuevosDiasTotales = $diasTotales - $diasSolicitados;

        // Verificar que no queden días negativos
        if ($nuevosDiasTotales < 0) {
            echo '<script>
                    alert("No puedes aprobar esta solicitud porque te quedarías sin días disponibles. ");
                    window.location.href = "../vista/vista_vacaciones_admin.php"; // Redirigir después del mensaje
                  </script>';
            exit();
        }

        // Actualizar los días totales
        $sqlActualizar = "UPDATE vacaciones v
                JOIN Usuariovacaciones uv ON v.idVacaciones = uv.idVacaciones
                SET v.diasTotales = ?
                WHERE uv.idUsuario = ?;";
        $stmtActualizar = $enlace->prepare($sqlActualizar);
        $stmtActualizar->bind_param("ii", $nuevosDiasTotales, $idUsuario);
        $stmtActualizar->execute();
        $stmtActualizar->close();

        // Actualizar el estado de la solicitud a aprobada
        $sql = "UPDATE Vacaciones SET idSolicitud = 2 WHERE idVacaciones = ?";
        $q = $enlace->prepare($sql);
        $q->execute([$idVacaciones]);

    } elseif (isset($_POST['rechazar'])) {
        // Actualizar el estado de la solicitud a rechazada
        $sql = "UPDATE Vacaciones SET idSolicitud = 3 WHERE idVacaciones = ?";
        $q = $enlace->prepare($sql);
        $q->execute([$idVacaciones]);
    }

    // Redirigir a la vista después de la acción
    header('Location: ../vista/vista_vacaciones_admin.php'); // Cambia la ruta a donde necesitas redirigir
    exit();
}
?>
