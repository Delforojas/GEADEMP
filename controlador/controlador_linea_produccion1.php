<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

$lp1 = new lp1();
$resultado = $lp1->Obtenerlp1($enlace);


$lp1->generarTablaSinCheckbox($resultado);

?>
