<?php
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();


if (isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
    $checkbox = $_POST['checkbox'];

    foreach ($checkbox as $valor) {
        // Escapa el valor para evitar inyecciones SQL
        $valor = mysqli_real_escape_string($enlace, $valor);

        // Obtén los datos del registro seleccionado
        $query = "SELECT nombre, criterio1 , criterio2 FROM linea_produccion WHERE id = '$valor'";
        $resultado = mysqli_query($enlace, $query);

        if ($resultado) {
            $registro = mysqli_fetch_assoc($resultado);
            $nombre = mysqli_real_escape_string($enlace, $registro['nombre']);
            $ancho = mysqli_real_escape_string($enlace, $registro['criterio1']);
            $espesor = mysqli_real_escape_string($enlace, $registro['criterio2']);

            // Determina en qué tabla insertar basándose en el espesor
            if ($criterio1 > 1) {
                $tablaDestino = "lp1";
            } else {
                $tablaDestino = "lp2";
            }

            // Inserta los datos en la tabla correspondiente
            $insertarDatos = "INSERT INTO $tablaDestino (nombre, criterio1, criterio2) VALUES ('$nombre', '$criterio1', '$criterio2')";
            $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);

            if (!$ejecutarInsertar) {
                echo "<script>alert('Error al insertar datos en $tablaDestino: " . mysqli_error($enlace) . "'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Datos insertados correctamente en $tablaDestino.'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Error al obtener datos del registro: " . mysqli_error($enlace) . "'); window.location.href='index.php';</script>";
        }
    }
} else {
    echo "<script>alert('No se seleccionaron registros.'); window.location.href='index.php';</script>";
}

mysqli_close($enlace);
?>