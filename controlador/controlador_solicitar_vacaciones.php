<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se ha enviado el formulario de solicitud de vacaciones
if (isset($_POST['solicitar_vacaciones'])) {
    // Obtener el ID del usuario desde la sesión
    $usuario_id = $_SESSION['usuario_id'];  // ID del usuario en sesión
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Conectar a la base de datos
    require_once("../modelo/datos_conexion.php");
    require_once("../modelo/modelo.php");

    $enlace = obtenerConexion();

    // Calcular la cantidad de días entre las fechas
    $inicio = new DateTime($fecha_inicio);
    $fin = new DateTime($fecha_fin);
    $diferencia = $inicio->diff($fin);
    $dias_solicitados = $diferencia->days + 1;  // Sumar 1 para incluir el día de inicio

    // Insertar la solicitud de vacaciones en la base de datos con el usuario específico
    $consulta_insertar = "INSERT INTO vacaciones (usuario_id, fecha_inicio, fecha_fin, estado, dias_solicitados) 
                          VALUES ('$usuario_id', '$fecha_inicio', '$fecha_fin', 'pendiente', '$dias_solicitados')";

    if (mysqli_query($enlace, $consulta_insertar)) {
        // Redirigir a la vista de vacaciones
        header("location: ../vista/vista_vacaciones.php");
    } else {
        echo "Error al solicitar las vacaciones: " . mysqli_error($enlace);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($enlace);
}
?>