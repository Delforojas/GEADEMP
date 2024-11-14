
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css2.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../css/estilosmenudesplegable.css">


    
    <title>Menu desplegable</title>
    

    <title>principal</title>
        <?php
         // Activar reporte de errores para depuración
         ini_set('display_errors', '1');
         ini_set('display_startup_errors', '1');
         error_reporting(E_ALL);
         include('../controlador/validar_usuario.php');
        ?>
        

</head>
<body>
<h1 class="titulo-vacaciones"id="h1p">GEAMDEP </h1>
<header>
                            <div id="daohang">
                               
                            </div>
</header>


    </div>
</div>     
    <nav class="nav">
        <ul class="list">
            <li class="list__item">
                <div class="list__button">
                    <img src="../vista/asset/dashboard.svg" class="list__img">
                    <a href="#" class="nav__link">Inicio</a>
                </div> 
            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="asset/doc.svg" class="list__img">
                    <a href="#" class="nav__link">Produccion</a>
                    <img src="../vista/asset/arrow.svg" class="list__arrow">
                </div> 
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="../vista/vista_lp1.php" class="nav__link nav__link--inside">Linea Produccion 1</a>
                    </li>
                    <li class="list__inside">
                        <a href="../vista/vista_lp2.php" class="nav__link nav__link--inside">Linea Produccion 2</a>
                    </li>
                </ul>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="../vista/asset/stats.svg" class="list__img">
                    <a href="../vista/vista_bolsa_admin.php" class="nav__link">Area de administradores</a>
                </div>
            </li>
            <li class="list__item list__item--click">
                <div class="list__button list__button--click">
                    <img src="../vista/asset/doc.svg" class="list__img">
                    <a href="#" class="nav__link">Area del empleado 
                    </a>
                    <img src="../vista/asset/arrow.svg" class="list__arrow">
                </div> 
                <ul class="list__show">
                    <li class="list__inside">
                        <a href="../vista/comunicados.php" class="nav__link nav__link--inside">Comunicados</a>
                    </li>
                    <li class="list__inside">
                        <a href="../vista/nominas.php" class="nav__link nav__link--inside">Nominas</a>
                    </li>
                    <li class="list__inside">
                        <a href="../vista/vista_vacaciones.php" class="nav__link nav__link--inside">Vacaciones</a>
                    </li>
                    <li class="list__inside">
                        <a href="../vista/retenciones.php" class="nav__link nav__link--inside">IRPF</a>
                    </li>
                    <li class="list__inside">
                        <a href="../vista/menu.php" class="nav__link nav__link--inside">Menu comedor</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Imagen al lado del nav -->
    <div style="margin-left:40vh ;margin-top:  -100vh;">
        <div class="galeria-imagenes">
            <img src="../vista/imagenes/logod.png" alt="Logo 1">
            <img src="../vista/imagenes/d20a910c67a81bdd4296c6f29c442234.webp" alt="Logo 2">
            <img src="../vista/imagenes/deadpool-2016-3257944.webp" alt="Logo 3">
            <img src="../vista/imagenes/img2.rtve.jpeg" alt="Logo 4">
        </div>
    </div>
</div>
</div>
    <script src="../vista/javascript.js"></script>
</body>
</html>