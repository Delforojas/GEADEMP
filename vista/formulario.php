<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Formulario</title>
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

        <link rel="stylesheet" href="../css/estilo1.css">

	</head>
    <body>
       <div class="container">
        

        <form action="../controlador/insercoin.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="nombre" required>

            <label for="ancho">Ancho:</label>
            <input type="number" id="ancho" name="ancho" placeholder="ancho" required>

            <label for="espesor">Espesor:</label>
            <input type="number" id="espesor" name="espesor" placeholder="espesor" required>

            <button type="button" id="enviarYCerrar" class="btn-volver" name="registro">Enviar y Cerrar</button>
            
        </form>
    </div>

	</body>

</html>
