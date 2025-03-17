<?php

session_start();
include('../config/Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Rol = $_POST['nombre_rol'];
    $Descripcion = $_POST['detalles'];

    $check_query = "SELECT * FROM roles WHERE Descripcion='$Rol'";
    $result = mysqli_query($conexion, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // El rol ya existe

        header("Location: ../vistas/Roles.php?error=rol_exists");
        exit();
    } else {
        $query = "INSERT INTO roles (Descripcion, Detalles) Values ('$Rol', '$Descripcion')";
        if (mysqli_query($conexion, $query)) {
            header("Location: ../vistas/Roles.php?success=true");
        } else {
            header("Location: ../vistas/Roles.php?error=true");
        }
    }

    mysqli_close($conexion);
    exit();
}

?>