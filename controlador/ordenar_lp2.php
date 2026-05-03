<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
// Verifica si se ha enviado el valor del select 'orden'
if (isset($_POST['orden']) && $_POST['orden'] != "") {
    $orden = $_POST['orden'];
   // Crear una instancia de la clase Sl7
   $lp2 = new lp2();

   // Llamar al método obtenerDatosOrdenadosSL7() a través de la instancia
   $resultado = $lp2->obtenerDatosOrdenadoslp2($orden);
   $lp2->mostrarDatoslp2($resultado);
}

?>
