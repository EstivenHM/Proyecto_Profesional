<?php

$server = "localhost";
$user = "u503671396_RECWEB";
$pass = "Recweb2025";
$db = "u503671396_robertdb";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_error); 
} else {
    //echo "Conexión exitosa"; 
}

?>