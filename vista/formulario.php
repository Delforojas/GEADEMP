<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Formulario</title>
        <?php
         include('../controlador/validar_admin.php');
        ?>
        
        <link rel="stylesheet" href="../css/estilo1.css">

	</head>
    <body>
        <h2 class=btn-volver>Introducir bobina</h2>


       <div class="container">
        <form action="../controlador/insercoin.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="nombre" required>

            <label for="ancho">Ancho:</label>
            <input type="number" id="ancho" name="ancho" placeholder="ancho" required>

            <label for="espesor">Espesor:</label>
            <input type="number" id="espesor" name="espesor" placeholder="espesor" required>

            <button type="submit" id="enviarYCerrar" class="btn-volver" name="registro">Enviar y Cerrar</button>
        </form>
    </div>

	</body>

</html>
