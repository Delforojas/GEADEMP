<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

$sl7 = new Sl7();
$resultado = $sl7->ObtenerBolsasl7($enlace);

echo '<div class="formulario-contenedor">';
echo '<form action="procesar.php" method="post">';
echo "<table><tr>";


// Imprimir encabezados de la tabla
while ($field = mysqli_fetch_field($resultado)) {
    echo "<th>" . htmlspecialchars($field->name) . "</th>";
}
echo "</tr>";

// Imprimir datos de la tabla sin checkboxes
while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    foreach ($row as $column) {
        echo "<td>" . htmlspecialchars($column) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</form>";



// Cerrar conexión
mysqli_close($enlace);

?>
