<?php

session_start();
include('Conexion.php');
include('funciones.php');

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

            header("Location: Agregarlibro.php?success=delete");
        } else {

            header("Location: Agregarlibro.php?error=delete");
        }
    } else {
        header("Location: Agregarlibro.php?error=notfound");
    }

    mysqli_close($conexion);
    exit();
}
