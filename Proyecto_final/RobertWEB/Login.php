<?php
session_start();
include('Conexion.php');

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
        header("Location: Menu.php");
        exit();
    } else {
        header("Location: index.php?error=true");
        exit();
    }

    $consulta->close();
    $conexion->close();
}
