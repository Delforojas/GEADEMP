<?php
    include '../config.php'; // Incluir el archivo de configuración
    include '../controlador/validar_usuario.php'; // Validar usuario
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/principal.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/vistavacaciones.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/estilosmenudesplegable.css">
    <title>Solicitar Vacaciones</title>
</head>
<body>
    <h1 class="titulo-vacaciones"id="h1p">SOLICITAR VACACIONES</h1>
    <header>
        <div id="daohang">
                <button><a href="<?php echo $base_url; ?>/Vacaciones">Volver a principal</a></button>
        </div>
    </header>
    </div>
    <div class="contenedor-flex">  
    <div class="contenedor-principal">
    <nav class="nav">
        <ul class="list">
            <li class="list__item">
                <div class="list__button">
                    <img src="<?php echo $base_url; ?>/assets/nav/dashboard.svg" class="list__img">
                    <a href="<?php echo $base_url; ?>/Inicio" class="nav__link">Inicio</a>
                </div> 
            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="<?php echo $base_url; ?>/assets/nav/doc.svg" class="list__img">
                    <a href="#" class="nav__link">Produccion</a>
                    <img src="<?php echo $base_url; ?>/assets/nav/arrow.svg" class="list__arrow">
                </div> 
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="<?php echo $base_url; ?>/VistaLP1" class="nav__link nav__link--inside">Linea Produccion 1</a>
                    </li>
                    <li class="list__inside">
                        <a href="<?php echo $base_url; ?>/VistaLP2" class="nav__link nav__link--inside">Linea Produccion 2</a>
                    </li>
                </ul>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="<?php echo $base_url; ?>/assets/nav/stats.svg" class="list__img">
                    <a href="<?php echo $base_url; ?>/Administradores" class="nav__link">Area de administradores</a>
                </div>
            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="<?php echo $base_url; ?>/assets/nav/doc.svg" class="list__img">
                    <a href="#" class="nav__link">Area del empleado 
                    </a>
                    <img src="<?php echo $base_url; ?>/assets/nav/arrow.svg" class="list__arrow">
                </div> 
                <ul class="list__show">
                <li class="list__inside">
                        <a href="<?php echo $base_url; ?>/Comunicados" class="nav__link nav__link--inside">Comunicados</a>
                    </li>
                    <li class="list__inside">
                        <a href="<?php echo $base_url; ?>/Nominas" class="nav__link nav__link--inside">Nominas</a>
                    </li>
                    <li class="list__inside">
                        <a href="<?php echo $base_url; ?>/Vacaciones" class="nav__link nav__link--inside">Vacaciones</a>
                    </li>
                    <li class="list__inside">
                        <a href="<?php echo $base_url; ?>/IRPF" class="nav__link nav__link--inside">IRPF</a>
                    </li>
                    <li class="list__inside">
                        <a href="<?php echo $base_url; ?>/Menucomedor" class="nav__link nav__link--inside">Menu comedor</a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>
</div>
    <div class="contenido-include2">
    <form action="<?php echo $base_url; ?>//controlador/controlador_solicitar_vacaciones.php" method="post">
        <h3  class='titulo-vaca'>Solicitar Vacaciones </h2>
        <label for="age">Fecha de Inicio</label>
        <input type="date" name="fecha_inicio" required>
        <label for="age">Fecha de Final</label>
        <input type="date" name="fecha_fin" required>
        
        <button type="submit" name="solicitar_vacaciones"class="sol-button">Solicitar Vacaciones </button>
    </form>
    </div>
    <script src="<?php echo $base_url; ?>/assets/js/javascript.js"></script>
</body>
</html>

