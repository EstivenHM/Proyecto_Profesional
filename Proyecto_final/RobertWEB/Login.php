<?php
session_start();
include('Conexion.php');

date_default_timezone_set('America/Costa_Rica');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["usuario"];
    $Password = $_POST["password"];

    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE Nombre = ? AND Password = ?");
    $consulta->bind_param("ss", $Username, $Password);
    $consulta->execute();

    $resultado = $consulta->get_result();
    $filas = $resultado->num_rows;

    if ($filas > 0) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $usuario['Nombre'];
        $Accion = 'Ingreso al sistema';
        $Hora = date('Y-m-d H:i:s');
        $sql = "INSERT INTO b_logs (Nombre_usuario, Accion, Hora) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sss", $usuario['Nombre'], $Accion, $Hora);
        $stmt->execute();
        $stmt->close();
        
        header("Location: Menu.php");
        exit();
    } else {
        header("Location: index.php?error=true");
        exit();
    }

    $consulta->close();
    $conexion->close();
}
