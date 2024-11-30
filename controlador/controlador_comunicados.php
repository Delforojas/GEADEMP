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

// Directorio donde están almacenados los documentos
$directorio = $base_url . "/assets/pdf/Comunicados"; // URL pública del directorio de documentos

// Ruta absoluta del servidor para leer archivos
$rutaServidor = realpath(__DIR__ . "/../assets/pdf/Comunicados");

// Verificar si la carpeta existe en el servidor
if (!is_dir($rutaServidor)) {
    echo "<p>Error: El directorio de comunicados no existe. Verifique la configuración.</p>";
    exit();
}

// Obtener los archivos del directorio
$archivos = scandir($rutaServidor);

// Filtrar los resultados para eliminar '.' y '..'
$archivos = array_diff($archivos, ['.', '..']);

// Verificar si hay archivos disponibles
if (!empty($archivos)) {
    // Iniciar la tabla HTML
    echo "<div class='table-title'>";
    echo "<h3 class='titulo-vaca'>COMUNICADOS</h3>";

    echo "<table class='table-fill'>";
    echo "<thead>
            <tr>
                <th class='text-left'>Nombre del Archivo</th>
                <th class='text-left'>Ver / Descargar</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Recorremos los archivos y los mostramos en la tabla
    foreach ($archivos as $archivo) {
        // Obtener la extensión del archivo
        $extension = pathinfo($archivo, PATHINFO_EXTENSION);

        // Mostrar solo los archivos válidos (PDF, DOCX, TXT, etc.)
        if (in_array(strtolower($extension), ['pdf', 'doc', 'docx', 'txt'])) {
            $urlArchivo = "$directorio/$archivo"; // Generar la URL pública del archivo

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
    echo "<p>No se encontraron documentos en el directorio de comunicados.</p>";
}

// Cerrar la conexión a la base de datos
mysqli_close($enlace);
?>
