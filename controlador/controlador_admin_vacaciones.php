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

// Obtener el ID de la solicitud de vacaciones y la acción
$vacacion_id = $_POST['vacacion_id'];
$accion = $_POST['accion'];

// Obtener los datos de la solicitud
$consulta_vacacion = "SELECT usuario_id, dias_solicitados FROM vacaciones WHERE id = '$vacacion_id'";
$resultado_vacacion = mysqli_query($enlace, $consulta_vacacion);
$vacacion = mysqli_fetch_assoc($resultado_vacacion);

$usuario_id = $vacacion['usuario_id'];
$dias_solicitados = $vacacion['dias_solicitados'];

if ($accion === 'aprobar') {
    // Restar los días solicitados del total de días disponibles del usuario
    $consulta_dias_usuario = "SELECT dias_vacaciones FROM usuarios WHERE id = '$usuario_id'";
    $resultado_dias_usuario = mysqli_query($enlace, $consulta_dias_usuario);
    $usuario = mysqli_fetch_assoc($resultado_dias_usuario);
    
    $dias_restantes = $usuario['dias_vacaciones'] - $dias_solicitados;

    // Actualizar los días restantes en la tabla usuarios
    $consulta_actualizar_usuario = "UPDATE usuarios SET dias_vacaciones = '$dias_restantes' WHERE id = '$usuario_id'";
    mysqli_query($enlace, $consulta_actualizar_usuario);

    // Actualizar el estado de la solicitud a "aprobado"
    $estado = 'aprobado';
} elseif ($accion === 'rechazar') {
    $estado = 'rechazado';
}

// Actualizar el estado de la solicitud en la base de datos
$consulta_actualizar_vacacion = "UPDATE vacaciones SET estado = '$estado' WHERE id = '$vacacion_id'";
if (mysqli_query($enlace, $consulta_actualizar_vacacion)) {
    echo "Solicitud de vacaciones actualizada correctamente.";
} else {
    echo "Error al actualizar la solicitud: " . mysqli_error($enlace);
}

// Cerrar la conexión a la base de datos
mysqli_close($enlace);

// Redirigir a la vista de solicitudes pendientes
header("Location: ../vista/vista_vacaciones_admin.php");
?>