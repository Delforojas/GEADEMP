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
    public $baseDatos = "gestor";
    public $enlace;

    // Constructor de la clase
    public function __construct($servidor = "localhost", $user = "root", $clave = "", $baseDatos = "gestor") {
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
            public  function insertarlp1 ($enlace, $nombre, $criterio1, $criterio2) {
                $insertar = "INSERT INTO lp1 (nombre, criterio1, criterio2) VALUES (?, ?, ?)";
                $insertlp1 = mysqli_prepare($enlace, $insertar);
                if (!$insertlp1) {
                    die("Error al preparar la consulta: " . mysqli_error($enlace));
                }
                mysqli_stmt_bind_param($insertlp1, "sii", $nombre, $criterio1, $criterio2);
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
    public $idUsuario;
    public $nombre;
    public $apellidos;
    public $clave;
    public $id_cargo;

    public function verificarUsuario($apellidos, $clave) {
        // Preparar la consulta SQL para verificar el usuario y la contraseña
        $q = $enlace->prepare("SELECT u.idUsuario, u.nombre, u.apellidos, u.clave, c.descripcion AS rol 
                                FROM USUARIOS u 
                                LEFT JOIN CARGO c ON u.idCargo = c.idCargo 
                                WHERE u.apellidos = ? AND u.clave = ?");
    
        // Enlazar los parámetros (matricula y contraseña)
        $q->bind_param("ss", $apellidos, $clave);
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
            $_SESSION['rol'] = $row['idCargo'];
    
            // Mostrar mensaje de éxito
            echo '<div class="alert alert-success">Login exitoso</div>';
    
            // Redirigir al usuario según su rol (en este caso, a la vista de administrador o usuario)
            if ($row['rol'] == 'Administrador') {
                header("Location: vista_bolsa_admin.php");
            } else {
                header("Location: vista_usuario.php"); // Asegúrate de tener esta vista
            }
            exit(); // Asegurarse de que el script se detiene después de la redirección
        } else {
            // Si no se encuentra un usuario válido, mostrar mensaje de error
            echo '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
        }
        // Cerrar el statement
        $q->close();
    }
    
    public function verificarCredenciales($apellidos, $clave) {
        $enlace = obtenerConexion();
        // Consulta para verificar el usuario y la contraseña
        $consulta = "SELECT u.idCargo, u.nombre, u.clave FROM USUARIOS u WHERE u.apellidos = ?";        
        // Preparar la consulta para evitar inyecciones SQL
        $q = $enlace->prepare($consulta);
        if ($q === false) {
            die('Error al preparar la consulta: ' . $enlace->error);
        }
        
        // Vincular los parámetros a la consulta
        $q->bind_param('ss', $apellidos, $clave);
        
        // Ejecutar la consulta
        $q->execute();
        
        // Obtener el resultado
        $resultado = $q->get_result();
        
        if ($resultado && $resultado->num_rows > 0) {
            // Extraer los datos del usuario
            $filas = $resultado->fetch_assoc();
            
            // Guardar los datos en la sesión
            $_SESSION['username'] = $filas['nombre'];
            $_SESSION['rol'] = $filas['idCargo'];
            
            // Redirigir según el rol del usuario
            if ($filas['idCargo'] == 2) {
                // Redirección para el administrador
                header("Location: vista_bolsa_admin.php");
                exit();
            } elseif ($filas['idCargo'] == 1) {
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

class Nomina {
    public $idNomina;
    public $mes;          
    public $anio;        
    public $enlace_pdf;   


    
    function obtenerNominasPorUsuario($enlace, $idUsuario, $mes, $anio) {
        // Inicializar el array para almacenar las nóminas
        $nominas = [];
        
        // Verificar que los parámetros necesarios no estén vacíos
        if ($mes && $anio && $idUsuario) {
            // Consulta para obtener las nóminas del usuario según el mes y el año
            $queryNominas = "SELECT n.mes, n.anio, n.enlace 
                             FROM UsuarioNomina un 
                             JOIN Nomina n ON un.idNomina = n.idNomina 
                             WHERE un.idUsuario = ? AND n.mes = ? AND n.anio = ?";
            
            $stmt = $enlace->prepare($queryNominas);
            if ($stmt === false) {
                die("Error en la preparación de la consulta: " . $enlace->error);
            }
            
            // Vincular los parámetros y ejecutar la consulta
            $stmt->bind_param("iss", $idUsuario, $mes, $anio);
            $stmt->execute();
            $resultadoNominas = $stmt->get_result();
    
            // Almacenar las nóminas obtenidas en el array $nominas
            while ($fila = $resultadoNominas->fetch_assoc()) {
                $nominas[] = $fila;
            }
    
            // Cerrar el statement
            $stmt->close();
        }
        
        // Devolver el array de nóminas
        return $nominas;
    }

class Vacaciones{
    public $idVacaciones;
    public $fecha_inicio;
    public $fecha_fin;
    public $idSolicitud;
    public $diasSolicitados;
    public $diasTotales = 30;


    function diasTotales($enlace, $idUsuario) {
        $dTotales = "SELECT v.diasTotales 
                       FROM Usuariovacaciones uv 
                       JOIN vacaciones v ON uv.idVacaciones = v.idVacaciones 
                       WHERE uv.idUsuario = ?";
    
        $diasTotales = $enlace->prepare($dTotales);
        if ($stmtTotales === false) {
            die('Error al preparar la consulta: ' . $enlace->error);
        }
    
        $diasTotales->bind_param("i", $idUsuario);
        $diasTotales->execute();
        $diasTotales->bind_result($diasTotalesDB);
        $diasTotales->fetch();
        $diasTotales->close();
    
        return $diasTotalesDB;
    }
    
    
    
    function diasSolicitados($enlace, $idVacaciones) {
        $s = "SELECT diasSolicitados 
              FROM vacaciones 
              WHERE idVacaciones = ?";
    
        $diassSolicitados = $enlace->prepare($s);
        if ($sSolicitados === false) {
            die('Error al preparar la consulta: ' . $enlace->error);
        }
    
        $diasSolicitados->bind_param("i", $idVacaciones);
        $diasSolicitados->execute();
        $diasSolicitados->bind_result($diasSolicitados);
        $diasSolicitados->fetch();
        $diasSolicitados->close();
    
        return $diasSolicitados;
    }
    
    function actualizarDiasTotales($enlace, $nuevosDiasTotales, $idUsuario) {
        $s = "UPDATE vacaciones 
              SET diasTotales = ? 
              WHERE idUsuario = ?";
    
        $sActualizar = $enlace->prepare($s);
        if ($sActualizar === false) {
            die('Error al preparar la consulta: ' . $enlace->error);
        }
    
        $sActualizar->bind_param("ii", $nuevosDiasTotales, $idUsuario);
        $sActualizar->execute();
        $sActualizar->close();
    }
    
    function totalDiasSolicitados($enlace, $idUsuario) {
        $s = "SELECT SUM(v.diasSolicitados) AS diasSolicitados 
              FROM Usuariovacaciones uv 
              JOIN vacaciones v ON uv.idVacaciones = v.idVacaciones 
              JOIN solicitud s ON v.idSolicitud = s.idSolicitud 
              WHERE uv.idUsuario = ? AND s.estado IN ('Pendiente', 'Aprobado')";
    
        $sSolicitados = $enlace->prepare($s);
        if ($sSolicitados === false) {
            die('Error al preparar la consulta: ' . $enlace->error);
        }
    
        $sSolicitados->bind_param("i", $idUsuario);
        $sSolicitados->execute();
        $sSolicitados->bind_result($diasSolicitados);
        $sSolicitados->fetch();
        $sSolicitados->close();
    
        return $diasSolicitados;
    }
    public function insertarVacaciones($idSolicitud, $fecha_inicio, $fecha_fin, $diasSolicitados) {
        $iVacaciones = "INSERT INTO Vacaciones (idSolicitud, fecha_inicio, fecha_fin, diasSolicitados) VALUES (?, ?, ?, ?)";
        $sVacaciones = $this->enlace->prepare($iVacaciones);
        if ($sVacaciones) {
            $sVacaciones->bind_param("issi", $idSolicitud, $fecha_inicio, $fecha_fin, $diasSolicitados);
            $sVacaciones->execute();
            $idVacaciones = $sVacaciones->insert_id;
            $sVacaciones->close();
            return $idVacaciones;
        } else {
            return null; // Manejo de errores si no se puede preparar la consulta
        }
    }
    public function UsuarioVacaciones($idUsuario, $idVacaciones) {
        $iUsuariosVacaciones = "INSERT INTO UsuarioVacaciones (idUsuario, idVacaciones) VALUES (?, ?)";
        $sUsuariosVacaciones = $this->enlace->prepare($iUsuariosVacaciones);
        if ($sUsuariosVacaciones) {
            $sUsuariosVacaciones->bind_param("ii", $idUsuario, $idVacaciones);
            $sUsuariosVacaciones->execute();
            $sUsuariosVacaciones->close();
            return true;
        } else {
            return false; // Manejo de errores si no se puede preparar la consulta
        }
    }
    function actualizarSolicitud($enlace, $nuevoEstado, $idVacaciones) {
        // Consulta para actualizar el estado de la solicitud en la tabla `solicitud`
        $query = "UPDATE solicitud SET estado = ? WHERE idSolicitud = (SELECT idSolicitud FROM vacaciones WHERE idVacaciones = ?)";
        
        // Preparar la sentencia
        if ($q = $enlace->prepare($query)) {
            // Enlazar los parámetros
            $q->bind_param("si", $nuevoEstado, $idVacaciones);
            
            // Ejecutar la sentencia
            if ($q->execute()) {
                echo "El estado de la solicitud ha sido actualizado correctamente.";
            } else {
                echo "Error al ejecutar la consulta: " . $q->error;
            }
            
            // Cerrar la sentencia
            $q->close();
        } else {
            echo "Error al preparar la consulta: " . $enlace->error;
        }
    }
    function eliminarVacaciones($enlace, $idVacaciones) {
        // Consulta para eliminar un registro de la tabla `vacaciones`
        $deleteQuery = "DELETE FROM vacaciones WHERE idVacaciones = ?";
        
        // Preparar la sentencia
        if ($qDelete = $enlace->prepare($deleteQuery)) {
            // Enlazar los parámetros
            $qDelete->bind_param("i", $idVacaciones);
            
            // Ejecutar la sentencia
            if ($qDelete->execute()) {
                echo "El registro de vacaciones ha sido eliminado correctamente.";
            } else {
                echo "Error al ejecutar la consulta: " . $qDelete->error;
            }
            
            // Cerrar la sentencia
            $qDelete->close();
        } else {
            echo "Error al preparar la consulta: " . $enlace->error;
        }
    }
    function solicitudesPendientes($enlace) {
        // Consulta para cargar las solicitudes pendientes
        $query = "
            SELECT v.idVacaciones, u.nombre, u.apellidos, v.fecha_inicio, v.fecha_fin, v.diasSolicitados, s.estado, s.idSolicitud
            FROM vacaciones v
            JOIN usuariovacaciones uv ON v.idVacaciones = uv.idVacaciones
            JOIN usuario u ON uv.idUsuario = u.idUsuario
            JOIN solicitud s ON v.idSolicitud = s.idSolicitud
            WHERE s.estado = 'pendiente'";
        
        // Ejecutar la consulta
        $resultado = $enlace->query($query);
        if ($resultado) {
            $solicitudes = $resultado->fetch_all(MYSQLI_ASSOC);
            return $solicitudes;
        } else {
            echo "Error al ejecutar la consulta: " . $enlace->error;
            return [];
        }
    }
    function tablaSolicitudesPendientes($solicitudes) {
        if (!empty($solicitudes)) {
            echo "<div class='table-title'>";
            echo "<h3 class='titulo-vaca'>Solicitud de Vacaciones de " . htmlspecialchars($_SESSION['username']) . "</h3>";
            echo "<table class='table-fill'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID de Vacaciones</th>";
            echo "<th>Nombre</th>";
            echo "<th>Apellidos</th>";
            echo "<th>Fecha Inicio</th>";
            echo "<th>Fecha Fin</th>";
            echo "<th>Días Solicitados</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($solicitudes as $solicitud) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($solicitud['idVacaciones']) . "</td>";
                echo "<td>" . htmlspecialchars($solicitud['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($solicitud['apellidos']) . "</td>";
                echo "<td>" . htmlspecialchars($solicitud['fecha_inicio']) . "</td>";
                echo "<td>" . htmlspecialchars($solicitud['fecha_fin']) . "</td>";
                echo "<td>" . htmlspecialchars($solicitud['diasSolicitados']) . "</td>";
                echo "<td>";
                echo "<form action='../controlador/aprobar_rechazar_vacaciones.php' method='post'>";
                echo "<input type='hidden' name='idVacaciones' value='" . htmlspecialchars($solicitud['idVacaciones']) . "'>";
                echo "<button type='submit' name='aprobar' class='btn-salir'>Aprobar</button>";
                echo "<button type='submit' name='rechazar' class='btn-salir'>Rechazar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>No hay solicitudes de vacaciones pendientes.</p>";
        }
    }
    



}
    

}