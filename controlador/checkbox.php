<?php
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();


if (isset($_POST['checkbox']) && is_array($_POST['checkbox'])) {
    $checkbox = $_POST['checkbox'];

    foreach ($checkbox as $valor) {
        // Escapa el valor para evitar inyecciones SQL
        $valor = mysqli_real_escape_string($enlace, $valor);

        // Obtén los datos del registro seleccionado
        $query = "SELECT nombre, ancho, espesor FROM bolsa WHERE id = '$valor'";
        $resultado = mysqli_query($enlace, $query);

        if ($resultado) {
            $registro = mysqli_fetch_assoc($resultado);
            
            $nombre = mysqli_real_escape_string($enlace, $registro['nombre']);
            $ancho = mysqli_real_escape_string($enlace, $registro['ancho']);
            $espesor = mysqli_real_escape_string($enlace, $registro['espesor']);

            // Determina en qué tabla insertar basándose en el espesor
            if ($espesor > 1) {
                $tablaDestino = "sl4";
            } else {
                $tablaDestino = "sl7";
            }

            // Inserta los datos en la tabla correspondiente
            $insertarDatos = "INSERT INTO $tablaDestino (nombre, ancho, espesor) VALUES ('$nombre', '$ancho', '$espesor')";
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