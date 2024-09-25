<?php
require_once("datos_conexion.php");




function obtenerConexion() {
    global $servidor, $user, $clave, $baseDedatos;
    $enlace = mysqli_connect($servidor, $user, $clave, $baseDedatos);
    if (!$enlace) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $enlace;
}

function ObtenerBolsa(){
    $enlace = obtenerConexion();
    $consulta = "SELECT * FROM bolsa"; // Cambia esto por el nombre de tu tabla
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        die("Error al realizar la consulta: " . mysqli_error($enlace));
    }
    return $resultado;
}

function insertarEnBolsa($nombre, $ancho, $espesor) {
    $enlace = obtenerConexion();
    $consulta = "INSERT INTO bolsa (nombre, ancho, espesor) VALUES (?,?,?)";
    $resultado = mysqli_prepare($enlace, $consulta);
    
    if (!$resultado) {
            die("Error al preparar la consulta: " . mysqli_error($enlace));
        }
    // Vincular los parámetros (s = string, i = entero)
    mysqli_stmt_bind_param($resultado, "sii", $nombre, $ancho, $espesor);

    // Ejecutar la consulta
    $ejecucion = mysqli_stmt_execute($resultado);

    if (!$ejecucion) {
        die("Error al ejecutar la consulta: " . mysqli_stmt_error($resultado));
    }

    // Cerrar la declaración
    mysqli_stmt_close($resultado);
    mysqli_close($enlace);

    return $ejecucion; // Devuelve true si fue exitosa
}
function obtenerDatosFormulario() {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $ancho = isset($_POST['ancho']) ? (int)$_POST['ancho'] : null; 
    $espesor = isset($_POST['espesor']) ? (int)$_POST['espesor'] : null;

    return [$nombre, $ancho, $espesor]; // Devuelve un array con los datos
}
    
function obtenerCheckbox($enlace, $id) {
    $consulta = "SELECT nombre, ancho, espesor FROM bolsa WHERE id = ?";
    $checkbox = mysqli_prepare($enlace, $consulta);
    if (!$checkbox) {
        die("Error al preparar la consulta: " . mysqli_error($enlace));
    }
    mysqli_stmt_bind_param($checkbox, "i", $id);
    mysqli_stmt_execute($checkbox);
    $resultado = mysqli_stmt_get_result($checkbox);
    // Cerrar la sentencia
    
    mysqli_stmt_close($checkbox);
    return $resultado; // Retorna el resultado
}

function insertarsl4($enlace, $nombre, $ancho, $espesor) {
    $insertar = "INSERT INTO sl4 (nombre, ancho, espesor) VALUES (?, ?, ?)";
    $insertsl4 = mysqli_prepare($enlace, $insertar);
    if (!$insertsl4) {
        die("Error al preparar la consulta: " . mysqli_error($enlace));
    }
    mysqli_stmt_bind_param($insertsl4, "sii", $nombre, $ancho, $espesor);
    $ejecucion = mysqli_stmt_execute($insertsl4);
    if (!$ejecucion) {
        die("Error al ejecutar la consulta: " . mysqli_stmt_error($insertsl4));
    }
    mysqli_stmt_close($insertsl4);
}

function insertarsl7($enlace, $nombre, $ancho, $espesor) {
    $insertar = "INSERT INTO sl7 (nombre, ancho, espesor) VALUES (?, ?, ?)";
    $insertsl7 = mysqli_prepare($enlace, $insertar);
    if (!$insertsl7) {
        die("Error al preparar la consulta: " . mysqli_error($enlace));
    }
    mysqli_stmt_bind_param($insertsl7, "sii", $nombre, $ancho, $espesor);
    $ejecucion = mysqli_stmt_execute($insertsl7);
    if (!$ejecucion) {
        die("Error al ejecutar la consulta: " . mysqli_stmt_error($insertsl7));
    }
    mysqli_stmt_close($insertsl7);
}

function eliminardatos($enlace, $id){
    // Eliminar el registro de la tabla bolsa
    $eliminar = "DELETE FROM bolsa WHERE id = ?";
    $Delete = mysqli_prepare($enlace, $eliminar);
    mysqli_stmt_bind_param($Delete, "i", $id);
    mysqli_stmt_execute($Delete);
    mysqli_stmt_close($Delete);
}

function ObtenerBolsasl4(){
    $enlace = obtenerConexion();
    $consulta = "SELECT * FROM sl4"; // Cambia esto por el nombre de tu tabla
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        die("Error al realizar la consulta: " . mysqli_error($enlace));
    }
    return $resultado;
}

function ObtenerBolsasl7(){
    $enlace = obtenerConexion();
    $consulta = "SELECT * FROM sl7"; // Cambia esto por el nombre de tu tabla
    $resultado = mysqli_query($enlace, $consulta);

    if (!$resultado) {
        die("Error al realizar la consulta: " . mysqli_error($enlace));
    }
    return $resultado;
}

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