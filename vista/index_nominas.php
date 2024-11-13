<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Subir documentos Pdf con PHP</title>
</head>

<body>

    <div class="container">
        <div class="position-absolute top-50 start-25 traslate-middle">
            <h1 class="text-center mb-4">Subir documentos Pdf con PHP</h1>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="documento" id="">
                <input type="submit">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <body>
    <h1>Listado de Nóminas</h1>

    <?php
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

// Suponiendo que el ID del usuario logueado está almacenado en una variable de sesión
session_start();
$usuario_id_actual = $_SESSION['usuario_id']; // Ajusta según cómo manejes las sesiones

// Consulta para obtener las nóminas solo del usuario logueado
$sql = "SELECT n.usuario_id, u.nombre, n.mes, n.año, n.enlace_pdf 
        FROM nominas n 
        JOIN usuarios u ON n.usuario_id = u.id 
        WHERE n.usuario_id = '$usuario_id_actual'
        ORDER BY n.año DESC, n.mes DESC";
$resultado = $enlace->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Iniciar la tabla HTML
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead>
            <tr>
                <th>Nombre del Usuario</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Nómina</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Recorrer los resultados y mostrar cada fila
    while ($fila = $resultado->fetch_assoc()) {
        $usuario_nombre = $fila['nombre'];
        $mes = $fila['mes'];
        $año = $fila['año'];
        $enlace_pdf = $fila['enlace_pdf'];

        // Mostrar la fila con los datos de la nómina
        echo "<tr>";
        echo "<td>$usuario_nombre</td>";  // Nombre del usuario
        echo "<td>$mes</td>";  // Mes
        echo "<td>$año</td>";  // Año
        echo "<td><a href='$enlace_pdf' target='_blank'>Ver / Descargar</a></td>";  // Enlace para ver o descargar el PDF
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    // Si no se encontraron nóminas
    echo "<p>No se encontraron nóminas registradas.</p>";
}

// Cerrar la conexión
$enlace->close();
?>
</body>



</html>

?>