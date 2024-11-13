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
$vacaciones = new Vacaciones($enlace);

// Obtener los días totales disponibles del usuario
$diasTotales = $vacaciones->obtenerDiasTotales($idUsuario);

if ($diasTotales === null || $diasTotales <= 0) {
    echo '<script>
            alert("No puedes solicitar más vacaciones, ya que no tienes días disponibles.");
            window.location.href = "../vista/vista_vacaciones.php";
          </script>';
    exit();
}

// Procesar solicitud de vacaciones
if (isset($_POST['solicitar_vacaciones'])) {
    $fecha_inicio = $_POST['fecha_inicio'] ?? null;
    $fecha_fin = $_POST['fecha_fin'] ?? null;

    // Validar las fechas de inicio y fin
    if (!$fecha_inicio || !$fecha_fin || strtotime($fecha_inicio) > strtotime($fecha_fin)) {
        $_SESSION['mensaje_error'] = "Fechas de solicitud no válidas.";
        header("Location: ../vista/vista_vacaciones.php");
        exit();
    }

    // Calcular días solicitados
    $diasSolicitados = (strtotime($fecha_fin) - strtotime($fecha_inicio)) / (60 * 60 * 24) + 1;

    // Verificar que los días solicitados no excedan el límite de 30
    if ($diasSolicitados > 30) {
        echo '<script>
                alert("No puedes solicitar más de 30 días de vacaciones.");
                window.location.href = "../vista/vista_vacaciones.php";
              </script>';
        exit();
    }

    // Calcular días restantes
    $diasRestantes = $diasTotales - $diasSolicitados;

    // Verificar que no queden días negativos
    if ($diasRestantes < 0) {
        echo '<script>
                alert("No puedes solicitar más días de los que tienes disponibles.");
                window.location.href = "../vista/vista_vacaciones.php";
              </script>';
        exit();
    }

    // Insertar en la tabla `Vacaciones`
    $idVacaciones = $vacaciones->insertarVacaciones(1, $fecha_inicio, $fecha_fin, $diasSolicitados);

    if ($idVacaciones === null) {
        echo '<script>
                alert("Error al insertar la solicitud de vacaciones.");
                window.location.href = "../vista/vista_vacaciones.php";
              </script>';
        exit();
    }

    // Asociar la solicitud de vacaciones con el usuario en `UsuarioVacaciones`
    $asociacionExitosa = $vacaciones->UsuarioVacaciones($idUsuario, $idVacaciones);

    if (!$asociacionExitosa) {
        echo '<script>
                alert("Error al asociar la solicitud de vacaciones con el usuario.");
                window.location.href = "../vista/vista_vacaciones.php";
              </script>';
        exit();
    }

    // Actualizar los días totales
    $vacaciones->actualizarDiasTotales($enlace, $diasRestantes, $idUsuario);

    echo '<script>
            alert("Solicitud de vacaciones enviada con éxito. Días totales actualizados.");
            window.location.href = "../vista/vista_vacaciones.php";
          </script>';
}

// Cerrar la conexión
$enlace->close();

?>
