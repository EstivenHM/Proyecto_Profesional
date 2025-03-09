<?php
include('Conexion.php');
session_start();

date_default_timezone_set('America/Costa_Rica');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}

if (isset($_SESSION['Id_log'])) {
    $id_log = $_SESSION['Id_log'];
    $HoraSalida = date('Y-m-d H:i:s');

    // Actualizar la hora de salida en el registro correspondiente
    $sql = "UPDATE b_ingresos SET Hora_salida = ? WHERE Id_log = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $HoraSalida, $id_log);
    $stmt->execute();
    $stmt->close();
}

$conexion->close();

// Destruir la sesión y cerrar la sesión del usuario
session_unset();
session_destroy();

header("Location: index.php");
exit();
