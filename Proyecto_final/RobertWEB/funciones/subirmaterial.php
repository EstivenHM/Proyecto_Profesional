<?php
session_start();
include('../config/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Nombre = $_POST['nombre'];
    $Nivel = $_POST['nivel'];
    $Nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($Nombre_archivo, PATHINFO_EXTENSION));

    $Destino = "../uploads/Archivos/";

    // Verifica que la carpeta exista, si no, la crea
    if (!file_exists($Destino)) {
        mkdir($Destino, 0777, true);
    }

    if ($extension == "pdf" || $extension == "doc") {
        $rutaArchivo = $Destino . $Nombre_archivo;

        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo)) {
            $sql = "INSERT INTO material (Nombre, Nivel, archivo) VALUES ('$Nombre', '$Nivel', '$rutaArchivo')";
            $result = mysqli_query($conexion, $sql);

            if ($result) {
                header("Location: ../vistas/Agregarlibro.php?success=update");
                exit;
            } else {
                header("Location: ../vistas/Agregarlibro.php?error=update");
                exit;
            }
        } else {
            header("Location: ../vistas/Agregarlibro.php?error=upload");
            exit;
        }
    } else {
        header("Location: ../vistas/Agregarlibro.php?error=pdf");
        exit;
    }
}
