<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

$sl4 = new Sl4();
$resultado = $sl4->ObtenerBolsasl4($enlace);


$sl4->generarTablaSinCheckbox($resultado);

?>
