<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "robertdb";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_error); 
} else {
    echo "Conexión exitosa"; 
}

?>