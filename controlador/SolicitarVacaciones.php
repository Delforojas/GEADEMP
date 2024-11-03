<?php
session_start();
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$idUsuario = $_SESSION['idUsuario'] ?? null;

if (!$idUsuario) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['solicitar_vacaciones'])) {
    $fecha_inicio = $_POST['fecha_inicio'] ?? null;
    $fecha_fin = $_POST['fecha_fin'] ?? null;

    if (!$fecha_inicio || !$fecha_fin || strtotime($fecha_inicio) > strtotime($fecha_fin)) {
        $_SESSION['mensaje_error'] = "Fechas de solicitud no válidas.";
        header("Location: ../vista/vista_solicitud_vacaciones.php");
        exit();
    }

    $enlace = obtenerConexion();

    // Calcular días solicitados
    $diasSolicitados = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / (60 * 60 * 24) + 1;

    // Insertar en la tabla `Vacaciones`
    $queryVacaciones = "INSERT INTO Vacaciones (idSolicitud, fecha_inicio, fecha_fin, diasSolicitados) VALUES (1, ?, ?, ?)";
    $stmtVacaciones = $enlace->prepare($queryVacaciones);
    $stmtVacaciones->bind_param("ssi", $fecha_inicio, $fecha_fin, $diasSolicitados);
    $stmtVacaciones->execute();
    $idVacaciones = $stmtVacaciones->insert_id;
    $stmtVacaciones->close();

    // Asociar la solicitud de vacaciones con el usuario en `UsuariosVacaciones`
    $queryUsuariosVacaciones = "INSERT INTO UsuarioVacaciones (idUsuario, idVacaciones) VALUES (?, ?)";
    $stmtUsuariosVacaciones = $enlace->prepare($queryUsuariosVacaciones);
    $stmtUsuariosVacaciones->bind_param("ii", $idUsuario, $idVacaciones);
    $stmtUsuariosVacaciones->execute();
    $stmtUsuariosVacaciones->close();

    $_SESSION['mensaje_exito'] = "Solicitud de vacaciones enviada con éxito.";
    mysqli_close($enlace);

    // Mostrar el HTML directamente en el controlador
    echo '
    <p>Días Totales de Vacaciones: ' . htmlspecialchars($diasTotales) . '</p>
    <p>Días Solicitados: ' . htmlspecialchars($diasSolicitados) . '</p>
    <p>Días Restantes: ' . htmlspecialchars($diasRestantes) . '</p>';
    


    header("Location: ../vista/solicitar_vacaciones.php");
    exit();

}
?>