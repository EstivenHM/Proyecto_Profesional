<?php

session_start();
include('Conexion.php');


if($_SERVER["REQUEST_METHOD"] == "POST"){

$id_materia = $_POST['Id_materia'];
$nombre = $_POST['nombre'];
$nivel = $_POST['nivel'];


$query = "UPDATE material SET Nombre ='$nombre', Nivel = '$nivel' WHERE Id_materia = '$id_materia'";

if(mysqli_query($conexion, $query)){

    header("Location: Agregarlibro.php?success=editado");
}else {
    header("Location: Agregarlibro.php?error=editado");
}

mysqli_close($conexion);
exit();
}