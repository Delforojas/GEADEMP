<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

// Verifica si se ha enviado el valor del select 'orden'
if (isset($_POST['orden']) && $_POST['orden'] != "") {
    $orden = $_POST['orden'];

    // Conexión a la base de datos
    $conexion = obtenerConexion();

    // Inicializamos la variable de consulta
    $query = "SELECT * FROM sl7";

    // Determina la consulta según el valor de 'orden'
    if ($orden == "ASC") {
        // Ordenar por espesor ascendente
        $query .= " ORDER BY espesor ASC";
    } elseif ($orden == "DESC") {
        // Ordenar por espesor descendente
        $query .= " ORDER BY espesor DESC";
    } elseif ($orden == "AASC") {
        // Ordenar por ancho ascendente
        $query .= " ORDER BY ancho ASC";
    } elseif ($orden == "ADESC") {
        // Ordenar por ancho descendente
        $query .= " ORDER BY ancho DESC";
    }

    // Ejecuta la consulta
    $result = $conexion->query($query);

    // Comprueba si hay resultados y los muestra en una tabla
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Ancho</th><th>Espesor</th></tr>";

        // Recorre los resultados y los muestra en filas de la tabla
        while ($row = $result->fetch_assoc()) {
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
    }

    // Cierra la conexión
    $conexion->close();
} else {
    echo "No se ha recibido ningún valor de ordenamiento.";
}
?>