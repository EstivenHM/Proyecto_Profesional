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
        $_SESSION['user_id'] =$usuario['Id_usuario'];
        $Cedula = $usuario['Cedula'];
        $Accion = 'Ingreso al sistema';
        $Hora = date('Y-m-d H:i:s');

        $sql = "INSERT INTO b_ingresos (Nombre, Cedula, Accion, Hora) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssss", $usuario['Nombre'],$Cedula, $Accion, $Hora);
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
