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
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Sesión no válida");
        }

        if (!isset($_POST['Id_rol'], $_POST['Nombre'], $_POST['Detalles'])) {
            throw new Exception("Datos incompletos");
        }

        $Id_rol = $_POST['Id_rol'];
        $Nombre = $_POST['Nombre'];
        $Detalles = $_POST['Detalles'];

        if (in_array($Id_rol, [1, 2, 3])) {
            header("Location: ../vistas/Roles.php?error=update_denegado");
            exit();
        }
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $Cedula = $_SESSION['Cedula'];
        $tipo = '2';
        $Creacion = "Se editó el rol: $Nombre";
        $Hora = date('Y-m-d H:i:s');

        // Verificar conexión
        if (!$conexion) {
            throw new Exception("Error en la conexión a la base de datos");
        }

        // Actualizar rol
        $query = "UPDATE roles SET Descripcion = ?, Detalles = ? WHERE Id_rol = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ssi", $Nombre, $Detalles, $Id_rol);

        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar el rol: " . $stmt->error);
        }

        // Registrar movimiento
        $sql = "INSERT INTO b_movimientos (Nombre, Cedula, Tipo_movimiento, Descripcion, Hora_fecha) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssiss", $username, $Cedula, $tipo, $Creacion, $Hora);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar el movimiento: " . $stmt->error);
        }

        header("Location: ../vistas/Roles.php?success=update");
        exit();

    } catch (Exception $e) {
        error_log($e->getMessage());
        header("Location: ../vistas/Roles.php?error=update");
        exit();
    } finally {
        if (isset($conexion)) {
            $conexion->close();
        }
    }
}
