<?php
session_start();
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$idUsuario = $_SESSION['idUsuario'] ?? null;

if (!$idUsuario) {
    header("Location: login.php");
    exit();
}

$enlace = obtenerConexion();

if ($enlace->connect_error) {
    die("Conexión fallida: " . $enlace->connect_error);
}

// Consulta para obtener la suma de los días solicitados aprobados por el usuario
$query = "SELECT SUM(v.diasSolicitados) AS totalDiasSolicitados 
          FROM vacaciones v
          JOIN usuariovacaciones uv ON v.idVacaciones = uv.idVacaciones
          WHERE uv.idUsuario = ? AND v.idSolicitud = 2"; // Solo contar los días de vacaciones aprobados

$stmt = $enlace->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();
$totalDiasSolicitados = $fila['totalDiasSolicitados'] ?? 0;

// Calcular los días restantes
$diasTotales = 30; // Total de días disponibles, puedes ajustar según corresponda
$diasRestantes = $diasTotales - $totalDiasSolicitados;

// Guardar los días restantes en la sesión
$_SESSION['diasRestantes'] = $diasRestantes;

// Si el usuario intenta solicitar vacaciones
if (isset($_POST['solicitar_vacaciones'])) {
    $fecha_inicio = $_POST['fecha_inicio'] ?? null;
    $fecha_fin = $_POST['fecha_fin'] ?? null;

    if (!$fecha_inicio || !$fecha_fin || strtotime($fecha_inicio) > strtotime($fecha_fin)) {
        echo "<script>alert('Fechas de solicitud no válidas.');</script>";
        echo "<script>window.location.href = '../vista/solicitar_vacaciones.php';</script>";
        exit();
    }

    // Recalcular días solicitados
    $diasSolicitados = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / (60 * 60 * 24) + 1;

    // Verificar si los días restantes son suficientes
    if ($_SESSION['diasRestantes'] <= 0) {
        echo "<script>alert('No tienes días disponibles para solicitar más vacaciones. Días restantes: {$_SESSION['diasRestantes']}.');</script>";
        echo "<script>window.location.href = '../vista/solicitar_vacaciones.php';</script>";
        exit();
    }

    if ($diasSolicitados > $_SESSION['diasRestantes']) {
        echo "<script>alert('No tienes suficientes días disponibles para la solicitud. Días restantes: {$_SESSION['diasRestantes']}.');</script>";
        echo "<script>window.location.href = '../vista/solicitar_vacaciones.php';</script>";
        exit();
    }

    // Insertar en la tabla `Vacaciones`
    $queryVacaciones = "INSERT INTO Vacaciones (idSolicitud, fecha_inicio, fecha_fin, diasSolicitados) VALUES (1, ?, ?, ?)";
    $stmtVacaciones = $enlace->prepare($queryVacaciones);
    $stmtVacaciones->bind_param("ssi", $fecha_inicio, $fecha_fin, $diasSolicitados);
    
    if ($stmtVacaciones->execute()) {
        $idVacaciones = $stmtVacaciones->insert_id;
        $stmtVacaciones->close();

        // Asociar la solicitud de vacaciones con el usuario en `UsuarioVacaciones`
        $queryUsuariosVacaciones = "INSERT INTO UsuarioVacaciones (idUsuario, idVacaciones) VALUES (?, ?)";
        $stmtUsuariosVacaciones = $enlace->prepare($queryUsuariosVacaciones);
        $stmtUsuariosVacaciones->bind_param("ii", $idUsuario, $idVacaciones);
        
        if ($stmtUsuariosVacaciones->execute()) {
            echo "<script>alert('Solicitud de vacaciones enviada con éxito.');</script>";
            // Actualizar los días restantes después de la solicitud exitosa
            $_SESSION['diasRestantes'] -= $diasSolicitados;
        } else {
            echo "<script>alert('Error al asociar la solicitud con el usuario: " . addslashes($stmtUsuariosVacaciones->error) . "');</script>";
        }
        $stmtUsuariosVacaciones->close();
    } else {
        echo "<script>alert('Error al insertar la solicitud de vacaciones: " . addslashes($stmtVacaciones->error) . "');</script>";
    }

    mysqli_close($enlace);

    // Redirigir a la vista para mostrar el resultado
    echo "<script>window.location.href = '../vista/solicitar_vacaciones.php';</script>";
    exit();
}
?>
