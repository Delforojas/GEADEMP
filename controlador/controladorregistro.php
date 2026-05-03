<?php
require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();

if (!empty($_POST['registro'])) {
    // Verifica si alguno de los campos está vacío
    if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['clave'])) {
        echo 'Uno de los campos está vacío';
    } else {
        // Captura los valores de los campos del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos']; // Asegúrate de que el nombre del campo sea correcto
        $clave = $_POST['clave'];
        $idCargo = 2; // O el valor correspondiente para el rol

        // Consulta para insertar el nuevo usuario
        $q = "INSERT INTO usuario (nombre, apellidos, clave, idCargo) 
              VALUES ('$nombre', '$apellidos', '$clave', $idCargo)";
        $resultado = mysqli_query($enlace, $q);

        if ($resultado == 1) {
            // Limpiar el nombre para evitar caracteres especiales en el nombre de la carpeta
            $nombre_limpio = preg_replace('/[^A-Za-z0-9_-]/', '', $nombre);

            // Ruta de la nueva carpeta para el usuario (nominas/nombre_usuario)
            $ruta_carpeta = "../Nominas/" . $nombre_limpio;

            // Verifica si la carpeta base 'Nominas' existe
            if (!file_exists("../Nominas")) {
                echo "Error: La carpeta 'Nominas' no existe.";
                exit();
            }

            // Crear la carpeta si no existe
            if (!file_exists($ruta_carpeta)) {
                if (mkdir($ruta_carpeta, 0777, true)) {
                    echo 'Usuario registrado correctamente y carpeta creada: ' . $ruta_carpeta;
                } else {
                    echo 'Error al crear la carpeta del usuario. Verifica los permisos del directorio.';
                }
            } else {
                echo 'La carpeta del usuario ya existe: ' . $ruta_carpeta;
            }

            // Redirigir a la vista de administrador
            header("Location: ../vista/vista_bolsa_admin.php");
            exit(); // Detener ejecución después de la redirección
        } else {
            echo 'Usuario no registrado. Error en la consulta SQL: ' . mysqli_error($enlace);
        }
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($enlace);