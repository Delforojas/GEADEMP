<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");
include '../config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['username']) || !isset($_SESSION['idUsuario'])) {
    header("Location: " . $base_url . "/Geademp"); // Redirige si no hay sesión
    exit(); // Termina el script para evitar seguir ejecutando código innecesario
}

$usuario = htmlspecialchars($_SESSION['username']); // Protege los datos
$usuario_id = $_SESSION['idUsuario']; // Asegúrate de que la variable esté validada antes de usarla

// Mostrar la bienvenida
echo "<div id='contenedor-bienvenida'>
            <img src='".$base_url ."/assets/imagenes/geademp.png' alt='Imagen de bienvenida' id='imagen-bienvenida'>
            <p id='bienve'>Bienvenido, $usuario</p>
            <form action='" . $base_url ."/controlador/salir.php' method='post'>
                <button type='submit' class='btn-salir'>Salir</button>
            </form>
        </div>";

// Aquí puedes cerrar la conexión si es necesario, por ejemplo:
// mysqli_close($enlace);
?>
