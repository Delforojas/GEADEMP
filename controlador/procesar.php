<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

// Verificar si se enviaron datos del formulario
if (isset($_POST['seleccionados'])) {
    foreach ($_POST['seleccionados'] as $id) {
        $resultado = obtenerCheckbox($enlace, $id);

        // Insertar en la tabla sl4 o sl7 según el espesor
        if ($row = mysqli_fetch_assoc($resultado)) {
            if ($row['espesor'] > 5) {
                // Insertar en sl7
                insertarsl7($enlace, $row['nombre'], $row['ancho'], $row['espesor']);
            } else {
                // Insertar en sl4
                insertarsl4($enlace, $row['nombre'], $row['ancho'], $row['espesor']);
            }
            
            $eliminar = eliminarDatos($enlace, $id);
        } else {
            echo "No se encontraron datos para el ID: $id.";
        }
    }
    echo "Los registros seleccionados han sido insertados en las tablas correspondientes y eliminados de bolsa.";
    header ("location: ../vista/vista_bolsa_admin.php");
} else {
    echo "No se seleccionaron registros.";
}

// Cerrar la conexión
mysqli_close($enlace);
?>
