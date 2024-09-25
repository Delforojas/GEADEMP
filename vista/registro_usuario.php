<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir Font Awesome para los iconos -->
    <link rel="stylesheet" href="../css/estilo1.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <?php
        session_start();
        
        // Verifica si el usuario ha iniciado sesión y si es un administrador
        if (!isset($_SESSION['username']) || $_SESSION['rol'] != 1) {
            // Si no es administrador o no ha iniciado sesión, redirigir a la página de inicio de sesión
            header("Location: login.php");
            exit();
        }
            $usuario = $_SESSION['username'];
        
            echo "<div id='contenedor-bienvenida'>
                        <img src='imagenes/logo.png' alt='Imagen de bienvenida' id='imagen-bienvenida'>
                        <p id='bienve'>Bienvenido, $usuario  </p>
                        <form action='../controlador/salir.php' method='post'>
                            <button type='submit' class='btn-salir'>Salir</button>
                        </form>
                    </div>"
        ?>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .padre {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        .titulo {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .nombre, .apellidos, .usuario, .clave, .cuenta {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .cuenta {
            text-align: center;
        }
        .boton {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .boton:hover {
            background: #0056b3;
        }
        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
 
    </style>
</head>
<div class="container">
            <form action="" method="POST" class="formulario">
                <h2 class=titulo>Registrar</h2>
                <?php
                include("../modelo/datos_conexion.php");
                include("../controlador/controladorregistro.php");

                ?>
               <div class="padre">
                    <div class="nombre">
                        <label for="Nombres">Nombres:</label>
                        <input type="text" name="nombre" id="Nombres">
                    </div>
                    <div class="usuario">
                        <label for="Usuario">Usuario:</label>
                        <input type="text" name="usuario" id="Usuario">
                    </div>
                    <div class="clave">
                        <label for="Contraseña">Contraseña:</label>
                        <input type="text" name="clave" id="Contraseña">
                    </div>
                    <div class="cuenta">
                        <input class="boton" type="submit"id="cerrarVentana" value="Registrar" name="registro">
                        <a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>
                    </div>
                </div>
            </form>
</div>