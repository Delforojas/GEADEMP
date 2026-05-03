<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css2.css">
    <link rel="stylesheet" href="../css/estilosmenudesplegable.css">
    <title>Consulta de Nóminas</title>
</head>
<body>

<h1 class="titulo-vacaciones" id="h1p">Nóminas Usuario</h1>

<header>         
    <div id="daohang">
        <button><a href="../vista/index.php">Volver a principal</a></button>
        <button><a href="../vista/nominas.php">Consultar otra Nomina</a></button>
    </div>
</header>

<div class="contenedor-flex">  
    <div class="contenedor-principal">
        <nav class="nav">
            <ul class="list">
                <li class="list__item">
                    <div class="list__button">
                        <img src="../vista/asset/dashboard.svg" class="list__img">
                            <a href="../vista/index.php" class="nav__link">Inicio</a>
                    </div> 
                </li>
                <li class="list__item list__item--click">
                    <div class="list__button list__button--click">
                        <img src="../vista/asset/doc.svg" class="list__img">
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
                        

                    <li class="list__item">
                        <div class="list__button">
                            <img src="../vista/asset/stats.svg" class="list__img">
                            <a href="../vista/vista_bolsa_admin.php" class="nav__link">Area de Administradores</a>
                            </div>
                    </li>
                    <li class="list__item list__item--click">
                        <div class="list__button list__button--click">
                            <img src="../vista/asset/doc.svg" class="list__img">
                            <a href="#" class="nav__link">Area del empleado </a>
                            <img src="../vista/asset/arrow.svg" class="list__arrow">
                        </div> 
                        <ul class="list__show">
                            <li class="list__inside">
                                <a href="../vista/comunicados.php" class="nav__link nav__link--inside">Comunicados</a>
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
                </li>
            </ul>           
        </nav>
        <div class="table-title">
            <?php include('../controlador/controlador_nomina_usuario.php'); ?>
        </div>  
    <div>
</div>
    
</div>         
<script src="../vista/javascript.js"></script>
</body>
</html>
