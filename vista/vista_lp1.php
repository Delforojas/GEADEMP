<!DOCTYPE html>
<?php
    // Activar reporte de errores para depuración
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    include '../config.php'; // Incluir el archivo de configuración
    include '../controlador/validar_usuario.php'; // Validar usuario
    ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/principal.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/estilosmenudesplegable.css">
    <title>Linea Produccion 1</title>
        
</head>
<body>
    <h1 class="titulo-vacaciones"id="h1p">Linea de Produccion 1</h1>
    <header>
        <div id="daohang">
            <button><a href="index.php">Volver a Principal</a></button>
            <form id="ordenForm" action="<?php echo $base_url; ?>/ResultadoLP1" method="POST">   
            <button type="submit" class=>Ordenar</button>
                    <select name="orden" id="ordenSelect" onchange="cambiarControlador()">
                    <optgroup label="Criterio1">
                        <option value="AASC">ASC (criterio 1)</option>
                        <option value="ADESC">DESC (Criterio 2)</option>
                    </optgroup>
                    <optgroup label="Criterio2">
                        <option value="ASC">ASC (Criterio 2)</option>
                        <option value="DESC">DESC (Criterio 2)</option>
                    </optgroup>
                    </select>
            </form>
        </div>
    </header>
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
                        <img src="<?php echo $base_url;?>/assets/nav/doc.svg" class="list__img">
                            <a href="#" class="nav__link">Produccion</a>
                            <img src="<?php echo $base_url;?>/assets/nav/arrow.svg" class="list__arrow">
                    </div> 
                    <ul class="list__show">
                        <li class="list__inside">
                            <a href="<?php echo $base_url; ?>/VistaLP2" class="nav__link nav__link--inside">Linea Produccion 2</a>
                        </li>
                    </ul>
                        

                    <li class="list__item">
                        <div class="list__button">
                            <img src="<?php echo $base_url;?>/assets/nav/stats.svg" class="list__img">
                            <a href="<?php echo $base_url; ?>/Administradores" class="nav__link">Area de Administradores</a>
                            </div>
                    </li>
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="<?php echo $base_url;?>/assets/nav/doc.svg" class="list__img">
                            <a href="#" class="nav__link">Area del empleado </a>
                            <img src="<?php echo $base_url;?>/assets/nav/arrow.svg" class="list__arrow">
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
                </li>
            </ul>           
        </nav>
    </div>
        <div class="contenido-include">
            <?php include('../controlador/controlador_linea_produccion1.php'); ?>
        </div>  
</div>         
    <script src="<?php echo $base_url; ?>/assets/js/javascript.js"></script>
</body>
</html>