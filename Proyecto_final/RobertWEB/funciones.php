<?php

include('Conexion.php');

/* Funciones Usuarios*/ 
function display_data()
{
    global $conexion;
    $query = "SELECT u.*, 
                     n.descripcion AS nivel_descripcion, 
                     r.descripcion AS rol_descripcion 
              FROM usuarios u 
              JOIN niveles n ON u.Nivel = n.id_nivel
              JOIN roles r ON u.Rol = r.id_rol";
    $result = mysqli_query($conexion, $query);
    return $result;

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
function IngresoSalida_data($usuario = '', $fecha_inicio = '', $fecha_fin = '') {
    global $conexion;

    $query = "SELECT * FROM b_ingresos WHERE 1=1";

    if (!empty($usuario)) {
        $query .= " AND Nombre LIKE '%$usuario%'";
    }

    if (!empty($fecha_inicio) && !empty($fecha_fin)) {
        $query .= " AND DATE(Hora_entrada) BETWEEN '$fecha_inicio' AND '$fecha_fin'";
    }

    $result = mysqli_query($conexion, $query);
    return $result;
    
}

/* Funcion para gestion ver libros*/
function Libros_data()
{
    global $conexion;
    $query = "SELECT m.*, n.descripcion 
              FROM material m 
              JOIN niveles n ON m.Nivel = n.id_nivel";
    $result = mysqli_query($conexion, $query);
    return $result;
}

function get_libro_data($id_materia)
{
    global $conexion;
    $query = "SELECT * FROM material WHERE Id_materia = '$id_materia'";
    $result = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result);

}

function get_delete_libro($Id_materia)
{
    global $conexion;
    $query = "SELECT * FROM material WHERE Id_materia = '$Id_materia'";
    $result_delete = mysqli_query($conexion, $query);
    return mysqli_fetch_assoc($result_delete);
}