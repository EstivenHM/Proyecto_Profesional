<?php
include('Conexion.php');
session_start();

date_default_timezone_set('America/Costa_Rica');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit(); 
}
$username = $_SESSION['username'];
$Accion = 'salida del sistema';
$Hora = date('Y-m-d H:i:s');

$sql = "INSERT INTO b_logs (Nombre_usuario, Accion, Hora) VALUES ('$username', '$Accion', '$Hora')";

if ($conexion->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();

session_unset(); 
session_destroy();

header("Location: index.php"); 

exit();
?>