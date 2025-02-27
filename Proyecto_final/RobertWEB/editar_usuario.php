<?php

session_start();
include('Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $estado = $_POST['estado'];
    $nivel = $_POST['nivel'];

    $query = "UPDATE usuarios SET Estado = '$estado', Nivel = '$nivel' WHERE Id_usuario = '$id_usuario'";

    if (mysqli_query($conexion, $query)) {
       
        header("Location: users.php?success=update");
    } else {
       
        header("Location: users.php?error=update");
    }

    mysqli_close($conexion);
    exit();
    
}
?>