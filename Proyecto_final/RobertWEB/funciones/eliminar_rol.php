<?php

session_start();
include('../config/Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Id_rol= $_POST['Id_rol'];

    $query = "delete FROM roles WHERE Id_rol = '$Id_rol'";

    if (mysqli_query($conexion, $query)) {
       
        header("Location: ../vistas/Roles.php?success=delete");
    } else {
       
        header("Location: ../vistas/Roles.php?error=delete");
    }

    mysqli_close($conexion);
    exit();


}

?>