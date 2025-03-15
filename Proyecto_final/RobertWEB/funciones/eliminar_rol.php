<?php

session_start();
include('Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Id_rol= $_POST['Id_rol'];

    $query = "delete FROM roles WHERE Id_rol = '$Id_rol'";

    if (mysqli_query($conexion, $query)) {
       
        header("Location: Roles.php?success=delete");
    } else {
       
        header("Location: Roles.php?error=delete");
    }

    mysqli_close($conexion);
    exit();


}

?>