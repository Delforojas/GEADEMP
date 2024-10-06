<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
session_start(); // Inicia la sesión
        // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
        header("Location: login.php"); // Redirige si no hay sesión
        exit();
        }
        $usuario = $_SESSION['username']; 
        $usuario_id = $_SESSION['id'];

        // Obtiene el nombre del usuario de la sesión
        // Si ha iniciado sesión, muestra el mensaje de bienvenida
        echo "<div id='contenedor-bienvenida'>
                    <img src='imagenes/logod.png' alt='Imagen de bienvenida' id='imagen-bienvenida'>
                    <p id='bienve'>Bienvenido, $usuario   </p>
                    <form action='../controlador/salir.php' method='post'>
                        <button type='submit' class='btn-salir'>Salir</button>
                    </form>
                </div>"
?>