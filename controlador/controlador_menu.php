<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
// Directorio donde están almacenados los documentos
$directorio = 'Menu'; // Asegúrate de tener permisos de lectura en esta carpeta

// Obtener los archivos del directorio
$archivos = scandir($directorio);

// Filtrar los resultados para eliminar los elementos '.' y '..' que corresponden al directorio actual y el directorio padre
$archivos = array_diff($archivos, array('.', '..'));

// Verificar si hay archivos
if (!empty($archivos)) {
    // Iniciar la tabla HTML
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>
            <tr>
                <th>Semana</th>
                <th></th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Recorrer y listar los archivos
    foreach ($archivos as $archivo) {
        // Obtener la extensión del archivo
        $extension = pathinfo($archivo, PATHINFO_EXTENSION);

        // Mostrar solo los archivos que son documentos (PDF, DOCX, TXT)
        if (in_array(strtolower($extension), ['pdf', 'doc', 'docx', 'txt'])) {
            // Mostrar cada archivo como una fila en la tabla
            echo "<tr>";
            echo "<td>$archivo</td>"; // Nombre del archivo
            echo "<td><a href='$directorio/$archivo' target='_blank'>Ver / Descargar</a></td>"; // Enlace para ver o descargar
            echo "</tr>";
        }
    }
    
    echo "</tbody>";
    echo "</table>";
} else {
    // Mostrar mensaje si no hay archivos
    echo "<p>No se encontraron documentos en el directorio.</p>";
}
?>
