<?php

session_start();
include('../config/Conexion.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $estado = $_POST['estado'];
    $nivel = $_POST['nivel'];
    $Rol = $_POST['rol'];

    $query = "UPDATE usuarios SET Estado = '$estado', Nivel = '$nivel', Rol = '$Rol' WHERE Id_usuario = '$id_usuario'";

    if (mysqli_query($conexion, $query)) {
       
        header("Location: ../vistas/users.php?success=update");
    } else {
       
        header("Location: ../vistas/users.php?error=update");
    }

    mysqli_close($conexion);
    exit();
    
}
?>