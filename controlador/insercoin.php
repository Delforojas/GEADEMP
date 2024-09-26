<?php

require_once("../modelo/modelo.php");

$enlace = obtenerConexion();

// Crear una instancia de la clase donde está definida obtenerDatosFormulario
$bolsa = new Bolsa(); // O el nombre de la clase donde esté definido el método

// Verificar si se envió el formulario
if (isset($_POST['registro'])) {
    // Llamar al método obtenerDatosFormulario desde la instancia de la clase
    list($nombre, $ancho, $espesor) = $bolsa->obtenerDatosFormulario();

    // Verificar si todos los datos están presentes
    if ($nombre && $ancho && $espesor) {
        // Consulta SQL para insertar datos
        $resultado = $bolsa->insertarEnBolsa($nombre, $ancho, $espesor);
        
        if ($resultado) {
            echo "<script>alert('Bobina introducida en el programa.');</script>";
            header("Location: ../vista/vista_bolsa_admin.php");
        } else {
            echo "Error al insertar los datos."; 
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

// Cerrar la conexión
mysqli_close($enlace);
?>

