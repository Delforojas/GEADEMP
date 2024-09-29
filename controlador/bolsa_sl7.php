<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

$sl7 = new Sl7();
$resultado = $sl7->ObtenerBolsasl7($enlace);


$sl7->generarTablaSinCheckbox($resultado);

?>