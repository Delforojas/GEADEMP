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
    
  
