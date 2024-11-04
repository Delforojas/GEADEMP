<!DOCTYPE html>
<html>
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/css2.css">
        <link rel="stylesheet" href="../css/css5.css">
		<title>Formulario</title>
        <?php
         include('../controlador/validar_admin.php');
        ?>

	</head>
    <body>
    <div>
        <h1 class="titulo-vacaciones"id="h1p">Introduzca Proceso</h1>
            <header>
                <div id="daohang">
                    <button><a href="../vista/index.php">Volver a principal</a></button>
                </div>
            </header>
                          
    </div>
    <div class="contenedor">
<div class="card-form">
  <form action="../controlador/insercoin.php" method="POST"class="signup">
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
      <button type="button" id="enviarYCerrar" onclick="location.href='vista_bolsa_admin.php';">Volver</button>
    </div>
  </form>
</div>
</div>
<script src="../vista/javascript.js"></script>
	</body>

</html>
