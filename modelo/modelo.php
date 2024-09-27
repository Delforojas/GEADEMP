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


class Bolsa {
    public $id;
    public $nombre;
    public $ancho;
    public $espesor;


    public  function ObtenerBolsa(){
        $enlace = obtenerConexion();
        $consulta = "SELECT * FROM bolsa"; // Cambia esto por el nombre de tu tabla
        $resultado = mysqli_query($enlace, $consulta);

        if (!$resultado) {
            die("Error al realizar la consulta: " . mysqli_error($enlace));
        }
        return $resultado;
    }
    public  function insertarEnBolsa($nombre, $ancho, $espesor) {
        $enlace = obtenerConexion();
        $consulta = "INSERT INTO bolsa (nombre, ancho, espesor) VALUES (?,?,?)";
        $resultado = mysqli_prepare($enlace, $consulta);
        
        if (!$resultado) {
                die("Error al preparar la consulta: " . mysqli_error($enlace));
            }
        // Vincular los parámetros (s = string, i = entero)
        mysqli_stmt_bind_param($resultado, "sii", $nombre, $ancho, $espesor);

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
        $consulta = "SELECT nombre, ancho, espesor FROM bolsa WHERE id = ?";
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

    public  function eliminardatos($enlace, $id){
        // Eliminar el registro de la tabla bolsa
        $eliminar = "DELETE FROM bolsa WHERE id = ?";
        $Delete = mysqli_prepare($enlace, $eliminar);
        mysqli_stmt_bind_param($Delete, "i", $id);
        mysqli_stmt_execute($Delete);
        mysqli_stmt_close($Delete);
    }

    public function obtenerDatosFormulario() {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
        $ancho = isset($_POST['ancho']) ? (int)$_POST['ancho'] : null; 
        $espesor = isset($_POST['espesor']) ? (int)$_POST['espesor'] : null;

        return [$nombre, $ancho, $espesor]; // Devuelve un array con los datos
    }
}

    class Sl4 extends Bolsa {
            public  function insertarsl4($enlace, $nombre, $ancho, $espesor) {
                $insertar = "INSERT INTO sl4 (nombre, ancho, espesor) VALUES (?, ?, ?)";
                $insertsl4 = mysqli_prepare($enlace, $insertar);
                if (!$insertsl4) {
                    die("Error al preparar la consulta: " . mysqli_error($enlace));
                }
                mysqli_stmt_bind_param($insertsl4, "sii", $nombre, $ancho, $espesor);
                $ejecucion = mysqli_stmt_execute($insertsl4);
                if (!$ejecucion) {
                    die("Error al ejecutar la consulta: " . mysqli_stmt_error($insertsl4));
                }
                mysqli_stmt_close($insertsl4);
            }    

            public  function ObtenerBolsasl4(){
                $enlace = obtenerConexion();
                $consulta = "SELECT * FROM sl4"; // Cambia esto por el nombre de tu tabla
                $resultado = mysqli_query($enlace, $consulta);
                
                if (!$resultado) {
                    die("Error al realizar la consulta: " . mysqli_error($enlace));
                }
                return $resultado;
            }

