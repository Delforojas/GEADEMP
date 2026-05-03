<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
// Crear una instancia de la clase Bolsa
$lp = new linea_produccion();


$resultado = $lp->ObtenerLineaProduccion();

$lp ->generarTablaConCheckboxes($resultado);

