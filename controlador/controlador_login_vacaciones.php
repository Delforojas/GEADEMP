<?php
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

session_start(); // Iniciar la sesión
$enlace=obtenerConexion();
// Verificar si se envió el formulario de login
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Verificar si la conexión está bien establecida
    if (!$enlace) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Consulta para verificar el usuario y la contraseña
    $consulta = "SELECT id FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
    $resultado = mysqli_query($enlace, $consulta);

    // Si el usuario es encontrado
    if (mysqli_num_rows($resultado) == 1) {
        $usuario_data = mysqli_fetch_assoc($resultado);
        // Asignar el ID del usuario a la sesión
        $_SESSION['usuario_id'] = $usuario_data['id'];
        
        // Redirigir a la página de vacaciones
        header("Location: ../vista/vista_vacaciones.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>