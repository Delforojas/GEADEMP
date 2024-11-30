
<?php
    // Activar reporte de errores para depuración
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    include '../config.php'; // Incluir el archivo de configuración
    include '../controlador/validar_admin.php'; // Validar usuario
    ?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/principal.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/css/formularios.css">
		<title>Formulario</title>
    

	</head>
    <body>
    <div>
        <h1 class="titulo-vacaciones"id="h1p">Introduzca Proceso</h1>
            <header>
                <div id="daohang">
                  <div id="daohang">
                     <a href="..vista/index.php" class="btn">Volver a principal</a>
                  </div>
                </div>
            </header>
                          
    </div>
    <div class="contenedor">
<div class="card-form">
  <form action="<?php echo $base_url ?>/controlador/insercoin.php" method="POST"class="signup">
    <div class="form-title">Introduzca Proceso</div>
    <div class="form-body">
      <div class="row">
        <input type="text" placeholder="Nombre*"  name="nombre" id="Nombre" required>
      </div>
      <div class="row">
        <input type="text" placeholder="criterio1*"name="criterio1" id="criterio1" required>
      </div>
      <div class="row">
        <input type="text" placeholder="criterio2*" name="criterio2" id="criterio2" required>
      </div>
    </div>
    <div class="rule"></div>
    <div class="form-footer">
      <button type="submit" id="enviarYCerrar" value="Registrar" name="registro">Introducir</button>
      <button type="button" id="enviarYCerrar" onclick="location.href='<?php echo $base_url ?>/Administradores ';">Volver</button>
    </div>
  </form>
</div>
</div>
<script src="<?php echo $base_url; ?>/assets/js/javascript.js"></script>
	</body>

</html>
