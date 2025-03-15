<?php

session_start();
include('Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_cedula = $_POST['t_cedula'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $pass = $_POST['pass']; 
    $nivel = $_POST['nivel'];

    $check_query = "SELECT * FROM usuarios WHERE Cedula='$cedula'";
    $result = mysqli_query($conexion, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // La cédula ya existe

        header("Location: users.php?error=cedula_exists");
        exit();
    } else {
        $query = "INSERT INTO usuarios (Tipo_cedula, Cedula, Nombre, Apellido_1, Apellido_2, Correo, Telefono, Password, Estado, Nivel, Rol)
        VALUES('$tipo_cedula','$cedula', '$nombre', '$apellido1', '$apellido2', ' $correo', ' $telefono', '$pass','Activo', '$nivel', '3')";

        if (mysqli_query($conexion, $query)) {
            header("Location: users.php?success=true");
        } else {
            header("Location: users.php?error=true");
        }
    }

    mysqli_close($conexion);
    exit();
}
?>