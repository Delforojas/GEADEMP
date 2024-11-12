<?php
require_once('../modelo/datos_conexion.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['solicitar_vacaciones'])) {
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $idUsuario = $_SESSION['idUsuario'];

    $conn = obtenerConexion();

    try {
        // Validar fechas
        if (new DateTime($fechaFin) < new DateTime($fechaInicio)) {
            throw new Exception("La fecha de fin no puede ser anterior a la fecha de inicio.");
        }

        // Insertar la solicitud
        $sqlSolicitud = "INSERT INTO solicitud (estado) VALUES (1)";
        if ($conn->query($sqlSolicitud) === TRUE) {
            $idSolicitud = $conn->insert_id;

            // Insertar en la tabla vacaciones
            $sqlVacaciones = "INSERT INTO vacaciones (fecha_inicio, fecha_fin, diasSolicitados, idSolicitud, diasTotales) VALUES (?, ?, ?, ?, 30)";
            $stmtVacaciones = $conn->prepare($sqlVacaciones);
            $diasSolicitados = (new DateTime($fechaFin))->diff(new DateTime($fechaInicio))->days + 1;
            $stmtVacaciones->bind_param("ssii", $fechaInicio, $fechaFin, $diasSolicitados, $idSolicitud);

            if ($stmtVacaciones->execute()) {
                $idVacaciones = $stmtVacaciones->insert_id;

                // Insertar en la tabla puente usuariovacaciones
                $sqlUsuarioVacaciones = "INSERT INTO usuariovacaciones (idVacaciones, idUsuario) VALUES (?, ?)";
                $stmtUsuarioVacaciones = $conn->prepare($sqlUsuarioVacaciones);
                $stmtUsuarioVacaciones->bind_param("ii", $idVacaciones, $idUsuario);
                $stmtUsuarioVacaciones->execute();

                echo "Solicitud de vacaciones registrada exitosamente.";
            } else {
                throw new Exception("Error al registrar las vacaciones.");
            }
        } else {
            throw new Exception("Error al registrar la solicitud.");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}
?>