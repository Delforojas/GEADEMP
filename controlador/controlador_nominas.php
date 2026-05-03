<?php
// Verificar si la sesión no está iniciada antes de llamar a session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    echo "Debes iniciar sesión para acceder a tu carpeta de nóminas.";
    exit();
}

$nombre_usuario = $_SESSION['username'];

$nombre_limpio = preg_replace('/[^A-Za-z0-9_-]/', '', $nombre_usuario);


$ruta_carpeta_usuario = "../Nominas/" . $nombre_limpio;


$nomina = new Nomina(); // Instanciamos la clase

$nomina->mostrarNominas($ruta_carpeta_usuario, $nombre_usuario);
?>