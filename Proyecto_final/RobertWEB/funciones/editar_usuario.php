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

        if (!isset($_POST['id_usuario'], $_POST['estado'], $_POST['nivel'], $_POST['rol'])) {
            throw new Exception("Datos incompletos");
        }

        $rol = $_SESSION['Rol'];
        if (!in_array($rol, [1, 2])) {
            header("Location: ../vistas/users.php?error=crear_denegado");
            exit();
        }

       

        $id_usuario = $_POST['id_usuario'];
        $estado = $_POST['estado'];
        $nivel = $_POST['nivel'];
        $Rol = $_POST['rol'];

        $query_nombre = "SELECT Nombre FROM usuarios WHERE Id_usuario = ?";
        $stmt = $conexion->prepare($query_nombre);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $nombre = $row['Nombre'];
        } else {
            $nombre = "Desconocido"; 
        }
        
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $Cedula = $_SESSION['Cedula'];
        $tipo = '1';
        $Creacion = "Se edito el usuario: $nombre";
        $Hora = date('Y-m-d H:i:s');



        $query = "UPDATE usuarios SET Estado = ?, Nivel = ?, Rol = ? WHERE Id_usuario = ?";
        $stm = $conexion->prepare($query);
        $stm->bind_param("siii", $estado, $nivel, $Rol,$id_usuario );
        if (!$stm->execute()) {
            throw new Exception("Error al actualizar el usuario: " . $stm->error);
        }

        $sql = "INSERT INTO b_movimientos (Nombre, Cedula, Tipo_movimiento, Descripcion, Hora_fecha) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssiss", $username, $Cedula, $tipo, $Creacion, $Hora);
        if (!$stmt->execute()) {
            throw new Exception("Error al registrar el movimiento: " . $stmt->error);
        }

        header("Location: ../vistas/users.php?success=update");
    } catch (Exception $e) {
        error_log($e->getMessage());
        header("Location: ../vistas/users.php?error=update");
        exit();
    } finally {
        if (isset($conexion)) {
            $conexion->close();
        }
    }
}
