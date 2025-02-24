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
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Encriptar la contraseña
    $nivel = $_POST['nivel'];

    $query = "INSERT INTO usuarios (Tipo_cedula, Cedula, Nombre, Apellido_1, Apellido_2, Correo, Telefono, Password, Estado, Nivel, Rol)
    VALUES('$tipo_cedula','$cedula', '$nombre', '$apellido1', '$apellido2', ' $correo', ' $telefono', '$pass','Activo', '$nivel', '3')";

    if (mysqli_query($conexion, $query)) {
        header("Location: Usuarios.php?success=true");
    } else {
        header("Location: Usuarios.php?error=true");
    }

    mysqli_close($conexion);
   

    exit();
}
