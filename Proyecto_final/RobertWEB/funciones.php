<?php

include('Conexion.php');

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

function data_rol(){

    global $conexion;
    $query = "select * from roles";
    $result = mysqli_query($conexion, $query);
    return  $result;
}