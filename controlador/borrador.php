

////////

<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

// Verificar si se enviaron los datos
if (isset($_POST['seleccionados'])) {
    // Recorrer los IDs seleccionados
    foreach ($_POST['seleccionados'] as $id) {
        // Consulta para obtener los datos de la tabla bolsa
        $consulta = "SELECT nombre, ancho, espesor FROM bolsa WHERE id = ?";
        $stmt = mysqli_prepare($enlace, $consulta);
        
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        
    
        $resultado = mysqli_stmt_get_result($stmt);

        // Insertar en la tabla sl4 si se encuentra el registro
        if ($row = mysqli_fetch_assoc($resultado)) {
            
        $insertar = "INSERT INTO sl4 (nombre, ancho, espesor) VALUES (?, ?, ?)";
            
        $insert_stmt = mysqli_prepare($enlace, $insertar);
            
        mysqli_stmt_bind_param($insert_stmt, "sii", $row['nombre'], $row['ancho'], $row['espesor']);
            
        mysqli_stmt_execute($insert_stmt);
        mysqli_stmt_close($insert_stmt); // Cerrar la declaración de inserción
        }
        
        mysqli_stmt_close($stmt); // Cerrar la declaración de selección
    }
    echo "Los registros seleccionados han sido insertados en la tabla sl4.";
    } else {
    echo "No se seleccionaron registros.";
    }

// Cerrar la conexión
mysqli_close($enlace);
?>


////
<?php
require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();

// Mostrar los datos de la tabla bolsa
$resultado = ObtenerBolsa($enlace);
    
echo '<form action="insertar.php" method="post">'; // Aquí puedes mantener el mismo archivo para procesar
echo "<table border='1'><tr>";
while ($field = mysqli_fetch_field($resultado)) {
    echo "<th>" . $field->name . "</th>";
}
echo "<th>Seleccionar</th></tr>";

// Imprimir datos de la tabla
while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    foreach ($row as $column) {
        echo "<td>" . htmlspecialchars($column) . "</td>";
    }
    // Añadir un checkbox para cada fila
    echo "<td><input type='checkbox' name='seleccionados[]' value='" . $row['id'] . "'></td>";
    echo "</tr>";
}
echo "</table>";
echo "<input type='submit' value='Enviar'>";
echo "</form>";

// Procesar la inserción si se enviaron los datos
if (isset($_POST['seleccionados'])) {
    foreach ($_POST['seleccionados'] as $id) {
        // Consulta para obtener los datos de la tabla bolsa
        $consulta = "SELECT nombre, ancho, espesor FROM bolsa WHERE id = ?";
        $stmt = mysqli_prepare($enlace, $consulta);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        // Insertar en la tabla sl4 si se encuentra el registro
        if ($row = mysqli_fetch_assoc($resultado)) {
            $insertar = "INSERT INTO sl4 (nombre, ancho, espesor) VALUES (?, ?, ?)";
            $insert_stmt = mysqli_prepare($enlace, $insertar);
            mysqli_stmt_bind_param($insert_stmt, "sii", $row['nombre'], $row['ancho'], $row['espesor']);
            mysqli_stmt_execute($insert_stmt);
            mysqli_stmt_close($insert_stmt);
        }

        mysqli_stmt_close($stmt);
    }

    echo "Los registros seleccionados han sido insertados en la tabla sl4.";
} else {
    echo "No se seleccionaron registros.";
}

// Cerrar la conexión
mysqli_close($enlace);
?>
///////////////

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
                insertarsl4($enlace, $row['nombre'], $row['ancho'], $row['espesor']);
            }
        } else {
            echo "No se encontraron datos para el ID: $id.";
        }
    }
    echo "Los registros seleccionados han sido insertados en las tablas correspondientes.";
} else {
    echo "No se seleccionaron registros.";
}

// Cerrar la conexión
mysqli_close($enlace);
?>*/

<?php
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}
$usuario = $_SESSION['username']; 

require_once("../modelo/modelo.php");
require_once("../modelo/datos_conexion.php");

$enlace = obtenerConexion();
$resultado = ObtenerBolsa($enlace);

// Comenzar el HTML
echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo1.css">
    <title>Bolsa Administradores</title>

    
</head>
<body>';

echo " <div id='contenedor-bienvenida'>
       <p id='bienve'>Bienvenido, $usuario</p>
            <form action='../controlador/salir.php' method='post'>
                <button type='submit' class='btn-salir'>Salir</button>
            </form>
        </div>";
echo '<h1>Bolsa Administradores</h1>';
echo '<div class="form-volver">
        <form action="principal.php" method="get">
            <button type="submit" class="btn-volver">Volver a Principal</button>
        </form>
      </div>';

echo '<form action="procesar.php" method="post">';
echo "<table><tr>";
echo '<form action="procesar.php" method="post">';

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
echo '</div>';

// Cerrar conexión
mysqli_close($enlace);

// Cerrar HTML
echo '</body>
</html>';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bolsa Administrar</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enlace a insertar.php</title>
    <?php
        session_start(); // Inicia la sesión
        // Verifica si el usuario ha iniciado sesión
        if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Redirige si no hay sesión
        exit(); // Detiene la ejecución después de redirigir
        }
        $usuario = $_SESSION['username']; // Obtiene el nombre del usuario de la sesión
        // Si ha iniciado sesión, muestra el mensaje de bienvenida
        echo "<h1>Bienvenido, $usuario</h1>";
        echo "<a href='../controlador/salir.php'>Salir</a>";
        // Redirigir directamente a bolsa.php
        header("Location: ../controlador/bolsa_admin.php");
        exit(); // Asegúrate de llamar a exit después de header
        ?>
        
</head>

</html>


<header class="header1">
    <nav>
      <ul>
        <li class="open_submenu">
          <a class="ai" href="#">
            ORDENAR
            <i class="fa-solid f-chevron-down"></i>
          </a>
          <div class="submenu">
              <ul>
                  <li class="open_submenu">
                        <a href="#">ESPESOR</a>
                        <div class="submenu">
                      <ul>
                        <li><a href="ordenespesorsl7.php">Ordenar Ascendente</a></li>
                        <li><a href="ordendesc.php">Ordenar Descendente</a></li>
                      </ul>
                  </li>
                  <li><a href="#">ANCHO</a></li>
                  <li><a href="#">JV</a></li>       
              </ul>
          </div>
        </li>
      </ul>
    </nav>
</header>

function ObtenerBolsasl7OrdenadoPorEspesor($direccion = 'ASC') {
        // Conectar a la base de datos
        $enlace = obtenerConexion();

        // Validar que la dirección sea 'ASC' o 'DESC' para evitar inyecciones SQL
        $direccion = ($direccion === 'ASC' || $direccion === 'DESC') ? $direccion : 'ASC';

        // Consulta SQL para obtener los datos ordenados por espesor
        $consulta = "SELECT nombre, espesor, ancho FROM sl7 ORDER BY espesor $direccion";
        
        // Ejecutar la consulta
        $resultado = mysqli_query($enlace, $consulta);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al obtener los datos: " . mysqli_error($enlace));
        }
        
        // Devolver el resultado de la consulta
        return $resultado;
    }