<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: ../vistas/index.php');
    exit();
}
$username = $_SESSION['username'];

include('../funciones/funciones.php');

$result = Libros_data();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="../Stylecss/material.css">
    <link rel="Stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Material disponible</title>
</head>

<body>

    <header>
        <h1 id="titulo">Bienvenido Estiven</h1>
        <div class="Menu-header">
            <a href="../vistas/Menu.php"><i class='bx bx-power-off'></i>INICIO</a>
        </div>
    </header>
    <seccion>
        <div class="Home">

            <div class="btn-boton">
                <button onclick="location.href='../vistas/material.php'" class="btn-refrescar"><i class='bx bx-refresh'></i>Refrescar</button>
                
            </div>

            <div class="scrollable-table">
                <table class="table">
                    <thead>
                        <tr class="titulo">

                            <th>Nombre del libro</th>
                            <th>Nivel</th>
                            
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="t_body">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td style="display: none;"><?php echo $row['Id_materia'] ?></td>
                                <td><?php echo $row['Nombre'] ?></td>
                                <td><?php echo $row['descripcion']; ?></td>
                                <td>
                                    <a href="<?php echo $row['archivo']; ?>" target="_blank" class="btn-open"><i class='bx bxs-book-open'></i></a>
                                   
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>



        </div>
    </seccion>
    <footer class="footer">

        <div class="container">
            <div class="footer-row">
                <div class="footer-links">

                    <h4>Acerca de</h4>
                    <ul>
                        <li><a href="#">Nosotros</a></li>
                        <li><a href="#">Mision</a></li>
                        <li><a href="#">Vision</a></li>
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