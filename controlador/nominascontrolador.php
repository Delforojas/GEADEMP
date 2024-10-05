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
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>
            <tr>
                <th>Nominas</th>
                <th>Ver / Descargar</th>
            </tr>
          </thead>";
    echo "<tbody>";

    
    foreach ($archivos as $archivo) {
        $ruta_archivo = $ruta_carpeta_usuario . '/' . $archivo;
        echo "<tr>";
        echo "<td>$archivo</td>";  
        echo "<td><a href='$ruta_archivo' target='_blank'>Ver / Descargar</a></td>";  
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

} else {
    echo "No se encontró la carpeta de nóminas para el usuario $nombre_usuario.";
}

?>