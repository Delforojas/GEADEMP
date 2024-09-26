<?php


require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
// Crear una instancia de la clase Bolsa
$bolsa = new Bolsa();

// Llamar al método ObtenerBolsa() a través de la instancia
$resultado = $bolsa->ObtenerBolsa();

echo '<form action="../controlador/procesar.php" method="post">';
echo "<table><tr>";

while ($field = mysqli_fetch_field($resultado)) {
    echo "<th>" . htmlspecialchars($field->name) . "</th>";
}
echo "<th>Seleccionar</th>";
echo "</tr>";


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



mysqli_close($enlace);

?>