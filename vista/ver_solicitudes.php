<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/css2.css">
    <link rel="stylesheet" href="../css/estilosmenudesplegable.css">
    <title>Gestión de Solicitudes de Vacaciones</title>
    <?php
        require_once("../controlador/validar_admin.php");
        require_once("../controlador/ver_solicitudes_controlador.php");
    ?>
</head>
<body>
    <h1 class="titulo-vacaciones" id="h1p">Gestión de Solicitudes de Vacaciones</h1>
    <header>
        <div id="daohang">
            <button><a href="vista_principal_admin.php">Volver a principal</a></button>
        </div>
    </header>

    <div class="contenedor-solicitudes">
        <?php
            // Llamar a la función para obtener las solicitudes de vacaciones
            $solicitudes = obtenerSolicitudes();

            if (count($solicitudes) > 0) {
                echo "<table border='1' cellpadding='10'>
                        <thead>
                            <tr>
                                <th>Nombre Usuario</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Días Solicitados</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>";

                foreach ($solicitudes as $solicitud) {
                    echo "<tr>
                            <td>" . $solicitud["nombre"] . " " . $solicitud["apellidos"] . "</td>
                            <td>" . $solicitud["fecha_inicio"] . "</td>
                            <td>" . $solicitud["fecha_fin"] . "</td>
                            <td>" . $solicitud["diasSolicitados"] . "</td>
                            <td>" . obtenerEstado($solicitud["estado"]) . "</td>
                            <td>";
                    if ($solicitud["estado"] == 1) { // Solo permitir aprobar o rechazar si está pendiente
                        echo "<form action='aprobar_rechazar_solicitud.php' method='POST' style='display:inline;'>
                                  <input type='hidden' name='idSolicitud' value='" . $solicitud["idSolicitud"] . "'>
                                  <input type='hidden' name='idUsuario' value='" . $solicitud["idUsuario"] . "'>
                                  <input type='hidden' name='idVacaciones' value='" . $solicitud["idVacaciones"] . "'>
                                  <button type='submit' name='estado' value='2'>Aprobar</button>
                                  <button type='submit' name='estado' value='3'>Rechazar</button>
                              </form>";
                    }
                    echo "</td>
                          </tr>";
                }

                echo "</tbody>
                      </table>";
            } else {
                echo "<p>No hay solicitudes de vacaciones.</p>";
            }
        ?>
    </div>
    <script src="../vista/javascript.js"></script>
</body>
</html>