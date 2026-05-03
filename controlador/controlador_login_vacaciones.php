<?php
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

session_start(); // Iniciar la sesión
$enlace=obtenerConexion();
// Verificar si se envió el formulario de login
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $vacaciones = new Vacaciones();

    $vacaciones->verificarVacaciones($enlace, $usuario, $clave);

}
?>


