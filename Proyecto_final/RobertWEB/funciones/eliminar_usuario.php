<?php

session_start();
include('../config/Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];

    $query = "delete FROM usuarios WHERE Id_usuario = '$id_usuario'";

    if (mysqli_query($conexion, $query)) {
       
        header("Location: ../vistas/users.php?success=delete");
    } else {
       
        header("Location: ../vistas/users.php?error=delete");
    }

    mysqli_close($conexion);
    exit();
    
}
?>