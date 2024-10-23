<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

$lp2 = new lp2();
$resultado = $lp2->Obtenerlp2($enlace);


$lp2->generarTablaSinCheckbox($resultado);

?>