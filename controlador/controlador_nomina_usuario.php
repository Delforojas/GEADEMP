<?php
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


$enlace = obtenerConexion();
$idUsuario = $_SESSION['username'] ?? null;
$mesSeleccionado = $_POST['mes'] ?? null;
$anioSeleccionado = $_POST['anio'] ?? null;

                $meses = [
                    "enero" => "Enero",
                    "febrero" => "Febrero",
                    "marzo" => "Marzo",
                    "abril" => "Abril",
                    "mayo" => "Mayo",
                    "junio" => "Junio",
                    "julio" => "Julio",
                    "agosto" => "Agosto",
                    "septiembre" => "Septiembre",
                    "octubre" => "Octubre",
                    "noviembre" => "Noviembre",
                    "diciembre" => "Diciembre"
                ];
        
        
         if (!empty($nominas)) {
    
            // Variables de selección
            $mesSeleccionado = $_POST['mes'] ?? null;
            $anioSeleccionado = $_POST['anio'] ?? null;
            $enlaceNominaSeleccionada = null;

            // Buscar la nómina correspondiente al mes y año seleccionados
            foreach ($nominas as $nomina) {
                if ($nomina['mes'] === $mesSeleccionado && $nomina['anio'] === $anioSeleccionado) {
                    $enlaceNominaSeleccionada = htmlspecialchars($nomina['enlace']);
                    break;
                }
            }
                   
            if ($enlaceNominaSeleccionada) {

                echo"<h3 class='titulo-vaca'>Nómina de $idUsuario para $mesSeleccionado $anioSeleccionado</h3>";
                echo '<ul>';
                foreach ($nominas as $nomina) {
                    echo '<li>';
                    echo 'Mes: ' . htmlspecialchars($meses[$nomina['mes']]) . ', Año: ' . htmlspecialchars($nomina['anio']);
                    echo ' - <a href="' . htmlspecialchars($nomina['enlace']) . '" target="_blank">Previsualizar Nómina</a>';
                    echo ' - <a href="' . htmlspecialchars($nomina['enlace']) . '" download>Descargar Nómina</a>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '<iframe src="' . $enlaceNominaSeleccionada . '" width="100%" height="600px"></iframe>';
            } elseif ($mesSeleccionado && $anioSeleccionado) {
                echo '<p>No se encontraron nóminas para la selección actual.</p>';
            } else {
                echo '<p>No se encontraron nóminas para el mes y año seleccionados.</p>';
            }
        }

?>