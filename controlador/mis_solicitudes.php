<?php
// Archivo: mis_solicitudes.php
session_start();
include_once 'modelo/datos_conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

function verMisSolicitudes($idUsuario) {
    $conn = obtenerConexion();

    // Obtener las solicitudes de vacaciones del usuario actual
    $sql = "SELECT v.idVacaciones, v.fecha_inicio, v.fecha_fin, v.diasSolicitados, s.estado
            FROM vacaciones v
            INNER JOIN solicitud s ON v.idSolicitud = s.idSolicitud
            INNER JOIN usuariovacaciones uv ON v.idVacaciones = uv.idVacaciones
            WHERE uv.idUsuario = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>
                <thead>
                    <tr>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Días Solicitados</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["fecha_inicio"] . "</td>
                    <td>" . $row["fecha_fin"] . "</td>
                    <td>" . $row["diasSolicitados"] . "</td>
                    <td>" . obtenerEstado($row["estado"]) . "</td>
                  </tr>";
        }

        echo "</tbody>
              </table>";
    } else {
        echo "<p>No tienes solicitudes de vacaciones.</p>";
    }

    $conn->close();
}

function obtenerEstado($estado) {
    switch ($estado) {
        case 1:
            return "Pendiente";
        case 2:
            return "Aprobada";
        case 3:
            return "Rechazada";
        default:
            return "Desconocido";
    }
}

$idUsuario = $_SESSION['idUsuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Solicitudes de Vacaciones</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Mis Solicitudes de Vacaciones</h1>
    <?php verMisSolicitudes($idUsuario); ?>
    <a href="pagina_principal.php">Volver a la página principal</a>
</body>
</html>
