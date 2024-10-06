<?php
// Verificar si la sesión no está iniciada antes de llamar a session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    echo "Debes iniciar sesión para acceder a tu carpeta de nóminas.";
    exit();
}

$nombre_usuario = $_SESSION['username'];

$nombre_limpio = preg_replace('/[^A-Za-z0-9_-]/', '', $nombre_usuario);


$ruta_carpeta_usuario = "../Nominas/" . $nombre_limpio;

if (file_exists($ruta_carpeta_usuario)) {
    
    $archivos = array_diff(scandir($ruta_carpeta_usuario), array('.', '..'));
    echo "<h2 class='btn-volver'>Nóminas de $nombre_usuario</h2>";
    echo "<div class='table-title'>";  // Agregamos el contenedor con la clase 'table-title'
    echo "<h3  class='titulo-vaca'>Lista de Nóminas</h3>";
    echo "<table class='table-fill'>";  // Usamos la clase 'table-fill' en la tabla
    echo "<thead>
            <tr>
                <th class='text-left'>Nóminas</th>
                <th class='text-left'>Ver / Descargar</th>
            </tr>
        </thead>";
    echo "<tbody>";

    foreach ($archivos as $archivo) {
        $ruta_archivo = $ruta_carpeta_usuario . '/' . $archivo;
        echo "<tr>";
        echo "<td class='text-left'>$archivo</td>";  // Aplicamos la clase 'text-left' a las celdas
        echo "<td class='text-left'><a href='$ruta_archivo' target='_blank'>Ver / Descargar</a></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>"; 

    } else {
        echo "No se encontró la carpeta de nóminas para el usuario $nombre_usuario.";
    }

    ?>