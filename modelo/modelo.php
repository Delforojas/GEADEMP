<?php
require_once("datos_conexion.php");
function obtenerConexion() {
    global $servidor, $user, $clave, $baseDedatos;

    $enlace = mysqli_connect($servidor, $user, $clave, $baseDedatos);
    if (!$enlace) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    return $enlace;
}

class Database {
    // Atributos públicos
    public $servidor = "localhost";
    public $user = "root";
    public $clave = "";
    public $baseDatos = "acx";
    public $enlace;

    // Constructor de la clase
    public function __construct($servidor = "localhost", $user = "root", $clave = "", $baseDatos = "acx") {
        $this->servidor = $servidor;
        $this->user = $user;
        $this->clave = $clave;
        $this->baseDatos = $baseDatos;
    }

}

class linea_produccion {
    public $id;
    public $nombre;
    public $criterio1;
    public $criterio2;


    public  function ObtenerLineaProduccion(){
        $enlace = obtenerConexion();
        $consulta = "SELECT * FROM linea_produccion"; // Cambia esto por el nombre de tu tabla
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            die("Error al realizar la consulta: " . mysqli_error($enlace));
        }
        return $resultado;
    }
    public  function insertarEnlineaProduccion($nombre, $criterio1, $criterio2) {
        $enlace = obtenerConexion();
        $consulta = "INSERT INTO linea_produccion (nombre, criterio1, criterio2) VALUES (?,?,?)";
        $resultado = mysqli_prepare($enlace, $consulta);
        
        if (!$resultado) {
                die("Error al preparar la consulta: " . mysqli_error($enlace));
            }
        // Vincular los parámetros (s = string, i = entero)
        mysqli_stmt_bind_param($resultado, "sii", $nombre, $criterio1, $criterio2);

        // Ejecutar la consulta
        $ejecucion = mysqli_stmt_execute($resultado);

        if (!$ejecucion) {
            die("Error al ejecutar la consulta: " . mysqli_stmt_error($resultado));
        }

        // Cerrar la declaración
        mysqli_stmt_close($resultado);
        mysqli_close($enlace);

        return $ejecucion; // Devuelve true si fue exitosa
    }

    public  function obtenerCheckbox($enlace, $id) {
        $consulta = "SELECT nombre, criterio1, criterio2 FROM linea_produccion WHERE id = ?";
        $checkbox = mysqli_prepare($enlace, $consulta);
        if (!$checkbox) {
            die("Error al preparar la consulta: " . mysqli_error($enlace));
        }
        mysqli_stmt_bind_param($checkbox, "i", $id);
        mysqli_stmt_execute($checkbox);
        $resultado = mysqli_stmt_get_result($checkbox);
        // Cerrar la sentencia
        
        mysqli_stmt_close($checkbox);
        return $resultado; // Retorna el resultado
    }
    public function generarTablaSinCheckbox($resultado, $action = "procesar.php"){ 
        
        echo '<div class="table-title">';
         echo "<h3  class='titulo-vaca'>Produccion</h3>";
        echo '<form action="' . htmlspecialchars($action) . '" method="post">';
        echo "<table class ='table-fill'><tr>";
    
        // Imprimir encabezados de la tabla
        while ($field = mysqli_fetch_field($resultado)) {
            echo "<th class='text-left'>" . htmlspecialchars($field->name) . "</th>";
        }
        echo "</tr>";
    
        // Imprimir datos de la tabla
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            foreach ($row as $column) {
                echo "<td class='text-left'>" . htmlspecialchars($column) . "</td>";
            }
            echo "</tr>";
        }
    
        echo "</table>";
        echo "</form>";
        echo '</div>';
    }
    function generarTablaConCheckboxes($resultado, $action = "../controlador/procesar.php") {
        echo '<div class="table-title">';
         echo "<h3  class='titulo-vaca'>Produccion</h3>";
        echo '<form action="' . htmlspecialchars($action) . '" method="post">';
        echo "<table class ='table-fill'><tr>";
    
        // Imprimir encabezados de la tabla
        while ($field = mysqli_fetch_field($resultado)) {
            echo "<th class='text-left'>" . htmlspecialchars($field->name) . "</th>";
        }
        // Añadir un encabezado para la columna de selección
        echo "<th class='text-left'>Seleccionar</th>";
        echo "</tr>";
    
        // Imprimir datos de la tabla con checkboxes
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            foreach ($row as $column) {
                echo "<td class='text-left'>" . htmlspecialchars($column) . "</td>";
            }
            // Añadir checkbox para cada fila
            echo "<td class='text-left'><input type='checkbox' name='seleccionados[]' value='" . htmlspecialchars($row['id']) . "'></td>";
            echo "</tr>";
        }
        
        echo "</table>";
        // Botón de envío para procesar el formulario
        echo "<input type='submit' value='Enviar' class ='btn-salir'>";
        echo "</form>";
    
    }

    public  function eliminardatos($enlace, $id){
        // Eliminar el registro de la tabla bolsa
        $eliminar = "DELETE FROM linea_produccion WHERE id = ?";
        $Delete = mysqli_prepare($enlace, $eliminar);
        mysqli_stmt_bind_param($Delete, "i", $id);
        mysqli_stmt_execute($Delete);
        mysqli_stmt_close($Delete);
    }

    public function obtenerDatosFormulario() {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
        $criterio1 = isset($_POST['criterio1']) ? (int)$_POST['criterio1'] : null; 
        $criterio2 = isset($_POST['criterio2']) ? (int)$_POST['criterio2'] : null;

        return [$nombre, $criterio1, $criterio2]; // Devuelve un array con los datos
    }
}

    class lp1 extends linea_produccion {
            public  function insertarslp1 ($enlace, $nombre, $criterio1, $criterio2) {
                $insertar = "INSERT INTO lp1 (nombre, criterio1, criterio2) VALUES (?, ?, ?)";
                $insertlp1 = mysqli_prepare($enlace, $insertar);
                if (!$insertlp1) {
                    die("Error al preparar la consulta: " . mysqli_error($enlace));
                }
                mysqli_stmt_bind_param($insertlp1, "sii", $criterio1, $criterio2, $criterio3);
                $ejecucion = mysqli_stmt_execute($insertlp1);
                if (!$ejecucion) {
                    die("Error al ejecutar la consulta: " . mysqli_stmt_error($insertlp1));
                }
                mysqli_stmt_close($insertlp1);
            }    

            public function Obtenerlp1(){
                $enlace = obtenerConexion();
                $consulta = "SELECT * FROM lp1"; // Cambia esto por el nombre de tu tabla
                $resultado = mysqli_query($enlace, $consulta);
                
                if (!$resultado) {
                    die("Error al realizar la consulta: " . mysqli_error($enlace));
                }
                return $resultado;
            }

            public function obtenerDatosOrdenadoslp1($orden) {
                    // Conexión a la base de datos
                $enlace = obtenerConexion();  // Asume que tienes definida la función obtenerConexion()
                    
                    // Inicializamos la variable de consulta
                $q = "SELECT * FROM lp1";
                    
                    // Determina la consulta según el valor de 'orden'
                if ($orden == "ASC") {
                    $q .= " ORDER BY criterio1 ASC";
                } elseif ($orden == "DESC") {
                    $q .= " ORDER BY criterio1 DESC";
                } elseif ($orden == "AASC") {
                    $q .= " ORDER BY criterio2 ASC";
                } elseif ($orden == "ADESC") {
                    $q .= " ORDER BY criterio2 DESC";
                }
                    
                // Ejecuta la consulta
                $resultado = $enlace->query($q);
                    
                // Verificar si hubo errores en la consulta
                if ($resultado === false) {
                    die('Error en la consulta: ' . $enlace->error);
                }
                    
                // Retorna el resultado de la consulta
                return $resultado;
            }
            function mostrarDatoslp1($resultado) {
                if ($resultado->num_rows > 0) {
                    // Prepara los datos para mostrarlos en la vista principal
                    echo "<div class='table-title'>";
                     echo "<h3  class='titulo-vaca'>Linea de Produccion 1</h3>";
                    echo "<table class='table-fill'>";
                    echo "<tr>
                            <th class='text-left'>ID</th>
                            <th class='text-left'>Nombre</th>
                            <th class='text-left'>Criterio 1</th>
                            <th class='text-left'>Criterio 2</th>
                          </tr>";
                
                    // Recorre los resultados y los muestra en filas de la tabla
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['criterio1']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['criterio2']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";  // Cierre de div para la tabla
                } else {
                    echo "No hay datos para mostrar.";
                }
            }
            
    }
      
        
    class lp2 extends linea_produccion {
        public function insertarlp2($enlace, $nombre, $criterio1, $criterio2) {
            $insertar = "INSERT INTO lp2 (nombre, criterio1, criterio2) VALUES (?, ?, ?)";
            $insertlp2 = mysqli_prepare($enlace, $insertar);
            if (!$insertlp2) {
                die("Error al preparar la consulta: " . mysqli_error($enlace));
            }

            mysqli_stmt_bind_param($insertlp2, "sii", $nombre, $criterio1, $criterio2);
            $ejecucion = mysqli_stmt_execute($insertlp2);
            if (!$ejecucion) {
                die("Error al ejecutar la consulta: " . mysqli_stmt_error($insertlp2));
            }

            mysqli_stmt_close($insertlp2);

        }
        
        function Obtenerlp2(){
            $enlace = obtenerConexion();
            $consulta = "SELECT * FROM lp2"; // Cambia esto por el nombre de tu tabla
            $resultado = mysqli_query($enlace, $consulta);
        
            if (!$resultado) {
                die("Error al realizar la consulta: " . mysqli_error($enlace));
            }
            return $resultado;
        }
        

        public function obtenerDatosOrdenadoslp2($orden) {
            // Conexión a la base de datos
            $enlace = obtenerConexion();  // Asume que tienes definida la función obtenerConexion()
            
            // Inicializamos la variable de consulta
            $q = "SELECT * FROM lp2";
            
            // Determina la consulta según el valor de 'orden'
            if ($orden == "ASC") {
                $q .= " ORDER BY criterio1 ASC";
            } elseif ($orden == "DESC") {
                $q .= " ORDER BY criterio1 DESC";
            } elseif ($orden == "AASC") {
                $q .= " ORDER BY criterio2 ASC";
            } elseif ($orden == "ADESC") {
                $q .= " ORDER BY criterio2 DESC";
            }
            
            // Ejecuta la consulta
            $resultado = $enlace->query($q);
            
            // Verificar si hubo errores en la consulta
            if ($resultado === false) {
                die('Error en la consulta: ' . $enlace->error);
            }
            
            // Retorna el resultado de la consulta
            return $resultado;
        }
        function mostrarDatoslp2($resultado) {
            if ($resultado->num_rows > 0) {
                // Prepara los datos para mostrarlos en la vista principal
                echo "<div class='table-title'>";
                 echo "<h3  class='titulo-vaca'>Lista Produccion 2</h3>";
                echo "<table class='table-fill'>";
                echo "<tr>
                        <th class='text-left'>ID</th>
                        <th class='text-left'>Nombre</th>
                        <th class='text-left'>Criterio 1</th>
                        <th class='text-left'>Criterio 2</th>
                      </tr>";
            
                // Recorre los resultados y los muestra en filas de la tabla
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['criterio1']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['criterio2']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";  // Cierre de div para la tabla
            } else {
                echo "No hay datos para mostrar.";
            }
        }
        
    }

