<?php

session_start();
include('../config/Conexion.php');
date_default_timezone_set('America/Costa_Rica');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception("Sesión no válida");
        }

       
        if (mysqli_connect_errno()) {
            throw new Exception("Error de conexión a la base de datos: " . mysqli_connect_error());
        }

        $Rol = $_SESSION['Rol'];
        if (!in_array($Rol, [1, 2])) {
            header("Location: ../vistas/users.php?error=crear_denegado");
            exit();
        }
       
        $tipo_cedula = $_POST['t_cedula'];
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $pass = $_POST['pass']; 
        $nivel = $_POST['nivel'];

       
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $Cedula = $_SESSION['Cedula'];  
        $tipo = '1';
        $Creacion = "Se creó el usuario: $nombre";
        $Hora = date('Y-m-d H:i:s');

        
        $check_query = "SELECT * FROM usuarios WHERE Cedula = ?";
        $stmt = $conexion->prepare($check_query);
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Error en la consulta de verificación: " . $conexion->error);
        }

        if ($result->num_rows > 0) {
            header("Location: ../vistas/users.php?error=cedula_exists");
            exit();
        }

        
        $query = "INSERT INTO usuarios (Tipo_cedula, Cedula, Nombre, Apellido_1, Apellido_2, Correo, Telefono, Password, Estado, Nivel, Rol)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Activo', ?, '3')";

        $stmt = $conexion->prepare($query);
        if (!$stmt) {
            throw new Exception("Error preparando la consulta: " . $conexion->error);
        }

        $stmt->bind_param("ssssssssi", $tipo_cedula, $cedula, $nombre, $apellido1, $apellido2, $correo, $telefono, $pass, $nivel);

        if (!$stmt->execute()) {
            throw new Exception("Error al insertar usuario: " . $stmt->error);
        }

       
        $sql = "INSERT INTO b_movimientos (Nombre, Cedula, Tipo_movimiento, Descripcion, Hora_fecha) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparando la consulta de movimientos: " . $conexion->error);
        }

        $stmt->bind_param("ssiss", $username, $Cedula, $tipo, $Creacion, $Hora);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar movimiento: " . $stmt->error);
        }

        header("Location: ../vistas/users.php?success=true");
        exit();
    }
} catch (Exception $e) {
    error_log($e->getMessage(), 3, '../logs/errors.log'); // Guarda el error en un log
    header("Location: ../vistas/users.php?error=true");
    exit();
} finally {
    if ($conexion) {
        $conexion->close();
    }
}

?>

