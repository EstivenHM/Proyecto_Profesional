<?php

include('Conexion.php');

function display_data()
{
    global $conexion;
    $query = "select * from usuarios";
    $result = mysqli_query($conexion, $query);
    return  $result;
}
