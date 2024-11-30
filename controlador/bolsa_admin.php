<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");
include '../config.php'; 

$enlace = obtenerConexion();

// Crear una instancia de la clase linea_produccion
$lp = new linea_produccion();

// Obtener los resultados de la línea de producción
$resultado = $lp->ObtenerLineaProduccion();

// Ruta del archivo al que enviar el formulario
$action = $base_url . "/controlador/procesar.php";

// Generar la tabla con checkboxes desde la instancia de linea_produccion
$lp->generarTablaConCheckboxes($resultado, $action);
?>