class Usuario {
    public $id;
    public $nombre;
    public $usuario;
    public $clave;
    public $id_cargo;
    public $dias_vacaciones;

    

    public  function verificarUsuario($usuario, $password){      
            // Preparar la consulta SQL para verificar el usuario y la contraseña
            $q = $enlace->prepare("SELECT u.id, u.nombre, u.apellidos, u.clave, u.status, r.nombre AS rol 
                                    FROM usuarios u 
                                    LEFT JOIN roles r ON u.rol_id = r.id 
                                    WHERE u.usuario = ? AND u.clave = ? AND u.status = 1");
            
            // Enlazar los parámetros (usuario y contraseña)
            $q->bind_param("ss", $usuario, $password);
            // Ejecutar la consulta
            $q->execute();
            // Obtener el resultado de la consulta
            $resultado = $q->get_result();
            // Verificar si se obtuvo algún resultado (usuario válido)
            if ($resultado->num_rows > 0) {
                // Obtener los datos del usuario
                $row = $resultado->fetch_assoc();

                // Guardar los datos del usuario en la sesión
                $_SESSION['username'] = $row['nombre'];
                $_SESSION['rol'] = $row['rol'];

                // Mostrar mensaje de éxito
                echo '<div class="alert alert-success">Login exitoso</div>';

                // Redirigir al usuario según su rol (en este caso, a la vista de administrador)
                header("Location: vista_bolsa_admin.php");
                exit(); // Asegurarse de que el script se detiene después de la redirección
            } else {
                // Si no se encuentra un usuario válido, mostrar mensaje de error
                echo '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
            }
            // Cerrar el statement
            $q->close();
        }
    
    public  function verificarCredenciales($usuario, $password) {
            $enlace = obtenerConexion();
            // Consulta para verificar el usuario y la contraseña
            $consulta = "SELECT id_cargo, nombre FROM usuarios WHERE usuario = ? AND clave = ?";
        
            // Preparar la consulta para evitar inyecciones SQL
            $q = $enlace->prepare($consulta);
            if ($q === false) {
                die('Error al preparar la consulta: ' . $enlace->error);
            } 
            // Vincular los parámetros a la consulta
            $q->bind_param('ss', $usuario, $password);
            // Ejecutar la consulta
            $q->execute();
            // Obtener el resultado
            $resultado = $q->get_result();
            if ($resultado && $resultado->num_rows > 0) {
                // Extraer los datos del usuario
                $filas = $resultado->fetch_assoc();
        
                // Guardar los datos en la sesión
                $_SESSION['username'] = $filas['nombre'];
                $_SESSION['rol'] = $filas['id_cargo'];
        
                // Redirigir según el rol del usuario
                if ($filas['id_cargo'] == 1) {
                    // Redirección para el administrador
                    header("Location: vista_bolsa_admin.php");
                    exit();
                } elseif ($filas['id_cargo'] == 2) {
                    // Redirección para el usuario normal
                    header("Location: index.php");
                    exit();
                }
            } else {
                // Mostrar un mensaje si el usuario o la contraseña son incorrectos
                echo '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
            }
        
            // Cerrar el statement
            $q->close();
        }
        

        
    } 
        class Cargo {
            public $id;
            public $descripcion;
        
     }
class Vacaciones {
        // Atributos públicos de la clase
    public $id;
    public $usuario_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $estado;
    public $dias_vacaciones;
    public $dias_solicitados;


