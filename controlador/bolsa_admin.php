<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
// Crear una instancia de la clase Bolsa
$bolsa = new Bolsa();

// Llamar al método ObtenerBolsa() a través de la instancia
$resultado = $bolsa->ObtenerBolsa();

$bolsa ->generarTablaConCheckboxes($resultado);

