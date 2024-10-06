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
            echo "<div class='table-title'>";  // Añadimos un contenedor con la clase 'table-title'
            echo "<h3  class='titulo-vaca'>MENU COMEDOR</h3>";  // Título de la tabla

            // Creamos la tabla con la clase 'table-fill' y los estilos adicionales
            echo "<table class='table-fill'>";
            echo "<thead>
                    <tr>
                        <th class='text-left'>Semana</th>
                        <th class='text-left'>Ver / Descargar</th>
                    </tr>
                </thead>";
            echo "<tbody>";

            // Recorremos y listamos los archivos
            foreach ($archivos as $archivo) {
                // Obtener la extensión del archivo
                $extension = pathinfo($archivo, PATHINFO_EXTENSION);

                // Mostrar solo los archivos que son documentos (PDF, DOCX, TXT)
                if (in_array(strtolower($extension), ['pdf', 'doc', 'docx', 'txt'])) {
                    // Mostrar cada archivo como una fila en la tabla
                    echo "<tr>";
                    echo "<td class='text-left'>$archivo</td>";  // Nombre del archivo, alineado a la izquierda
                    echo "<td class='text-left'><a href='$directorio/$archivo' target='_blank'>Ver / Descargar</a></td>";  // Enlace para ver o descargar
                    echo "</tr>";
                }
            }

            echo "</tbody>";
            echo "</table>";  // Cerramos la tabla
            echo "</div>";  // Cerramos el div 'table-title'
            } else {
                // Mostrar mensaje si no hay archivos
                echo "<p>No se encontraron documentos en el directorio.</p>";
            }
            ?>