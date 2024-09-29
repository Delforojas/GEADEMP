<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
// Verifica si se ha enviado el valor del select 'orden'
if (isset($_POST['orden']) && $_POST['orden'] != "") {
    $orden = $_POST['orden'];

    $sl4 = new Sl4();
    $resultado = $sl4->obtenerDatosOrdenadosSL4($orden);

    $sl4->mostrarDatosSl4($resultado);
}

?>
