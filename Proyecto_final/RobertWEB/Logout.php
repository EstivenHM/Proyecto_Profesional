<?php
include('Conexion.php');
session_start();

date_default_timezone_set('America/Costa_Rica');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}

$userId = $_SESSION['user_id'];
$Accion = 'Salida del sistema';
$Hora = date('Y-m-d H:i:s');

// Obtener la cédula del usuario
$consulta = $conexion->prepare("SELECT Cedula FROM usuarios WHERE Id_usuario = ?");
$consulta->bind_param("i", $userId);
$consulta->execute();
$resultado = $consulta->get_result();
$usuario = $resultado->fetch_assoc();
$Cedula = $usuario['Cedula'];
$consulta->close();

// Insertar el registro de salida en la tabla b_ingresos
$sql = "INSERT INTO b_ingresos (Nombre, Cedula, Accion, Hora) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $_SESSION['username'], $Cedula, $Accion, $Hora);

if ($stmt->execute()) {
    // Éxito
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();

session_unset();
session_destroy();

header("Location: index.php");
exit();
