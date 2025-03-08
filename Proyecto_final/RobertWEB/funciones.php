<?php

include('Conexion.php');

/* Funciones Usuarios*/ 
function display_data()
{
    global $conexion;
    $query = "select * from usuarios";
    $result = mysqli_query($conexion, $query);
    return  $result;
}

function get_user_data($id_usuario)
{
    global $conexion;
    $query = "SELECT * FROM usuarios WHERE Id_usuario = '$id_usuario'";
    $result = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result);
}

function get_user_delete($id_usuario)
{
    global $conexion;
    $query = "SELECT * FROM usuarios WHERE Id_usuario = '$id_usuario'";
    $result = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result);
}

/* Funciones Roles*/

function data_rol() {
    global $conexion;
    $query = "SELECT * FROM roles";
    $result = mysqli_query($conexion, $query);
    return $result;
}

function get_rol_delete($Id_rol)
{
    global $conexion;
    $query = "SELECT * FROM roles WHERE Id_rol = '$Id_rol'";
    $result_delete = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result_delete);
}


/* Funcion Ingresos y salidas */
function IngresoSalida_data()
{
    global $conexion;
    $query = "select * from b_ingresos";
    $result = mysqli_query($conexion, $query);
    return  $result;
}

/* Funcion para gestion ver libros*/
function Libros_data()
{
    global $conexion;
    $query = "select * from material";
    $result = mysqli_query($conexion, $query);
    return  $result;
}