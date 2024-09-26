<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
// Verifica si se ha enviado el valor del select 'orden'
if (isset($_POST['orden']) && $_POST['orden'] != "") {
    $orden = $_POST['orden'];

    // Crear una instancia de la clase Sl7
    $sl4 = new Sl4();

    // Llamar al método obtenerDatosOrdenadosSL7() a través de la instancia
    $resultado = $sl4->obtenerDatosOrdenadosSL4($orden);
    // Comprueba si hay resultados
    if ($resultado->num_rows > 0) {
        // Prepara los datos para mostrarlos en la vista principal
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Ancho</th><th>Espesor</th></tr>";

        // Recorre los resultados y los muestra en filas de la tabla
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['ancho'] . "</td>";
            echo "<td>" . $row['espesor'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No hay datos para mostrar.";
    }$enlace->close();

} else {
    echo "No se ha recibido ningún valor de ordenamiento.";
}
?>
