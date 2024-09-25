<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    echo "Acceso denegado. Debes ser administrador para realizar esta acción.";
    exit();
}

// Incluir la conexión a la base de datos
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

// Obtener el ID de la solicitud de vacaciones
$vacacion_id = $_POST['vacacion_id'];

// Determinar si se está aprobando o rechazando la solicitud
if (isset($_POST['aprobar'])) {
    $estado = 'aprobado';
} elseif (isset($_POST['rechazar'])) {
    $estado = 'rechazado';
}

// Actualizar el estado de la solicitud en la base de datos
$consulta = "UPDATE vacaciones SET estado = '$estado' WHERE id = '$vacacion_id'";
if (mysqli_query($enlace, $consulta)) {
    echo "Solicitud de vacaciones actualizada correctamente.";
} else {
    echo "Error al actualizar la solicitud: " . mysqli_error($enlace);
}

// Cerrar la conexión a la base de datos
mysqli_close($enlace);

// Redirigir a la vista de solicitudes pendientes
header("Location: ../vista/vista_vacaciones_admin.php");
?>
