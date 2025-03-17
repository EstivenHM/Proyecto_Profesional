<?php

session_start();
include('../config/Conexion.php');
include('../funciones/funciones.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Id_libro = $_POST['Id_material'];

    
    $libro = get_delete_libro($Id_libro);
    
    if ($libro) {
        $rutaArchivo = $libro['archivo']; 

        
        if (file_exists($rutaArchivo)) {
            unlink($rutaArchivo);
        }

        
        $query = "DELETE FROM material WHERE Id_materia = '$Id_libro'";

        if (mysqli_query($conexion, $query)) {

            header("Location: ../vistas/Agregarlibro.php?success=delete");
        } else {

            header("Location: ../vistas/Agregarlibro.php?error=delete");
        }
    } else {
        header("Location: ../vistas/Agregarlibro.php?error=notfound");
    }

    mysqli_close($conexion);
    exit();
}
