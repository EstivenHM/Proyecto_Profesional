<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: ../index.php');
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="../Stylecss/Menu.css">
    <link rel="Stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Menu principal</title>
</head>

<body>

    <header>
        </div>
        <label>
            <input type="checkbox" class="menu">
            <div class="toggle">
                <span class="top_line common"></span>
                <span class="middle_line common"></span>
                <span class="bottom_line common"></span>
            </div>
            <div class="slide">
                <h2 id="subtitulo">MENU</h2>
                <ul>

                    <li><a href="../vistas/Agregarlibro.php" id="G_material"><i class='bx bxs-book-add'></i>Gestion de material</a></li>

                    <li class="submenu">
                        <input type="checkbox" id="submenu-toggle">
                        <label for="submenu-toggle" class="submenu-label"><i class='bx bxs-cog'></i>Mantenimientos</label>
                        <ul class="submenu-content">
                            <li><a href="../vistas/users.php" id="usuarios"><i class='bx bxs-user-detail'></i>Usuarios</a></li>
                            <li><a href="../vistas/Roles.php" id="Roles"><i class='bx bxs-category'></i>Roles</a></li>
                            <li>
                            <li><a href="#" id="Permisos"><i class='bx bxs-key'></i>Permisos</a></li>
                    </li>
                </ul>
                </li>

                <li><a href="#"><i class='bx bxs-report'></i>Reportes</a></li>

                <li class="submenu">
                    <input type="checkbox" id="submenu-toggle-bitacoras">
                    <label for="submenu-toggle-bitacoras" class="submenu-label"><i class='bx bxs-time'></i>Bitacoras</label>
                    <ul class="submenu-content">
                        <li><a href="../vistas/ingresos_salidas.php" id="Ingreso_salida"><i class='bx bxs-time'></i>Ingresos salidas</a></li>
                        <li><a href="../vistas/movimientos.php" id="movimientos"><i class='bx bx-history'></i>Movimientos</a></li>
                    </ul>
                </li>

                <li><a href="../auth/Logout.php"><i class='bx bxs-log-out'></i>Cerrar sesion</a></li>

                </ul>
            </div>
        </label>
        <h1 id="titulo">Bienvenido <?php echo htmlspecialchars($username); ?></h1>
        <div class="Menu-header">
            <a href="../vistas/Menu.php">INICIO<i class='bx bx-power-off'></i></a>
        </div>


    </header>

    <seccion>
        <div class="Home">

            <div class="botones">

                <a href="../vistas/material.php" id="material" class="boton"><i class='bx bxs-book'></i>Material de clase</a>
                <a href="#" class="boton" id= "tareas"><i class='bx bxs-book-bookmark'></i>Tareas</a>
                <a href="#" class="boton" id="cuenta"><i class='bx bxs-user-account'></i>cuenta</a>

            </div>

        </div>


    </seccion>
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