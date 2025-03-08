<?php
session_start();
include('Conexion.php');
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombreLibro = $_POST['nombre'];
    $nombreArchivo = $_FILES['file']['name'];
    $tipoArchivo = $_FILES['file']['type'];
    $contenidoArchivo = file_get_contents($_FILES['file']['tmp_name']);

    // Verificar que el archivo sea un PDF
    if ($tipoArchivo !== "application/pdf") {
        header("Location: Agregarlibro.php?error=formato_invalido");
        exit();
    }


    $query = "INSERT INTO material (Nombre, Tipo_archivo, Archivo) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssb", $nombreLibro, $tipoArchivo, $null);

    // Enviar los datos binarios del archivo
    mysqli_stmt_send_long_data($stmt, 2, $contenidoArchivo);

    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        header("Location: Agregarlibro.php?success=update");
    } else {
        header("Location: Agregarlibro.php?error=update");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    exit();
}
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Nombre = $_POST['nombre'];
    $Nivel = $_POST['nivel'];
    $Nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($Nombre_archivo, PATHINFO_EXTENSION));

    $Destino = "uploads/Archivos/";

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
                header("Location: Agregarlibro.php?success=update");
                exit;
            } else {
                header("Location: Agregarlibro.php?error=update");
                exit;
            }
        } else {
            header("Location: Agregarlibro.php?error=upload");
            exit;
        }
    } else {
        header("Location: Agregarlibro.php?error=pdf");
        exit;
    }
}
