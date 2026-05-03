<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

$lp = new linea_produccion();
$lp1 = new lp1();  // Crear una instancia de la clase lp1
$lp2 = new lp2();  // Crear una instancia de la clase lp2

// Verificar si se enviaron datos del formulario
if (isset($_POST['seleccionados'])) {
    foreach ($_POST['seleccionados'] as $id) {
        $resultado = $lp->obtenerCheckbox($enlace, $id);

        // Insertar en la tabla sl4 o sl7 según el espesor
        if ($row = mysqli_fetch_assoc($resultado)) {
            if ($row['criterio2'] > 5) {
                // Insertar en sl7 usando la instancia de Sl7
                $lp2->insertarlp2($enlace, $row['nombre'], $row['criterio1'], $row['criterio2']);
            } else {
                // Insertar en sl4 usando la instancia de Sl4
                $lp1->insertarlp1($enlace, $row['nombre'], $row['criterio1'], $row['criterio2']);
            }
            
            // Eliminar los datos de la tabla bolsa
            $lp->eliminarDatos($enlace, $id);
        } else {
            echo "No se encontraron datos para el ID: $id.";
        }
    }
    echo "Los registros seleccionados han sido insertados en las tablas correspondientes y eliminados de bolsa.";
    header("location: ../vista/vista_bolsa_admin.php");
} else {
    echo "No se seleccionaron registros.";
}

// Cerrar la conexión
mysqli_close($enlace);
?>
