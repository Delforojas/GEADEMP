<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    echo "Debes iniciar sesión para ver tus vacaciones.";
    exit();
}

// Incluir la conexión a la base de datos
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

// Verificar si la conexión fue exitosa
if (!$enlace) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener el ID del usuario desde la sesión
$usuario_id = $_SESSION['usuario_id'];

// Consulta para obtener las vacaciones del usuario
$consulta = "SELECT fecha_inicio, fecha_fin, estado FROM vacaciones WHERE usuario_id = '$usuario_id'";
$resultado = mysqli_query($enlace, $consulta);

// Generar tabla HTML para la vista
echo ''; // Limpiar cualquier salida previa

if (mysqli_num_rows($resultado) > 0) {
    echo '<table>';
    echo '<thead><tr><th>Fecha de inicio</th><th>Fecha de fin</th><th>Estado</th><th>Días calculados</th></tr></thead>'; 
    echo '<tbody>';
       
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Calcular la cantidad de días entre las fechas
        $fecha_inicio = $fila['fecha_inicio'];
        $fecha_fin = $fila['fecha_fin'];

        // Usamos DateTime para calcular la diferencia de días
        $inicio = new DateTime($fecha_inicio);
        $fin = new DateTime($fecha_fin);
        $diferencia = $inicio->diff($fin);
        $dias_solicitados = $diferencia->days + 1;  // Sumar 1 para incluir el día de inicio
        
        // Mostrar las vacaciones en una tabla
        echo '<tr>';
        echo '<td>' . $fecha_inicio . '</td>';
        echo '<td>' . $fecha_fin . '</td>';
        echo '<td>' . $fila['estado'] . '</td>';
        echo '<td>' . $dias_solicitados . '</td>';  // Mostrar los días calculados
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No has solicitado vacaciones.</p>';
}

// Cerrar la conexión a la base de datos
mysqli_close($enlace);
?>
