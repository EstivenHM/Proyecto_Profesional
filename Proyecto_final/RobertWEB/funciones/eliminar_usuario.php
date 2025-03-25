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
        $id_usuario = $_POST['id_usuario'];

        $query_select = "SELECT Nombre From usuarios WHERE Id_usuario = ?";
        $stm = $conexion->prepare($query_select);
        $stm->bind_param("i", $id_usuario);
        $stm->execute();
        $result = $stm->get_result();

        if ($row = $result->fetch_assoc()) {
            $nombre = $row['Nombre'];
        } else {
            throw new Exception("No se encontró el rol con ID $id_usuario");
        }
        if (in_array($Id_rol, [1, 2, 3])) {
            header("Location: ../vistas/users.php?error=delete_denegado");
            exit();
        }


        $query_delete = "DELETE FROM usuarios WHERE Id_usuario = ?";
        $stm = $conexion->prepare($query_delete);
        $stm->bind_param("i", $id_usuario);
        $stm->execute();

        $accion = "Se eliminó a : $nombre";
        $sql = "INSERT INTO b_movimientos (Nombre, Cedula, Tipo_movimiento, Descripcion, Hora_fecha) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssiss", $username, $Cedula, $tipo, $accion, $Hora);
        $stmt->execute();
        
        header("Location: ../vistas/users.php?success=delete");
        
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        header("Location: ../vistas/users.php?error=delete");
        exit();
    } finally {
        if (isset($conexion)) {
            $conexion->close();
        }
    }
}
