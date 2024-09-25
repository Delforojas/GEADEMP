<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    echo "Debes iniciar sesión para ver tus vacaciones.";
    exit();
}

// Incluir la conexión a la base de datos
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

// Verificar si la conexión fue exitosa
if (!$enlace) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener el ID del usuario desde la sesión
$usuario_id = $_SESSION['usuario_id'];

// Consulta para obtener las vacaciones del usuario
$consulta = "SELECT id, fecha_inicio, fecha_fin, estado, comentario FROM vacaciones WHERE usuario_id = '$usuario_id'";
$resultado = mysqli_query($enlace, $consulta);

// Generar tabla HTML para la vista
$tabla_vacaciones = '';
if (mysqli_num_rows($resultado) > 0) {
    $tabla_vacaciones = '<table>';
    $tabla_vacaciones .= '<thead><tr><th>Fecha de inicio</th><th>Fecha de fin</th><th>Estado</th><th>Comentario</th></tr></thead><tbody>';
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tabla_vacaciones .= '<tr>';
        $tabla_vacaciones .= '<td>' . $fila['fecha_inicio'] . '</td>';
        $tabla_vacaciones .= '<td>' . $fila['fecha_fin'] . '</td>';
        $tabla_vacaciones .= '<td>' . $fila['estado'] . '</td>';
        $tabla_vacaciones .= '<td>' . $fila['comentario'] . '</td>';
        $tabla_vacaciones .= '</tr>';
    }
    $tabla_vacaciones .= '</tbody></table>';
} else {
    $tabla_vacaciones = '<p>No has solicitado vacaciones.</p>';
}

// Cerrar la conexión a la base de datos
mysqli_close($enlace);

// Incluir la vista
include("../vista/vista_vacaciones.php");
?>