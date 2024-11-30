<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../modelo/datos_conexion.php");
require_once("../modelo/modelo.php");
include '../config.php';

$enlace = obtenerConexion();

if (!empty($_POST['registro'])) {
    if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['clave'])) {
        echo "<script>
            alerta('Uno de los campos está vacío.', '" . $base_url . "/Administradores');
        </script>";
        exit();
    }

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $clave = $_POST['clave'];
    $idCargo = 2;

    $q = "INSERT INTO usuario (nombre, apellidos, clave, idCargo) 
          VALUES ('$nombre', '$apellidos', '$clave', $idCargo)";
    $resultado = mysqli_query($enlace, $q);

    if (!$resultado) {
        echo "<script>
            alerta('Error al registrar el usuario: " . mysqli_error($enlace) . "', '" . $base_url . "/Administradores');
        </script>";
        exit();
    }

    $nombre_limpio = preg_replace('/[^A-Za-z0-9_-]/', '', $nombre);
    $base_dir = realpath(__DIR__ . "/../assets/pdf/nominas");

    if (!is_dir($base_dir)) {
        echo "<script>
            alerta('Error: La carpeta base no existe.', '" . $base_url . "/Administradores');
        </script>";
        exit();
    }

    $ruta_carpeta = $base_dir . DIRECTORY_SEPARATOR . $nombre_limpio;

    if (!file_exists($ruta_carpeta)) {
        if (mkdir($ruta_carpeta, 0777, true)) {
            echo "<script>alert('Usuario registrado correctamente.');</script>";
            echo "<script>window.location.href = '" . $base_url . "/Administradores';</script>";
        } else {
            echo "<script>alert('Error al crear la carpeta del usuario.');</script>";
            echo "<script>window.location.href = '" . $base_url . "/Administradores';</script>";
        }
    } else {
        echo "<script>alert('La carpeta del usuario ya existe.');</script>";
        echo "<script>window.location.href = '" . $base_url . "/Administradores';</script>";
    }
    exit();
}