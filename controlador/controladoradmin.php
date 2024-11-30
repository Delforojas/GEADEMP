<?php

include("../modelo/datos_conexion.php");
include("../config.php");
session_start();

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

// Verificar si se ha enviado el formulario de login
if (!empty($_POST["btningresar"])) {
    // Obtener los datos del formulario
    $epellidos = $_POST["apellidos"];
    $clave = $_POST["clave"];

    // Verificar si los campos están vacíos
    if (empty($apellidos) || empty($clave)) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        // Llamar a la función verificarUsuario
        $datosUsuario = verificarUsuario($apellidos, $clave);

        // Verificar si se encontró el usuario
        if ($datosUsuario) {
            // Guardar los datos en la sesión
            $_SESSION['username'] = $datosUsuario['nombre'];
            $_SESSION['idCargo'] = $datosUsuario['idCargo'];

            // Mostrar mensaje de éxito
            echo '<div class="alert alert-success">Login exitoso</div>';

            // Redirigir según el rol
            header("Location: " . $base_url . "/Administradores.php");
            exit(); // Asegurarse de detener el script después de la redirección
        } else {
            // Si el usuario o contraseña son incorrectos
            echo '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
        }
    }
}

// Cerrar la conexión a la base de datos
$enlace->close();
?>