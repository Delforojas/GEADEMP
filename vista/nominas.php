<?php
    // Activar reporte de errores para depuración
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    include '../config.php'; // Incluir el archivo de configuración
    include '../controlador/validar_usuario.php'; // Validar usuario
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/principal.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/estilosmenudesplegable.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/nominas.css">

    <title> NOMINAS</title>
    
</head>
<h1 class="titulo-vacaciones"id="h1p">NOMINAS</h1>
        <header>         
            <div id="daohang">
                <button><a href="<?php echo $base_url; ?>/Inicio">Volver a principal</a></button>
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
                        

                    <li class="list__item">
                        <div class="list__button">
                            <img src="<?php echo $base_url; ?>/assets/nav/stats.svg" class="list__img">
                            <a href="<?php echo $base_url; ?>/Administradores" class="nav__link">Area de Administradores</a>
                            </div>
                    </li>
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="<?php echo $base_url; ?>/assets/nav/doc.svg" class="list__img">
                            <a href="#" class="nav__link">Area del empleado </a>
                            <img src="<?php echo $base_url; ?>/assets/nav/arrow.svg" class="list__arrow">
                        </div> 
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="<?php echo $base_url; ?>/Comunicados" class="nav__link nav__link--inside">Comunicados</a>
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
    <h3 class="titulo-vaca">Nóminas de <?= ($_SESSION['username'])?> </h3>
             <form action="<?php echo $base_url; ?>/controlador/controlador_Nominas.php" method="post">
                <label for="mes">Mes:</label>
                <select name="mes" id="mes">
                    <?php
                    $meses = [
                        "enero" => "Enero",
                        "febrero" => "Febrero",
                        "marzo" => "Marzo",
                        "abril" => "Abril",
                        "mayo" => "Mayo",
                        "junio" => "Junio",
                        "julio" => "Julio",
                        "agosto" => "Agosto",
                        "septiembre" => "Septiembre",
                        "octubre" => "Octubre",
                        "noviembre" => "Noviembre",
                        "diciembre" => "Diciembre"
                    ];
                    foreach ($meses as $numMes => $nombreMes): ?>
                        <option value="<?= $numMes ?>"><?= $nombreMes ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="anio">Año:</label>
                    <select name="anio" id="anio">
                        <option value="2024">2024</option>
                        
                    </select>
                
                <button type="submit">Consultar</button>
            </form>

            <?php
                // Inicializar las variables para evitar el error de "undefined variable"
                $mes = $_POST['mes'] ?? null;
                $anio = $_POST['anio'] ?? null;
                $nominas = $nominas ?? []; // Asegura que $nominas esté definido como un array
            ?>
        </div>        
    </div>
</div>         
          <script src="<?php echo $base_url; ?>/assets/js/javascript.js"></script>
</body>
</html>