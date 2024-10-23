<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
session_start();
        
        // Verifica si el usuario ha iniciado sesión y si es un administrador
        if (!isset($_SESSION['username']) || $_SESSION['rol'] != 1) {
            // Si no es administrador o no ha iniciado sesión, redirigir a la página de inicio de sesión
            header("Location: login.php");
            exit();
        }
            $usuario = $_SESSION['username'];
        
            echo "<div id='contenedor-bienvenida'>
                        <img src='imagenes/logod.png' alt='Imagen de bienvenida' id='imagen-bienvenida'>
                        <p id='bienve'>Bienvenido (admin), $usuario  </p>
                        <form action='../controlador/salir.php' method='post'>
                            <button type='submit' class='btn-salir'>Salir</button>
                        </form>
                    </div>"
?>