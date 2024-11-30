

<?php
// Depuración inicial: Verificar si los archivos existen antes de incluirlos
session_start();


// Verificar si el archivo de conexión existe
if (file_exists("../modelo/datos_conexion.php")) {
    // Si existe, incluirlo
    require_once("../modelo/datos_conexion.php");
} else {
    // Si no existe, mostrar un mensaje de error
    echo "El archivo datos_conexion.php no se encuentra en la ruta especificada.";
}
require_once("../modelo/modelo.php");

// Configuración para mostrar errores
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Llamar a la función que devuelve el enlace a la base de datos
$enlace = obtenerConexion();

if (!empty($_POST["btningresar"])) {
    $idusuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    if (empty($idusuario) || empty($clave)) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        // Consulta para verificar el usuario y contraseña
        $consulta = "SELECT idUsuario , idCargo, nombre FROM usuario WHERE apellidos = '$idusuario' AND clave = '$clave'";
        $resultado = mysqli_query($enlace, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $filas = mysqli_fetch_array($resultado);

            // Depurar los datos recuperados de la base de datos
            var_dump($filas);  // Verifica qué valores están siendo recuperados

            // Verifica que el ID esté presente en el resultado
            if (isset($filas['idUsuario'])) {
                $_SESSION['username'] = $filas['nombre'];
                $_SESSION['rol'] = $filas['idCargo'];
                $_SESSION['idUsuario'] = $filas['idUsuario'];  // Asegúrate de que $filas['id'] está correcto

                if ($filas['idCargo'] == 1) {
                    // Redirección para el administrador
                    echo "Redirigiendo a la vista del administrador...<br>";
                    header("Location:/GEADEMP1/Administradores");
                    exit();
                } elseif ($filas['idCargo'] == 2) {
                    // Redirección para el usuario normal
                    echo "Redirigiendo a la vista del usuario normal...<br>";
                    header("Location:/GEADEMP1/Inicio");
                    exit();
                }
            } else {
                echo '<div class="alert alert-danger">No se encontró el ID del usuario.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
        }

        mysqli_free_result($resultado); // Liberar el resultado de la consulta
    }
    mysqli_close($enlace); // Cerrar la conexión a la base de datos
}
?>
