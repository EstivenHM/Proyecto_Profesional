<?php

session_start();
include('../config/Conexion.php');
date_default_timezone_set('America/Costa_Rica');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $Rol = $_POST['nombre_rol'];
        $Descripcion = $_POST['detalles'];

        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Sesión no válida");
        }

        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $Cedula = $_SESSION['Cedula'];
        $tipo = '1';
        $Creacion = "Se creo el rol: $Rol";
        $Hora = date('Y-m-d H:i:s');

        $check_query = "SELECT * FROM roles WHERE Descripcion=?";
        $stmt = $conexion->prepare($check_query);
        $stmt->bind_param("s", $Rol);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: ../vistas/Roles.php?error=rol_exists");
            exit();
        }

        $query = "INSERT INTO roles (Descripcion, Detalles) VALUES (?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ss", $Rol, $Descripcion);
        $stmt->execute();

        $sql = "INSERT INTO b_movimientos (Nombre, Cedula, Tipo_movimiento, Descripcion, Hora_fecha) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssiss", $username, $Cedula, $tipo, $Creacion, $Hora);
        $stmt->execute();

        header("Location: ../vistas/Roles.php?success=true");
        exit();
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage()); 
        header("Location: ../vistas/Roles.php?error=exception");
        exit();
    } finally {
        if (isset($conexion)) {
            $conexion->close();
        }
    }
}

?>
