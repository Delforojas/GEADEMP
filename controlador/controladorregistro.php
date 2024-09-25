<?php
include("../modelo/datos_conexion.php");
include("../modelo/modelo.php");

$enlace = obtenerConexion();
if(!empty($_POST['registro'])){
    if(empty($_POST['nombre'])  or empty($_POST['usuario']) or empty($_POST['clave'])){
        echo'uno de los campos esta vacio';
    }else{
        $nombre=$_POST['nombre'];
        $usuario=$_POST['usuario'];
        $clave=$_POST['clave'];
        $id_cargo=2;// O el valor correspondiente para el rol
       
        $q = "INSERT INTO usuarios (nombre, usuario, clave, id_cargo) 
                VALUES ('$nombre', '$usuario', '$clave', $id_cargo)";
        $resultado = mysqli_query($enlace, $q);
        if($resultado==1){
            echo'USUARIO REGISTRADO CORRECTAMENTE';
            header("location: ../vista/index.php");
        }else{
            echo'usuario no registrado';
        }


    }
}

?>