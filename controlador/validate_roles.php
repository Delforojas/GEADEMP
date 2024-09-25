<?php
    session_start()
    $roles_permitidos =['Administrador'];

    if(!array_key_exists('rol', $_SESSION) || !in_array($_SESSION['rol'], $roles_permitidos)){
        header("location: index.php");
    }
?>