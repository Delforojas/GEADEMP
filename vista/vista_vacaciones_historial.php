<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo1.css">
    <title>Historial de vacaciones</title>
    <?php
         include('../controlador/validar_usuario.php');
    ?>
  
</head>
<body>
    <div>
    <h1 class="btn-volver">Historial de vacaciones</h1>
    <form action="vista_vacaciones.php"> <!-- Evita el envío del formulario -->
            <button id=""class="btn-volver">Volver</button>
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
                        <a href="vista_vacaciones.php" class="nav__link nav__link--inside">Vacaciones</a>
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
    <?php
        include("../controlador/controlador_vacaciones.php") 
    ?>
    </div>
    <script src="app.js"></script>

</div>
    <script src="app.js"></script>
    </div>
</body>
</html>