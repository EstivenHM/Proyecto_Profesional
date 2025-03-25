<?php

session_start();
include('../config/Conexion.php');
date_default_timezone_set('America/Costa_Rica');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $Id_rol = $_POST['Id_rol'];
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $Cedula = $_SESSION['Cedula'];
        $tipo = '3';
        $Hora = date('Y-m-d H:i:s');



        // Obtener la descripción antes de eliminar
        $query_select = "SELECT Descripcion FROM roles WHERE Id_rol = ?";
        $stmt = $conexion->prepare($query_select);
        $stmt->bind_param("i", $Id_rol);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $RolDescripcion = $row['Descripcion']; // Guardamos el nombre del rol
        } else {
            throw new Exception("No se encontró el rol con ID $Id_rol");
        }

        if (in_array($Id_rol, [1, 2, 3])) {
            header("Location: ../vistas/Roles.php?error=delete_denegado");
            exit();
        }

        // Eliminar el rol
        $query_delete = "DELETE FROM roles WHERE Id_rol = ?";
        $stmt = $conexion->prepare($query_delete);
        $stmt->bind_param("i", $Id_rol);
        $stmt->execute();

        // Registrar la eliminación en b_movimientos
        $accion = "Se eliminó el rol: $RolDescripcion";
        $sql = "INSERT INTO b_movimientos (Nombre, Cedula, Tipo_movimiento, Descripcion, Hora_fecha) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssiss", $username, $Cedula, $tipo, $accion, $Hora);
        $stmt->execute();

        header("Location: ../vistas/Roles.php?success=delete");
        exit();
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        header("Location: ../vistas/Roles.php?error=delete");
        exit();
    } finally {
        if (isset($conexion)) {
            $conexion->close();
        }
    }
}
