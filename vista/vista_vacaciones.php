<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo1.css">
    <title>Vacaciones del Usuario</title>
    <?php
         include('../controlador/validar_usuario.php');
    ?>
    
</head>
<body>
    <div class="form-volver">
        <form action="solicitar_vacaciones.php"> <!-- Evita el envío del formulario -->
            <button class="btn-volver">Solicitar vacaciones</button>
        </form>
        <form action="vista_vacaciones_historial.php"> <!-- Evita el envío del formulario -->
            <button class="btn-volver">Historial</button>
        </form>
        <form action="index.php"> <!-- Evita el envío del formulario -->
            <button class="btn-volver">Volver</button>
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
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="asset/stats.svg" class="list__img">
                    <a href="vista_bolsa_admin.php" class="nav__link">Area de administradores</a>
                </div>
            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="asset/doc.svg" class="list__img">
                    <a href="#" class="nav__link">Area del empleado 
                    </a>
                    <img src="asset/arrow.svg" class="list__arrow">
                </div> 
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="nominas.php" class="nav__link nav__link--inside">Nominas</a>
                    </li>
                    <li class="list__inside">
                        <a href="login_vacaciones.php" class="nav__link nav__link--inside">Vacaciones</a>
                    </li>
                    <li class="list__inside">
                        <a href="retenciones.php" class="nav__link nav__link--inside">IRPF</a>
                    </li>
                    <li class="list__inside">
                        <a href="menu.php" class="nav__link nav__link--inside">Menu comedor</a>
                    </li>
                </ul>
            </li>
        </ul>
    
    </nav>
    <div class="contenido">
        <h1>Total de días de vacaciones disponibles: 
            <?php 
                $dias_totales = include("../controlador/controlador_total_dias.php");
                // Mostrar el mensaje con el nombre del usuario y los días restantes de vacaciones
                echo "$usuario, te quedan $dias_totales días de vacaciones.";
            ?>
        </h1>
    </div>
    <script src="app.js"></script>

</div>
    
</body>
</html>
