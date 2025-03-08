<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}
$username = $_SESSION['username'];

include('funciones.php');
$result = Libros_data();


?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylecss/Gestionmaterial.css">
    <link rel="Stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Gestion de Material</title>
</head>

<body>

    <header>
        <h1 id="titulo">Bienvenido Estiven</h1>
        <div class="Menu-header">
            <a href="Menu.php"><i class='bx bx-power-off'></i>INICIO</a>
        </div>
    </header>

    <seccion>
        <div class="Home">

            <div class="btn-boton">
                <button onclick="location.href='Agregarlibro.php'" class="btn-refrescar"><i class='bx bx-refresh'></i>Refrescar</button>
                <button class="btn-nuevo" onclick="document.getElementById('myModal').style.display='block'"><i class='bx bx-plus'></i>Nuevo</button>
            </div>

            <div class="scrollable-table">
                <table class="table">
                    <thead>
                        <tr class="titulo">

                            <th>Nombre del libro</th>
                            <th>tipo de archivo</th>
                            <th>Nivel</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="t_body">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['Nombre'] ?></td>
                                <td><?php echo $row['Nivel'] ?></td>
                                <td><?php echo $row['archivo'] ?></td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!------------Modales------------->

        <div id="myModal" class="modal">
            <div class="modal-content">
                <form action="subirmaterial.php" method="post" enctype="multipart/form-data">
                    <label for="nombre">Nombre del libro</label><br>
                    <input type="text" id="nombre" name="nombre" required>
                    <br>
                    <label for="nivel">Nivel</label><br>
                    <select id="nivel" name="nivel" required>
                        <option value="" disabled selected>Seleccione</option>
                        <option value="1">A1</option>
                        <option value="2">A2</option>
                        <option value="3">B1</option>
                        <option value="4">B2</option>
                        <option value="5">C1</option>
                        <option value="6">C2</option>
                    </select>
                    <br>
                    <label for="file">Selecciona un archivo PDF:</label><br>
                    <input type="file" name="archivo" id="archivo">
                    <br>
                    <button type="submit" class="btn-guardar">Guardar</button>

                    <button onclick="location.href='Agregarlibro.php'" class="btn-cancelar">Cerrar</button>
                </form>
            </div>
        </div>


        <!--  Modales mensajes  -->

        <?php if (isset($_GET['success']) && $_GET['success'] == 'update'): ?>
            <div class="modal-ok">
                <div class="modal-conte">
                    <h2><i class='bx bx-check'></i></h2>
                    <p>Se ha creado el libro correctamente</p>
                    <a href="Agregarlibro.php" class="close-link">Cerrar</a>
                </div>
            </div>

        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'update'): ?>
            <div class="modal-cedula">
                <div class="modal-ced">
                    <h2>Vaya!</h2>
                    <p>No se pudo subir el material</p>
                    <a href="Agregarlibro.php" class="close-link">Cerrar</a>
                </div>
            </div>

        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'pdf'): ?>
            <div class="modal-cedula">
                <div class="modal-ced">
                    <h2>Formato inválido</h2>
                    <p>Solo se permiten archivos PDF</p>
                    <a href="Agregarlibro.php" class="close-link">Cerrar</a>
                </div>
            </div>

        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'upload'): ?>
            <div class="modal-cedula">
                <div class="modal-ced">
                    <h2>Error de subida</h2>
                    <p>Hubo un problema al subir el archivo. Intente nuevamente.</p>
                    <a href="Agregarlibro.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php endif; ?>

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