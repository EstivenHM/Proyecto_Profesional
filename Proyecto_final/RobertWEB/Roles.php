<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}
$username = $_SESSION['username'];

include('funciones.php');
$result = data_rol();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylecss/Roles.css">
    <link rel="Stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Roles</title>
</head>

<body>

    <header>
        <h1 id="titulo">Bienvenido Estiven</h1>
        <div class="Menu-header">
            <a href="Menu.php"><i class='bx bx-power-off'></i>INICIO</a>
        </div>
    </header>

    <section>

        <div class="Home">
            <div class="btn-boton">
                <button onclick="location.href='Roles.php'" class="btn-refrescar"><i class='bx bx-refresh'></i>Refrescar</button>
                <button class="btn-nuevo" onclick="document.getElementById('myModal').style.display='block'"><i class='bx bx-plus'></i>Nuevo</button>
            </div>

            <div class="scrollable-table">
                <table class="table">
                    <thead>
                        <tr class="titulo">
                            <th class="id-col">ID rol</th>
                            <th>Descripcion</th>
                            <th>Detalles</th>
                            <th class="accion-col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="t_body">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="id-col"><?php echo $row['Id_rol'] ?></td>
                                <td><?php echo $row['Descripcion'] ?></td>
                                <td><?php echo $row['Detalles'] ?></td>
                                <td class="accion-col">
                                    <a href="Roles.php?edit_id=<?php echo $row['Id_rol']; ?>" class="btn-editar"><i class='bx bxs-pencil'></i></a>
                                    <a href="Roles.php?delete_id=<?php echo $row['Id_rol']; ?>" class="btn-eliminar"><i class='bx bxs-x-circle'></i></a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modales-->

        <div id="myModal" class="modal">
            <div class="modal-content">

                <form action="crear_rol.php" method="post">

                    <label for="Nombre_rol">Nombre del rol</label><br>
                    <input type="text" id="nombre_rol" name="nombre_rol" required>
                    <br>
                    <label for="detalles">Detalles del rol</label><br>
                    <input type="text" id="detalles" name="detalles" required>
                    <br>
                    <button type="submit" class="btn-guardar">Guardar</button>
                    <button onclick="location.href='Roles.php'" class="btn-cancelar">Cerrar</button>

                </form>
            </div>
        </div>

         <!-- Modales Mensajes-->

         <?php if (isset($_GET['success'])): ?>
            <div class="modal-ok">
                <div class="modal-conte">
                    <p>Se agrego el rol correctamente</p>
                    <a href="Roles.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'rol_exists'): ?>
            <div class="modal-msj">
                <div class="modal-ms">
                    <h2>EL nombre del rol ya existe</h2>
                    <p>Verifica los datos ingresados</p>
                    <a href="Roles.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="modal-not">
                <div class="modal-cont">
                    <h2>Vaya!</h2>
                    <p>Hubo un error al agregar el rol. Por favor, inténtelo de nuevo.</p>
                    <a href="Roles.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php endif; ?>


    </section>

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