<?php

session_start();
include('../config/Conexion.php');

date_default_timezone_set('America/Costa_Rica');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["usuario"];
    $Password = $_POST["password"];

    // Preparamos la consulta para obtener los datos del usuario
    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE Nombre = ? AND Password = ?");
    $consulta->bind_param("ss", $Username, $Password);
    $consulta->execute();

    $resultado = $consulta->get_result();
    $filas = $resultado->num_rows;

    
    if ($filas > 0) {

        $usuario = $resultado->fetch_assoc();

        if (strtolower(trim($usuario['Estado'])) !== 'activo') {
            header("Location: ../vistas/index.php?error=inactivo");
            exit();
        }

        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $usuario['Nombre'];
        $_SESSION['user_id'] = $usuario['Id_usuario'];
        $_SESSION['Cedula'] = $usuario['Cedula'];
        $Accion = 'Ingreso al sistema';
        $Hora = date('Y-m-d H:i:s');

        // Insertamos el registro de ingreso
        $sql = "INSERT INTO b_ingresos (Nombre, Cedula, Accion, Hora_entrada) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssss", $usuario['Nombre'],$usuario['Cedula'], $Accion, $Hora);
        $stmt->execute();

        $id_log = $stmt->insert_id;
        $_SESSION['Id_log'] = $id_log;
        $stmt->close();

        header("Location: ../vistas/Menu.php");
        exit();
    } else {
        
        header("Location: ../vistas/index.php?error=password");
        exit();
    }

    $consulta->close();
    $conexion->close();
}
