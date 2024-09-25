<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
$resultado = ObtenerBolsa($enlace);

echo '<form action="../controlador/procesar.php" method="post">';
echo "<table><tr>";
// Imprimir encabezados de la tabla
while ($field = mysqli_fetch_field($resultado)) {
    echo "<th>" . htmlspecialchars($field->name) . "</th>";
}
echo "<th>Seleccionar</th>"; // Columna para seleccionar
echo "</tr>";

// Imprimir datos de la tabla
while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    foreach ($row as $column) {
        echo "<td>" . htmlspecialchars($column) . "</td>";
    }
    echo "<td><input type='checkbox' name='seleccionados[]' value='" . htmlspecialchars($row['id']) . "'></td>";
    echo "</tr>";
}
echo "</table>";
echo "<input type='submit' value='Enviar'>";
echo "</form>";


// Cerrar conexión
mysqli_close($enlace);

?>