<?php
// Incluir archivos necesarios
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

// Inicializar variables
$mes = $_POST['mes'] ?? null;
$anio = $_POST['anio'] ?? null;
$idUsuario = $_SESSION['idUsuario'];

// Crear una instancia de la clase Nomina
$nominaObj = new Nomina();

// Llamar a la función para obtener las nóminas del usuario
$nominas = $nominaObj->obtenerNominasPorUsuario($enlace, $idUsuario, $mes, $anio);

// Array de nombres de meses para pasar a la vista
$meses = [
    "01" => "Enero",
    "02" => "Febrero",
    "03" => "Marzo",
    "04" => "Abril",
    "05" => "Mayo",
    "06" => "Junio",
    "07" => "Julio",
    "08" => "Agosto",
    "09" => "Septiembre",
    "10" => "Octubre",
    "11" => "Noviembre",
    "12" => "Diciembre"
];

// Cerrar la conexión a la base de datos
mysqli_close($enlace);

// Incluir la vista
include("../vista/vista_nomina_usuario.php");
?>
