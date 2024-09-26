<?php
// Incluir el archivo que contiene la función de conexión
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

session_start(); // Iniciar la sesión

// Verificar si se ha enviado el formulario de login
if (!empty($_POST["btningresar"])) {
    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $password = $_POST["clave"];

    // Verificar si los campos están vacíos
    if (empty($usuario) || empty($password)) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        // Crear una instancia de la clase Usuario
        $usuarioObj = new Usuario();
        
        // Llamar a la función para verificar credenciales
        $usuarioObj->verificarCredenciales($usuario, $password);
    }
        // Llamar a la función para verificar credenciales
        verificarCredenciales($usuario, $password );
    }


?>
