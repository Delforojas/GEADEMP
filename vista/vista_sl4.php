<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo1.css">
    <title>Bolsa SL4</title>
    <?php
         include('../controlador/validar_usuario.php');
        ?>
        
</head>
<body>
    <div class="form-volver">
        <h1 class="btn-volver">Sl4</h1>
        <form action="index.php" method="post">
            <button type="submit" class="btn-volver">Volver Inicio</button>
        </form>
        <form id="ordenForm" action="../vista/vista_resultado_sl4.php" method="POST">
        <button type="submit" class="btn-volver">Ordenar</button>
            <select name="orden" id="ordenSelect" onchange="cambiarControlador()">
                <optgroup label="Espesor">
                    <option value="ASC">ASC (Espesor)</option>
                    <option value="DESC">DESC (Espesor)</option>
                </optgroup>
                <optgroup label="Ancho">
                    <option value="AASC">ASC (Ancho)</option>
                    <option value="ADESC">DESC (Ancho)</option>
                </optgroup>
            </select>
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
                            <a href="vista_sl7.php" class="nav__link nav__link--inside">SL7</a>
                        </li>
                    </ul>
                        

                    <li class="list__item">
                        <div class="list__button">
                            <img src="asset/stats.svg" class="list__img">
                            <a href="vista_bolsa_admin.php" class="nav__link">Area de Administradores</a>
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
                </li>


            </ul>
                    
        </nav>
        <div class="contenido-include">
            <?php include('../controlador/bolsa_sl4.php'); ?>
        </div>
    </div>
                    
    <script src="app.js"></script>
    
</body>
</html>