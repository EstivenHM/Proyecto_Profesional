<?php

session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: ../index.php');
    exit();
}
$username = $_SESSION['username'];

include('../funciones/funciones.php');
include('../config/Conexion.php');
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
$fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';
$tipo_movimiento = isset($_POST['tipo_movimiento']) ? $_POST['tipo_movimiento'] : '';

$tipos_movimientos = ObtenerTiposMovimientos($conexion);
$result = Movimientos_data($conexion, $usuario, $fecha_inicio, $fecha_fin, $tipo_movimiento);
?>



<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="../Stylecss/movimientos.css">
    <link rel="Stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Bitacora de movimientos</title>
</head>

<body>


    <header>
        <h1 id="titulo">Bienvenido <?php echo htmlspecialchars($username); ?></h1>
        <div class="Menu-header">
            <a href="../vistas/Menu.php"><i class='bx bx-power-off'></i>INICIO</a>
        </div>
    </header>

    <section>

        <div class="Home">

            <div class="btn-boton">
                <button onclick="location.href='../vistas/ingresos_salidas.php'" class="btn-refrescar"><i class='bx bx-refresh'></i>Refrescar</button>
                <button class="btn-filtro" onclick="document.getElementById('myModal').style.display='block'"><i class='bx bx-filter'></i>Filtros</button>
            </div>


            <div class="scrollable-table">
                <table class="table">
                    <thead>
                        <tr class="titulo">
                            <th>ID Movimiento</th>
                            <th>Usuario</th>
                            <th>Cédula</th>
                            <th>Tipo Movimiento</th>
                            <th>Descripción</th>
                            <th>Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody class="t_body">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['Id_movimiento']; ?></td>
                                <td><?php echo $row['Nombre']; ?></td>
                                <td><?php echo $row['Cedula']; ?></td>
                                <td><?php echo $row['Nombre_tipo']; ?></td>
                                <td><?php echo $row['Descripcion']; ?></td>
                                <td><?php echo $row['Hora_fecha']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <!-- Modal filtros-->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <form action="../vistas/movimientos.php" method="post">
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="usuario" id="usuario">

                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio">

                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin">

                        <label for="tipo_movimiento">Tipo de Movimiento:</label>
                        <select name="tipo_movimiento" id="tipo_movimiento">
                            <option value="">Todos</option>
                            <?php foreach ($tipos_movimientos as $tipo) { ?>
                                <option value="<?php echo $tipo['Id_tipo']; ?>"><?php echo $tipo['Nombre_tipo']; ?></option>
                            <?php } ?>
                        </select>
                        <br>

                        <button type="submit" name="filtrar" class="btn-guardar">Filtrar</button>
                        <button type="button" onclick="document.getElementById('myModal').style.display='none'" class="btn-cancelar">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <footer class="footer">

        <div class="container">
            <div class="footer-row">
                <div class="footer-links">

                    <h4>Acerca de</h4>
                    <ul>
                        <li><a href="../vistas/Acerca_de.php">Nosotros</a></li>

                    </ul>
                </div>

                <div class="footer-links">
                    <h4> Ayuda </h4>
                    <ul>
                        <li><a href="#">Manual de uso</a></li>
                        <li><a href="#">contactanos</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4> Siguenos </h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/roberto.english.94" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/robertenglishcoach/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@rocascante11" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.tiktok.com/@robertenglishcoach?is_from_webapp=1&sender_device=pc" target="_blank"><i class="fab fa-tiktok"></i></a>
                    </div>

                </div>

            </div>

        </div>
    </footer>





</body>

</html>