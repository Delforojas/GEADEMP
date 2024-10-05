<?php
// Incluir el archivo que contiene la función de conexión
include("../modelo/datos_conexion.php");
include("../modelo/modelo.php");
session_start();

// Llamar a la función que devuelve el enlace a la base de datos
$enlace = obtenerConexion();

if (!empty($_POST["btningresar"])) {
    $usuario = $_POST["usuario"];
    $password = $_POST["clave"];

    if (empty($usuario) || empty($password)) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        // Consulta para verificar el usuario y contraseña
        $consulta = "SELECT id , id_cargo, nombre FROM usuarios WHERE usuario = '$usuario' AND clave = '$password'";
        $resultado = mysqli_query($enlace, $consulta);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $filas = mysqli_fetch_array($resultado);

            // Depurar los datos recuperados de la base de datos
            var_dump($filas);  // Verifica qué valores están siendo recuperados

            // Verifica que el ID esté presente en el resultado
            if (isset($filas['id'])) {
                $_SESSION['username'] = $filas['nombre'];
                $_SESSION['rol'] = $filas['id_cargo'];
                $_SESSION['id'] = $filas['id'];  // Asegúrate de que $filas['id'] está correcto

                if ($filas['id_cargo'] == 1) {
                    // Redirección para el administrador
                    header("Location: vista_bolsa_admin.php");
                    exit();
                } elseif ($filas['id_cargo'] == 2) {
                    // Redirección para el usuario normal
                    header("Location: index.php");
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
