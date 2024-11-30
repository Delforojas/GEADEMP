<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");
include '../config.php'; // Incluir archivo de configuración

// Activar reporte de errores para depuración
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Obtener la conexión a la base de datos
$enlace = obtenerConexion();

// Verificar si la conexión se realizó correctamente
if (!$enlace) {
    echo "<p>Error: No se pudo conectar a la base de datos.</p>";
    exit();
}

// Directorio donde están almacenados los documentos
$rutaServidor = realpath(__DIR__ . "/../assets/pdf/Menu");
$directorio = $base_url . "/assets/pdf/Menu"; // URL pública

// Verificar si la carpeta existe
if (!is_dir($rutaServidor)) {
    echo "<p>Error: El directorio del menú no existe. Verifique la configuración.</p>";
    exit();
}

// Obtener los archivos del directorio
$archivos = scandir($rutaServidor);

// Filtrar los resultados para eliminar '.' y '..'
$archivos = array_diff($archivos, ['.', '..']);

// Verificar si hay archivos disponibles
if (!empty($archivos)) {
    echo "<div class='table-title'>";
    echo "<h3 class='titulo-vaca'>MENÚ COMEDOR</h3>";

    echo "<table class='table-fill'>";
    echo "<thead>
            <tr>
                <th class='text-left'>Semana</th>
                <th class='text-left'>Ver / Descargar</th>
            </tr>
          </thead>";
    echo "<tbody>";

    foreach ($archivos as $archivo) {
        $extension = pathinfo($archivo, PATHINFO_EXTENSION);

        if (in_array(strtolower($extension), ['pdf', 'doc', 'docx', 'txt'])) {
            $urlArchivo = "$directorio/$archivo";

            echo "<tr>";
            echo "<td class='text-left'>" . htmlspecialchars($archivo) . "</td>";
            echo "<td class='text-left'>
                    <a href='$urlArchivo' target='_blank'>Ver / Descargar</a>
                  </td>";
            echo "</tr>";
        }
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>No se encontraron documentos en el directorio del menú.</p>";
}

// Cerrar la conexión a la base de datos si es válida
if ($enlace) {
    mysqli_close($enlace);
}
?>
