<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo1.css">
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
    <title>Bolsa Administradores</title>
</head>

  

<body>
    <div class="form-volver">
        <form action="index.php" method="get">
            <button type="submit" class="btn-volver">Volver a Principal</button>
        </form>
        <form action="formulario.php"> <!-- Evita el envío del formulario -->
            <button id=""class="btn-volver">Introducir bobinas</button>
        </form>
        <form action="registro_usuario.php"> <!-- Evita el envío del formulario -->
            <button id=""class="btn-volver">Registro de Usuario</button>
        </form>
        <form action="vista_vacaciones_admin.php"> <!-- Evita el envío del formulario -->
            <button id=""class="btn-volver">Gestionar vacaciones</button>
        </form>
    </div>
    <div class="contenedor-principal">
    <nav class="nav">
        <ul class="list">
            <li class="list__item">
                <div class="list__button">
                    <img src="asset/dashboard.svg" class="list__img">
                    <a href="index.php" class="nav__link">Inicio</a>
                </div> 
            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="asset/doc.svg" class="list__img">
                        <a href="#" class="nav__link">Programa</a>
                        <img src="asset/arrow.svg" class="list__arrow">
                </div> 
            <ul class="list__show">
                
                <li class="list__inside">
                    <a href="vista_sl4.php" class="nav__link nav__link--inside">SL4</a>
                </li>
                <li class="list__inside">
                    <a href="vista_sl7.php" class="nav__link nav__link--inside">SL7</a>
                </li>
                
            </ul>
            <li class="list__item">
                <div class="list__button">
                    <img src="asset/stats.svg" class="list__img">
                    <a href="vista_bolsa_admin.php" class="nav__link">Area de administradores</a>
                </div>
            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="asset/doc.svg" class="list__img">
                    <a href="#" class="nav__link">Area del empleado </a>
                    <img src="asset/arrow.svg" class="list__arrow">
                </div> 
                <ul class="list__show">
                <li class="list__inside">
                    <a href="comunicados.php" class="nav__link nav__link--inside">Comunicados</a>
                </li>
                <li class="list__inside">
                    <a href="nominas.php" class="nav__link nav__link--inside">Nominas</a>
                </li>
                <li class="list__inside">
                    <a href="retenciones.php" class="nav__link nav__link--inside">IRPF</a>
                </li>
                <li class="list__inside">
                    <a href="menu.php" class="nav__link nav__link--inside">Menu comedor</a>
                </li>
            </li>
        </ul>               
    </nav>
    <div class="contenido-include">
        <?php include('../controlador/bolsa_admin.php');?>
    </div>

</div>
    <script src="../vista/app.js"></script>
</body>

<html>