            public function obtenerDatosOrdenadossl4($orden) {
                    // Conexión a la base de datos
                $enlace = obtenerConexion();  // Asume que tienes definida la función obtenerConexion()
                    
                    // Inicializamos la variable de consulta
                $q = "SELECT * FROM sl4";
                    
                    // Determina la consulta según el valor de 'orden'
                if ($orden == "ASC") {
                    $q .= " ORDER BY espesor ASC";
                } elseif ($orden == "DESC") {
                    $q .= " ORDER BY espesor DESC";
                } elseif ($orden == "AASC") {
                    $q .= " ORDER BY ancho ASC";
                } elseif ($orden == "ADESC") {
                    $q .= " ORDER BY ancho DESC";
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
            
        }
      
        
    class Sl7 extends Bolsa {
        public function insertarsl7($enlace, $nombre, $ancho, $espesor) {
            $insertar = "INSERT INTO sl7 (nombre, ancho, espesor) VALUES (?, ?, ?)";
            $insertsl7 = mysqli_prepare($enlace, $insertar);
            if (!$insertsl7) {
                die("Error al preparar la consulta: " . mysqli_error($enlace));
            }

            mysqli_stmt_bind_param($insertsl7, "sii", $nombre, $ancho, $espesor);
            $ejecucion = mysqli_stmt_execute($insertsl7);
            if (!$ejecucion) {
                die("Error al ejecutar la consulta: " . mysqli_stmt_error($insertsl7));
            }

            mysqli_stmt_close($insertsl7);

        }
        function ObtenerBolsasl7(){
            $enlace = obtenerConexion();
            $consulta = "SELECT * FROM sl7"; // Cambia esto por el nombre de tu tabla
            $resultado = mysqli_query($enlace, $consulta);
        
            if (!$resultado) {
                die("Error al realizar la consulta: " . mysqli_error($enlace));
            }
            return $resultado;
        }
        

        public function obtenerDatosOrdenadossl7($orden) {
            // Conexión a la base de datos
            $enlace = obtenerConexion();  // Asume que tienes definida la función obtenerConexion()
            
            // Inicializamos la variable de consulta
            $q = "SELECT * FROM sl7";
            
            // Determina la consulta según el valor de 'orden'
            if ($orden == "ASC") {
                $q .= " ORDER BY espesor ASC";
            } elseif ($orden == "DESC") {
                $q .= " ORDER BY espesor DESC";
            } elseif ($orden == "AASC") {
                $q .= " ORDER BY ancho ASC";
            } elseif ($orden == "ADESC") {
                $q .= " ORDER BY ancho DESC";
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
    public $comentario;
    public $dias_solicitados;

    public function verificarVacaciones($enlace, $usuario, $clave) {
        $consulta = "SELECT id FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
        $resultado = mysqli_query($enlace, $consulta);

    // Si el usuario es encontrado
        if (mysqli_num_rows($resultado) == 1) {
        $usuario_data = mysqli_fetch_assoc($resultado);
        // Asignar el ID del usuario a la sesión
        $_SESSION['usuario_id'] = $usuario_data['id'];
        // Redirigir a la página de vacaciones
        header("Location: ../vista/vista_vacaciones.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }

}
public function obtenerVacaciones($enlace, $usuario_id) {
            
        $consulta = "SELECT fecha_inicio, fecha_fin, estado FROM vacaciones WHERE usuario_id = '$usuario_id'";
        $resultado = mysqli_query($enlace, $consulta);
        $tablaHTML = '';

        echo ''; // Limpiar cualquier salida previa

        if (mysqli_num_rows($resultado) > 0) {
            echo '<table >';
            echo '<thead><tr><th>Fecha de inicio</th><th>Fecha de fin</th><th>Estado</th><th>Días calculados</th></tr></thead>'; 
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
                echo '<td>' . $fecha_inicio . '</td>';
                echo '<td>' . $fecha_fin . '</td>';
                echo '<td>' . $fila['estado'] . '</td>';
                echo '<td>' . $dias_solicitados . '</td>';  // Mostrar los días calculados
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No has solicitado vacaciones.</p>';
        }
        // Devolver la tabla generada
        return $tablaHTML;
    }
    public function obtenerDiasVacaciones($enlace, $usuario_id) {
        // Consulta para obtener el total de días de vacaciones disponibles
        $consulta = "SELECT dias_vacaciones FROM usuarios WHERE id = '$usuario_id'";
        $resultado = mysqli_query($enlace, $consulta);

        // Obtener el total de días de vacaciones
        $dias_totales = 0;
        if ($fila_dias = mysqli_fetch_assoc($resultado)) {
            $dias_totales = $fila_dias['dias_vacaciones'];
        }

        // Devolver el total de días de vacaciones
        return $dias_totales;
    }
    function calcularDiasSolicitados($fecha_inicio, $fecha_fin) {
        // Calcular la cantidad de días entre las fechas
        $inicio = new DateTime($fecha_inicio);
        $fin = new DateTime($fecha_fin);
        $diferencia = $inicio->diff($fin);
        $dias_solicitados = $diferencia->days + 1;
        
        return $dias_solicitados;// Sumar 1 para incluir el día de inicio
    }
    function insertarSolicitudVacaciones($enlace, $usuario_id, $fecha_inicio, $fecha_fin, $dias_solicitados) {
        $consulta_insertar = "INSERT INTO vacaciones (usuario_id, fecha_inicio, fecha_fin, estado, dias_solicitados) 
                          VALUES ('$usuario_id', '$fecha_inicio', '$fecha_fin', 'pendiente', '$dias_solicitados')";

        // Ejecutar la consulta
        if (mysqli_query($enlace, $consulta_insertar)) {
        // Redirigir a la vista de vacaciones si la inserción fue exitosa
        header("location: ../vista/vista_vacaciones.php");
          exit();
        } else {
        // Mostrar un mensaje de error si la inserción falla
            echo "Error al solicitar las vacaciones: " . mysqli_error($enlace);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($enlace);
    }
    function obtenerSolicitudesPendientes($enlace) {
        // Consulta para obtener todas las solicitudes pendientes
        $consulta = "SELECT * FROM vacaciones WHERE estado = 'pendiente';";
        $resultado = mysqli_query($enlace, $consulta);
    
        // Inicializar un arreglo para almacenar las solicitudes pendientes
        $solicitudes_pendientes = [];
    
        // Verificar si hay solicitudes pendientes
        if (mysqli_num_rows($resultado) > 0) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($solicitud = mysqli_fetch_assoc($resultado)) {
                $solicitudes_pendientes[] = $solicitud;
            }
        }
    
        // Devolver el arreglo de solicitudes pendientes
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($solicitudes_pendientes as $solicitud) {
                echo '<tr>
                        <td>' . $solicitud['usuario_id'] . '</td>
                        <td>' . $solicitud['fecha_inicio'] . '</td>
                        <td>' . $solicitud['fecha_fin'] . '</td>
                        <td>' . $solicitud['dias_solicitados'] . '</td>
                        <td>' . $solicitud['estado'] . '</td>
                        <td>
                            <form action="../controlador/controlador_admin_vacaciones.php" method="POST">
                                <input type="hidden" name="vacacion_id" value="' . $solicitud['id'] . '">
                                <button type="submit" name="accion" value="aprobar">Aprobar</button>
                                <button type="submit" name="accion" value="rechazar">Rechazar</button>
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
    function obtenerDatosVacacion($enlace, $vacacion_id) {
        // Preparar la consulta para obtener los datos de la solicitud de vacaciones
        $consulta_vacacion = "SELECT usuario_id, dias_solicitados FROM vacaciones WHERE id = '$vacacion_id'";
    
        // Ejecutar la consulta
        $resultado_vacacion = mysqli_query($enlace, $consulta_vacacion);
    
        // Verificar si se obtuvieron resultados
        if (mysqli_num_rows($resultado_vacacion) > 0) {
            // Obtener los datos de la solicitud
            $vacacion = mysqli_fetch_assoc($resultado_vacacion);
            return $vacacion; // Devolver los datos de la solicitud
        } else {
            return null; // Devolver null si no hay resultados
        }
    }
    function obtenerDiasDisponiblesUsuario($enlace, $usuario_id) {
        // Preparar la consulta para obtener los días de vacaciones disponibles del usuario
        $consulta_dias_usuario = "SELECT dias_vacaciones FROM usuarios WHERE id = '$usuario_id'";
    
        // Ejecutar la consulta
        $resultado_dias_usuario = mysqli_query($enlace, $consulta_dias_usuario);
    
        // Verificar si se obtuvo el resultado
        if (mysqli_num_rows($resultado_dias_usuario) > 0) {
            // Obtener los días de vacaciones disponibles
            $usuario = mysqli_fetch_assoc($resultado_dias_usuario);
            return $usuario['dias_vacaciones']; // Devolver los días disponibles
        } else {
            return null; // Devolver null si no se encuentran resultados
        }
    }
    function actualizarDiasDisponiblesUsuario($enlace, $usuario_id, $dias_restantes) {
        // Preparar la consulta para actualizar los días de vacaciones restantes del usuario
        $consulta_actualizar_usuario = "UPDATE usuarios SET dias_vacaciones = '$dias_restantes' WHERE id = '$usuario_id'";
    
        // Ejecutar la consulta
        if (mysqli_query($enlace, $consulta_actualizar_usuario)) {
            return true; // Éxito en la actualización
        } else {
            return "Error al actualizar los días de vacaciones: " . mysqli_error($enlace); // Error en la actualización
        }
    }

    public function actualizarEstadoSolicitud($enlace, $vacacion_id, $estado) {
        // Consulta para actualizar el estado de la solicitud
        $consulta_actualizar_vacacion = "UPDATE vacaciones SET estado = '$estado' WHERE id = '$vacacion_id'";

        // Ejecutar la consulta
        if (mysqli_query($enlace, $consulta_actualizar_vacacion)) {
            return true; // La actualización fue exitosa
        } else {
            return "Error al actualizar la solicitud: " . mysqli_error($enlace); // Hubo un error en la actualización
        }
    }
}

  
