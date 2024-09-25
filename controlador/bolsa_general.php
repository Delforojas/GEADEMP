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

// Aquí ya no agregamos la columna de selección
echo "</tr>";

// Imprimir datos de la tabla
while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    foreach ($row as $column) {
        echo "<td>" . htmlspecialchars($column) . "</td>";
    }
    // Si deseas agregar alguna acción específica (como un botón), lo puedes hacer aquí
    echo "</tr>";
}
echo "</table>";
// Puedes agregar un botón aquí si necesitas realizar alguna acción, como enviar el formulario
echo "</form>";

// Cerrar conexión
mysqli_close($enlace);

?>