    public function obtenerVacacionesPorUsuario($enlace, $usuario_id) {
        $consulta = "SELECT 
                        u.nombre, 
                        u.dias_vacaciones AS total_dias_vacaciones,
                        v.estado,
                        v.dias_solicitados
                    FROM 
                        usuarios u 
                    LEFT JOIN 
                        vacaciones v ON u.id = v.usuario_id 
                    WHERE 
                        u.id = ?";
    
        $q = $enlace->prepare($consulta);
        $q->bind_param('i', $usuario_id);
        $q->execute();
    
        $resultado = $q->get_result();
    
        
        $vacaciones_data = [];
    
        
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $vacaciones_data[] = $fila; 
            }
        } else {
            echo "No se encontraron vacaciones para el usuario con ID: " . htmlspecialchars($usuario_id) . ".";
        }
    
        $q->close();
    
        return $vacaciones_data;
    }
    function obtenerDiasVacacionesUsuario($enlace, $usuario_id) {

        $usuario_id = mysqli_real_escape_string($enlace, $usuario_id);
    
        $consulta = "SELECT dias_vacaciones FROM usuarios WHERE id = '$usuario_id'";
    
        $resultado = mysqli_query($enlace, $consulta);
    
        if (!$resultado) {
            die("Error en la consulta: " . mysqli_error($enlace));
        }
    
        if (mysqli_num_rows($resultado) > 0) {
            $usuario = mysqli_fetch_assoc($resultado);
            return $usuario['dias_vacaciones'];
        } else {
            return null;
        }
    }
    public function mostrarDiasRestantes($dias_restantes) {
        echo "<br>Días restantes: " . htmlspecialchars($dias_restantes) . "<br>";
        if ($dias_restantes <= 0) {
            echo "<p style='color: red; font-weight: bold;'>No puedes realizar más solicitudes de vacaciones, ya que no te quedan días disponibles.</p>";
        }
    }
    public function manejarSolicitudVacaciones($enlace, $accion, $vacacion_id, $usuario_id, $dias_solicitados) {
        
        $dias_disponibles = $this->obtenerDiasVacacionesDisponibles($enlace, $usuario_id);
    
        if ($accion === 'aprobar') {
            
            if ($dias_disponibles >= $dias_solicitados) {
                
                $this->actualizarDiasVacaciones($enlace, $usuario_id, $dias_solicitados); 
    
                $consulta = "UPDATE vacaciones SET estado = 'aprobada' WHERE id = ?";
                $q = $enlace->prepare($consulta);
                $q->bind_param('i', $vacacion_id);
                $q->execute();
                $q->close();
    
                return "Solicitud aprobada y días actualizados.";
            } else {
                return "No puedes aprobar la solicitud porque no hay suficientes días de vacaciones disponibles.";
            }
        } elseif ($accion === 'rechazar') {
            // Lógica para rechazar la solicitud
            $consulta = "UPDATE vacaciones SET estado = 'rechazada' WHERE id = ?";
            $q = $enlace->prepare($consulta);
            $q->bind_param('i', $vacacion_id);
            $q->execute();
            $q->close();
    
            return "Solicitud rechazada. No se han modificado los días de vacaciones."; 
    
        return "Acción no válida.";
    }
}   
    public function obtenerDiasVacacionesDisponibles($enlace, $usuario_id) {
        $consulta = "SELECT dias_vacaciones FROM usuarios WHERE id = ?";
        $q = $enlace->prepare($consulta);
        $q->bind_param('i', $usuario_id);
        $q->execute();
        $resultado = $q->get_result();
        
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['dias_vacaciones']; // Retorna los días de vacaciones disponibles
        } else {
            return 0; // Si no se encuentra el usuario, retorna 0
        }
        
        $q->close();
    }
    
    
    
    
    public function obtenerVacaciones($enlace, $usuario_id) {
                
            $consulta = "SELECT fecha_inicio, fecha_fin, estado FROM vacaciones WHERE usuario_id = '$usuario_id'";
            $resultado = mysqli_query($enlace, $consulta);
            $tablaHTML = '';

            echo ''; 

            if (mysqli_num_rows($resultado) > 0) {
                echo '<div class="table-title">';
                echo "<h3  class='titulo-vaca'>Historial de Solicitudes</h3>";
                echo '<table class="table-fill">';
                echo '<thead><tr><th class="text-left">Fecha de inicio</th><th class="text-left">Fecha de fin</th><th class="text-left">Estado</th><th class="text-left">Dias Solicitados</th></tr></thead>'; 
                echo '<tbody>';
                
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    // Calcular la cantidad de días entre las fechas
                    $fecha_inicio = $fila['fecha_inicio'];
                    $fecha_fin = $fila['fecha_fin'];
            
                    // Usamos DateTime para calcular la diferencia de días
                    $inicio = new DateTime($fecha_inicio);
                    $fin = new DateTime($fecha_fin);
                    $diferencia = $inicio->diff($fin);
                    $dias_solicitados = $diferencia->days + 1;  // Sumar 1 para incluir el día de inicio
                    
                    // Mostrar las vacaciones en una tabla
                    echo '<tr>';
                    echo '<td class="text-left">' . htmlspecialchars($fecha_inicio) . '</td>';
                    echo '<td class="text-left">' . htmlspecialchars($fecha_fin) . '</td>';
                    echo '<td class="text-left">' . htmlspecialchars($fila['estado']) . '</td>';
                    echo '<td class="text-left">' . htmlspecialchars($dias_solicitados) . '</td>';  // Mostrar los días calculados
                    echo '</tr>';
                }
            
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p>No has solicitado vacaciones.</p>';
            }
        }
        function mostrarVacaciones($vacaciones_data) {
            if (!empty($vacaciones_data) && is_array($vacaciones_data)) {
                $vacaciones = $vacaciones_data[0]; 
                echo "<br>";
                echo htmlspecialchars($vacaciones['nombre']) . "<br><br>";
                echo "Días de vacaciones totales: 30  <br>";
                echo "<br>";
            } else {
                echo "No hay vacaciones disponibles para el usuario.";
            }
        }
        function calcularDiasSolicitados($fecha_inicio, $fecha_fin) {
            // Calcular la cantidad de días entre las fechas
            $inicio = new DateTime($fecha_inicio);
            $fin = new DateTime($fecha_fin);
            $diferencia = $inicio->diff($fin);
            $dias_solicitados = $diferencia->days + 1;
            
            return $dias_solicitados;
        }
        function insertarSolicitudVacaciones($enlace, $usuario_id, $fecha_inicio, $fecha_fin, $dias_solicitados) {
            $consulta_insertar = "INSERT INTO vacaciones (usuario_id, fecha_inicio, fecha_fin, estado, dias_solicitados) 
                              VALUES ('$usuario_id', '$fecha_inicio', '$fecha_fin', 'pendiente', '$dias_solicitados')";
    
            if (mysqli_query($enlace, $consulta_insertar)) {
            header("location: ../vista/vista_vacaciones.php");
              exit();
            } else {
                echo "Error al solicitar las vacaciones: " . mysqli_error($enlace);
            }
    
            mysqli_close($enlace);
        } 
        public function actualizarDiasVacaciones($enlace, $usuario_id, $dias_solicitados) {
            // Obtener los días actuales de vacaciones
            $consulta = "SELECT dias_vacaciones FROM usuarios WHERE id = ?";
            $q = $enlace->prepare($consulta);
            $q->bind_param('i', $usuario_id);
            $q->execute();

            $resultado = $q->get_result();
            $fila = $resultado->fetch_assoc();
        
            if ($fila) {
                $dias_disponibles = $fila['dias_vacaciones'];
                $nuevos_dias = $dias_disponibles - $dias_solicitados;
        
                // Actualizar los días de vacaciones
                $consulta_update = "UPDATE usuarios SET dias_vacaciones = ? WHERE id = ?";
                $q_update = $enlace->prepare($consulta_update);
                $q_update->bind_param('ii', $nuevos_dias, $usuario_id);
                $q_update->execute();
                $q_update->close();
            }
        
            $q->close();
        }   

        function obtenerSolicitudesPendientes($enlace) {
            $consulta = "SELECT * FROM vacaciones WHERE estado = 'pendiente';";
            $resultado = mysqli_query($enlace, $consulta);
        
            $solicitudes_pendientes = [];
            if (mysqli_num_rows($resultado) > 0) {
                while ($solicitud = mysqli_fetch_assoc($resultado)) {
                    $solicitudes_pendientes[] = $solicitud;
                }
            }
                return $solicitudes_pendientes;
        }
        
        
        public function mostrarSolicitudesPendientes($enlace) {
            $solicitudes_pendientes = $this->obtenerSolicitudesPendientes($enlace);
        
            if (count($solicitudes_pendientes) > 0) {
                echo '<table>
                    <thead>
                        <tr>
                            <th>Usuario ID</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                            <th>Días solicitados</th>
                            <th>Estado</th>
                            <th>Días restantes</th> <!-- Nueva columna -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
        
                foreach ($solicitudes_pendientes as $solicitud) {
                    $dias_disponibles = $this->obtenerDiasVacacionesDisponibles($enlace, $solicitud['usuario_id']);
                    $dias_restantes = $dias_disponibles; // Inicializa con los días disponibles
                    
                    $dias_solicitados = $solicitud['dias_solicitados'];
                    
                    $dias_restantes -= $dias_solicitados;
        
                    echo '<tr>
                            <td>' . htmlspecialchars($solicitud['usuario_id']) . '</td>
                            <td>' . htmlspecialchars($solicitud['fecha_inicio']) . '</td>
                            <td>' . htmlspecialchars($solicitud['fecha_fin']) . '</td>
                            <td>' . htmlspecialchars($dias_solicitados) . '</td>
                            <td>' . htmlspecialchars($solicitud['estado']) . '</td>
                            <td>' . htmlspecialchars($dias_restantes) . '</td> <!-- Mostrar días restantes -->
                            <td>
                                <form action="../controlador/controlador_admin_vacaciones.php" method="POST">
                                    <input type="hidden" name="vacacion_id" value="' . htmlspecialchars($solicitud['id']) . '">
                                    <button type="submit" class="btn-salir"name="accion" value="aprobar">Aprobar</button>
                                    <button type="submit" class="btn-salir"name="accion" value="rechazar">Rechazar</button>
                                </form>
                            </td>
                        </tr>';
                }
        
                echo '</tbody>
                    </table>';
            } else {
                echo '<p>No hay solicitudes pendientes.</p>';
            }
        }
        function actualizarEstadoVacacion($enlace, $vacacion_id, $estado) {
        
            $vacacion_id = mysqli_real_escape_string($enlace, $vacacion_id);
            $estado = mysqli_real_escape_string($enlace, $estado);
        
            
            $consulta_actualizar_vacacion = "UPDATE vacaciones SET estado = '$estado' WHERE id = '$vacacion_id'";
            
            
            $resultado = mysqli_query($enlace, $consulta_actualizar_vacacion);
        
            return true;
        }
        
          
        public function obtenerDiasVacaciones($enlace, $username) {
            // Consulta para obtener el total de días de vacaciones disponibles
            $consulta = "SELECT dias_vacaciones FROM usuarios WHERE id = ?";
            
            // Preparar la consulta
            $stmt = $enlace->prepare($consulta);
            $stmt->bind_param('i', $usuario_id);
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Obtener el resultado
            $resultado = $stmt->get_result();
            $dias_totales = 0;
        
            if ($fila_dias = $resultado->fetch_assoc()) {
                $dias_totales = $fila_dias['dias_vacaciones'];
            }
        
            $stmt->close();
        
            return $dias_totales;
        }
        
    function obtenerDatosVacaciones($enlace, $vacacion_id) {
        
        $vacacion_id = mysqli_real_escape_string($enlace, $vacacion_id);
    
        
        $consulta_vacacion = "SELECT usuario_id, dias_solicitados FROM vacaciones WHERE id = '$vacacion_id'";
        
       
        $resultado_vacacion = mysqli_query($enlace, $consulta_vacacion);
    
      
    
        $vacacion = mysqli_fetch_assoc($resultado_vacacion);
    
        return $vacacion;
    }
    
}


    


