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

    // Validar las fechas de inicio y fin
    if (!$fecha_inicio || !$fecha_fin || strtotime($fecha_inicio) > strtotime($fecha_fin)) {
        $_SESSION['mensaje_error'] = "Fechas de solicitud no válidas.";
        header("Location: ../vista/vista_vacaciones.php");
        exit();
    }

    $enlace = obtenerConexion();

    // Calcular días solicitados
    $diasSolicitados = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / (60 * 60 * 24) + 1;

    // Verificar que los días solicitados no excedan el límite de 30
    if ($diasSolicitados > 30) {
        echo '<script>
                alert("No puedes solicitar más de 30 días de vacaciones.");
                window.location.href = "../vista/vista_vacaciones.php"; // Redirigir después del mensaje
              </script>';
        exit();
    }

    // Obtener los días totales disponibles del usuario
    $sqlTotales = "SELECT v.diasTotales 
                   FROM Usuariovacaciones uv 
                   JOIN vacaciones v ON uv.idVacaciones = v.idVacaciones 
                   WHERE uv.idUsuario = ?";
    
    $stmtTotales = $enlace->prepare($sqlTotales);
    $stmtTotales->bind_param("i", $idUsuario);
    $stmtTotales->execute();
    $stmtTotales->bind_result($diasTotales);
    $stmtTotales->fetch();
    $stmtTotales->close();

    // Calcular días restantes
    $diasRestantes = $diasTotales - $diasSolicitados;

    // Verificar que no queden días negativos
    if ($diasRestantes < 0) {
        echo '<script>
                alert("No puedes solicitar más días de los que tienes disponibles.");
                window.location.href = "../vista/vista_vacaciones.php"; //
              </script>';
        exit();
    }

    // Verificar que los días restantes sean mayores que 0 para permitir la solicitud
    if ($diasRestantes <= 0) {
        echo '<script>
                alert("No puedes solicitar más vacaciones, ya que no te quedan días disponibles. cabron ");
                window.location.href = "../vista/vista_vacaciones.php"; // Redirigir después del mensaje
              </script>';
        exit();
    }

    // Insertar en la tabla `Vacaciones`
    $queryVacaciones = "INSERT INTO Vacaciones (idSolicitud, fecha_inicio, fecha_fin, diasSolicitados) VALUES (1, ?, ?, ?)";
    $stmtVacaciones = $enlace->prepare($queryVacaciones);
    $stmtVacaciones->bind_param("ssi", $fecha_inicio, $fecha_fin, $diasSolicitados);
    $stmtVacaciones->execute();
    $idVacaciones = $stmtVacaciones->insert_id;
    $stmtVacaciones->close();

    // Asociar la solicitud de vacaciones con el usuario en `UsuarioVacaciones`
    $queryUsuariosVacaciones = "INSERT INTO UsuarioVacaciones (idUsuario, idVacaciones) VALUES (?, ?)";
    $stmtUsuariosVacaciones = $enlace->prepare($queryUsuariosVacaciones);
    $stmtUsuariosVacaciones->bind_param("ii", $idUsuario, $idVacaciones);
    $stmtUsuariosVacaciones->execute();
    $stmtUsuariosVacaciones->close();

    $_SESSION['mensaje_exito'] = "Solicitud de vacaciones enviada con éxito.";
    mysqli_close($enlace);

    // Redirigir después de la solicitud
    header("Location: ../vista/vista_vacaciones.php");
    exit();
}
?>
