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
class Vacaciones {
        // Atributos públicos de la clase
    public $idVacaciones;
    public $fecha_inicio;
    public $fecha_fin;
    public $idSolicitud;
    public $diasSolicitados;
    public $diasTotales = 30;


    public function obtenerDiasTotalesVacaciones($enlace, $idUsuario) {
        $query = "SELECT diasTotales FROM usuariovacaciones uv
                  JOIN Vacaciones v ON uv.idVacaciones = v.idVacaciones
                  WHERE uv.idUsuario = ?";
        $stmt = $enlace->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->bind_result($diasTotales);
        $stmt->fetch();
        $stmt->close();
        
        return $diasTotales ?? 0;
    }

    // Método para obtener los días ya solicitados por el usuario
    public function obtenerDiasSolicitados($enlace, $idUsuario) {
        $query = "SELECT SUM(diasSolicitados) FROM usuariovacaciones uv
                  JOIN Vacaciones v ON uv.idVacaciones = v.idVacaciones
                  WHERE uv.idUsuario = ?";
        $stmt = $enlace->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->bind_result($diasSolicitados);
        $stmt->fetch();
        $stmt->close();

        return $diasSolicitados ?? 0;
    }
    public function obtenerVacacionesPorUsuario($enlace, $idUsuario) {
        $query = "SELECT v.diasTotales AS diasTotales, SUM(v.diasSolicitados) AS diasSolicitados
                  FROM usuariovacaciones uv
                  JOIN vacaciones v ON uv.idVacaciones = v.idVacaciones
                  WHERE uv.idUsuario = ?
                  GROUP BY v.diasTotales";

        $stmt = $enlace->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->bind_result($diasTotales, $diasSolicitados);
        $stmt->fetch();
        $stmt->close();

        $diasRestantes = $diasTotales - ($diasSolicitados ?? 0);

        return [
            'diasTotales' => $diasTotales ?? 0,
            'diasSolicitados' => $diasSolicitados ?? 0,
            'diasRestantes' => $diasRestantes
        ];
    }
    function obtenerDiasTotales($enlace, $idUsuario) {
        // Consulta SQL para obtener los días totales
        $sqlTotales = "SELECT v.diasTotales 
                       FROM Usuariovacaciones uv 
                       JOIN vacaciones v ON uv.idVacaciones = v.idVacaciones 
                       WHERE uv.idUsuario = ?";
        
        $stmtTotales = $enlace->prepare($sqlTotales);
        $stmtTotales->bind_param("i", $idUsuario);
        $stmtTotales->execute();
        $stmtTotales->bind_result($diasTotales);
        $stmtTotales->fetch();
        $stmtTotales->close();
        
        return $diasTotales; // Retorna los días totales
    }
    function obtenerDiasSolicitados1($enlace, $idVacaciones) {
        // Consulta SQL para obtener los días solicitados
        $sqlSolicitados = "SELECT diasSolicitados 
                           FROM vacaciones 
                           WHERE idVacaciones = ?";
        
        $stmtSolicitados = $enlace->prepare($sqlSolicitados);
        $stmtSolicitados->bind_param("i", $idVacaciones);
        $stmtSolicitados->execute();
        $stmtSolicitados->bind_result($diasSolicitados);
        $stmtSolicitados->fetch();
        $stmtSolicitados->close();
        
        return $diasSolicitados; // Retorna los días solicitados
    }
    function actualizarDiasTotales($enlace, $nuevosDiasTotales, $idUsuario) {
        // Consulta SQL para actualizar los días totales
        $sqlActualizar = "UPDATE vacaciones 
                          SET diasTotales = ? 
                          WHERE idUsuario = ?";
        $stmtActualizar = $enlace->prepare($sqlActualizar);
        $stmtActualizar->bind_param("ii", $nuevosDiasTotales, $idUsuario);
        $stmtActualizar->execute();
        $stmtActualizar->close();
    }
    function obtenerDiasSolicitados2($enlace, $idUsuario) {
        // Consulta SQL para obtener la suma de días solicitados
        $sqlSolicitados = "SELECT SUM(v.diasSolicitados) AS diasSolicitados 
                           FROM Usuariovacaciones uv 
                           JOIN vacaciones v ON uv.idVacaciones = v.idVacaciones 
                           JOIN solicitud s ON v.idSolicitud = s.idSolicitud 
                           WHERE uv.idUsuario = ? AND s.estado IN ('Pendiente', 'Aprobado')";
        
        $stmtSolicitados = $enlace->prepare($sqlSolicitados);
        $stmtSolicitados->bind_param("i", $idUsuario);
        $stmtSolicitados->execute();
        $stmtSolicitados->bind_result($diasSolicitados);
        $stmtSolicitados->fetch();
        $stmtSolicitados->close();
    
        return $diasSolicitados ?? 0; // Retorna los días solicitados o 0 si no hay solicitudes
    }
    
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
    

}