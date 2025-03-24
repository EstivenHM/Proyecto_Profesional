<?php

session_start();
include('../config/Conexion.php');
date_default_timezone_set('America/Costa_Rica');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Sesión no válida");
        }

        if (!$conexion) {
            throw new Exception("Error en la conexión a la base de datos");
        }

        // Iniciar transacción
        $conexion->begin_transaction();

        $rol_id = intval($_POST['id_rol']);
        $permisos = isset($_POST['permisos']) ? $_POST['permisos'] : [];

        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $Cedula = $_SESSION['Cedula'];
        $tipo = 2;
        $accion = "Se modificaron los permisos";
        $Hora = date('Y-m-d H:i:s');

        // 1. Eliminar permisos actuales del rol
        $query_delete = "DELETE FROM roles_permisos WHERE IdRol = ?";
        $stmt_delete = $conexion->prepare($query_delete);
        $stmt_delete->bind_param("i", $rol_id);
        $stmt_delete->execute();
        $stmt_delete->close();

        // 2. Insertar nuevos permisos seleccionados
        if (!empty($permisos)) {
            $query_insert = "INSERT INTO roles_permisos (IdRol, IdPermisos) 
                             SELECT ?, ? FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM roles_permisos WHERE IdRol = ? AND IdPermisos = ?)";
            $stmt_insert = $conexion->prepare($query_insert);

            foreach ($permisos as $permiso_id) {
                // Insertar el permiso solo si no existe
                $stmt_insert->bind_param("iiii", $rol_id, $permiso_id, $rol_id, $permiso_id);
                $stmt_insert->execute();
            }

            $stmt_insert->close();
        }

        // 3. Registrar en b_movimientos
        $sql = "INSERT INTO b_movimientos (Nombre, Cedula, Tipo_movimiento, Descripcion, Hora_fecha) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssiss", $username, $Cedula, $tipo, $accion, $Hora);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar el movimiento: " . $stmt->error);
        }
        $stmt->close();

        // Confirmar transacción
        $conexion->commit();

        header("Location: ../vistas/roles.php?success=update_permisos");
        exit();
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        if ($conexion) {
            $conexion->rollback();
        }

        error_log($e->getMessage());
        header("Location: ../vistas/roles.php?error=" . urlencode($e->getMessage()));
        exit();
    } finally {
        if (isset($conexion)) {
            $conexion->close();
        }
    }
}




/*
session_start();
include('../config/Conexion.php');
date_default_timezone_set('America/Costa_Rica');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}

// Asegúrate de incluir la conexión a la BD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Sesión no válida");
        }


        $rol_id = intval($_POST['id_rol']); // ID del rol recibido
        $permisos = isset($_POST['permisos']) ? $_POST['permisos'] : []; // Permisos seleccionados

        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $Cedula = $_SESSION['Cedula'];
        $tipo = '2';
        $accion = "Se modificaron los permisos";
        $Hora = date('Y-m-d H:i:s');

        if (!$conexion) {
            throw new Exception("Error en la conexión a la base de datos");
        }

        // 1. Eliminar permisos actuales del rol
        $query_delete = "DELETE FROM roles_permisos WHERE IdRol = ?";
        $stmt_delete = mysqli_prepare($conexion, $query_delete);
        mysqli_stmt_bind_param($stmt_delete, "i", $rol_id);
        mysqli_stmt_execute($stmt_delete);
        mysqli_stmt_close($stmt_delete);

        // 2. Insertar nuevos permisos seleccionados
        if (!empty($permisos)) {
            $query_insert = "INSERT INTO roles_permisos (IdRol, IdPermisos) VALUES (?, ?)";
            $stmt_insert = mysqli_prepare($conexion, $query_insert);

            foreach ($permisos as $permiso_id) {
                mysqli_stmt_bind_param($stmt_insert, "ii", $rol_id, $permiso_id);
                mysqli_stmt_execute($stmt_insert);
            }
            mysqli_stmt_close($stmt_insert);
        }
        $sql = "INSERT INTO b_movimientos (Nombre, Cedula, Tipo_movimiento, Descripcion, Hora_fecha) 
        VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssiss", $username, $Cedula, $tipo, $accion, $Hora);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar el movimiento: " . $stmt->error);
        }


        header("Location: ../vistas/roles.php?success=update");
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
}*/
