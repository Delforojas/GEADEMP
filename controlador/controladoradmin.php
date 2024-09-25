<?php
// Incluir el archivo que contiene la función de conexión
include("../modelo/datos_conexion.php");
session_start(); // Iniciar la sesión

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

// Verificar si se ha enviado el formulario de login
if (!empty($_POST["btningresar"])) {
    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Verificar si los campos están vacíos
    if (empty($usuario) || empty($password)) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        // Preparar la consulta SQL para verificar el usuario y la contraseña
        $stmt = $enlace->prepare("SELECT u.id, u.nombre, u.apellidos, u.clave, u.status, r.nombre AS rol 
                                  FROM usuarios u 
                                  LEFT JOIN roles r ON u.rol_id = r.id 
                                  WHERE u.usuario = ? AND u.clave = ? AND u.status = 1");
        
        // Enlazar los parámetros (usuario y contraseña)
        $stmt->bind_param("ss", $usuario, $password);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado de la consulta
        $resultado = $stmt->get_result();

        // Verificar si se obtuvo algún resultado (usuario válido)
        if ($resultado->num_rows > 0) {
            // Obtener los datos del usuario
            $row = $resultado->fetch_assoc();

            // Guardar los datos del usuario en la sesión
            $_SESSION['username'] = $row['nombre'];
            $_SESSION['rol'] = $row['rol'];

            // Mostrar mensaje de éxito
            echo '<div class="alert alert-success">Login exitoso</div>';

            // Redirigir al usuario según su rol (en este caso, a la vista de administrador)
            header("Location: vista_bolsa_admin.php");
            exit(); // Asegurarse de que el script se detiene después de la redirección
        } else {
            // Si no se encuentra un usuario válido, mostrar mensaje de error
            echo '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
        }

        // Cerrar el statement
        $stmt->close();
    }
}

// Cerrar la conexión a la base de datos
$enlace->close();
?>

