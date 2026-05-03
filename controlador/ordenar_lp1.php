<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
// Verifica si se ha enviado el valor del select 'orden'
if (isset($_POST['orden']) && $_POST['orden'] != "") {
    $orden = $_POST['orden'];

    $lp1 = new lp1();
    $resultado = $lp1->obtenerDatosOrdenadoslp1($orden);

    $lp1->mostrarDatoslp1($resultado);
}

?>
