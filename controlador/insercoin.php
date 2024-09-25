<?php
require_once("../modelo/modelo.php");

$enlace = obtenerConexion();


// Verificar si se envió el formulario
if (isset($_POST['registro'])) {
    list($nombre, $ancho, $espesor) = obtenerDatosFormulario();

    // Verificar si todos los datos están presentes
    if ($nombre && $ancho && $espesor) {
        // Consulta SQL para insertar datos
        $resultado = insertarEnBolsa($nombre, $ancho, $espesor);
        
        if ($resultado) {
            echo "<script>alert('Bobina introducida en el programa.');</script>";
            header("Location: ../vista/vista_bolsa_admin.php");
        } else {
            echo "Error al insertar los datos.";
        }
    } 
}
// Cerrar la conexión
mysqli_close($enlace);
?>
