<?php
// Incluir archivo de conexión y modelo
include("../modelo/datos_conexion.php");
include("../modelo/modelo.php");
session_start();

// Verifica que el usuario esté logueado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$enlace = obtenerConexion();

// Obtener los años y meses únicos para el desplegable
$queryMesAnio = "SELECT DISTINCT mes, anio FROM Nomina ORDER BY anio DESC, mes DESC";
$resultadoMesAnio = mysqli_query($enlace, $queryMesAnio);

$mesesAnios = [];
while ($fila = mysqli_fetch_assoc($resultadoMesAnio)) {
    $mesesAnios[] = $fila;
}

// Procesar la selección del usuario
$nominas = [];
if (isset($_POST['mes']) && isset($_POST['anio'])) {
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];
    $idUsuario = $_SESSION['idUsuario'];

    // Consultar las nóminas del usuario para el mes y año seleccionados
    $queryNominas = "SELECT n.mes, n.anio, n.enlace
                     FROM UsuarioNomina un
                     JOIN Nomina n ON un.idNomina = n.idNomina
                     WHERE un.idUsuario = ? AND n.mes = ? AND n.anio = ?";
    
    $stmt = $enlace->prepare($queryNominas);
    $stmt->bind_param("iss", $idUsuario, $mes, $anio);
    $stmt->execute();
    $resultadoNominas = $stmt->get_result();

    while ($fila = $resultadoNominas->fetch_assoc()) {
        $nominas[] = $fila;
    }

    $stmt->close();
}

mysqli_close($enlace);