class Nomina {
    public $id;           // ID de la nómina
    public $usuario_id;   // ID del usuario
    public $mes;          // Mes de la nómina
    public $anio;         // Año de la nómina
    public $enlace_pdf;   // Enlace al archivo PDF

    // Método para mostrar nóminas
    public function mostrarNominas($ruta_carpeta_usuario, $nombre_usuario) {
        if (file_exists($ruta_carpeta_usuario)) {
            $archivos = array_diff(scandir($ruta_carpeta_usuario), array('.', '..'));
            
            echo "<h2 class='btn-volver'>Nóminas de {$nombre_usuario}</h2>";
            echo "<div class='table-title'>";
            echo "<h3 class='titulo-vaca'>Lista de Nóminas</h3>";
            echo "<table class='table-fill'>";
            echo "<thead>
                    <tr>
                        <th class='text-left'>Nóminas</th>
                        <th class='text-left'>Ver / Descargar</th>
                    </tr>
                  </thead>";
            echo "<tbody>";

            foreach ($archivos as $archivo) {
                $ruta_archivo = $ruta_carpeta_usuario . '/' . $archivo;
                echo "<tr>";
                echo "<td class='text-left'>$archivo</td>";
                echo "<td class='text-left'><a href='$ruta_archivo' target='_blank'>Ver / Descargar</a></td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "No se encontró la carpeta de nóminas para el usuario {$nombre_usuario}.";
        }
    }
}