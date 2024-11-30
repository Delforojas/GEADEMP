<?php
include '../config.php';
session_start();

session_destroy();

// Redirigir a la página de login
header("Location: " . $base_url . "/Geademp");
exit();

?>