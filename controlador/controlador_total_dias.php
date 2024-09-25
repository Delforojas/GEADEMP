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

// Consulta para obtener el total de días de vacaciones disponibles
$consulta_dias_totales = "SELECT dias_vacaciones FROM usuarios WHERE id = '$usuario_id'";
$resultado_dias_totales = mysqli_query($enlace, $consulta_dias_totales);

// Obtener el total de días de vacaciones
$dias_totales = 0;
if ($fila_dias = mysqli_fetch_assoc($resultado_dias_totales)) {
    $dias_totales = $fila_dias['dias_vacaciones'];
}

// Cerrar la conexión a la base de datos
mysqli_close($enlace);

// Devolver el total de días de vacaciones para usar en la vista
return $dias_totales;
?>
