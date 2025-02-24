<?php

session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}
$username = $_SESSION['username'];

include('funciones.php');
$result = display_data();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylecss/Usuarios.css">
    <link rel="Stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <title>Usuarios</title>
</head>

<body>

    <header>
        <h1 id="titulo">Bienvenido <?php echo htmlspecialchars($username); ?></h1>
        <div class="Menu-header">
            <a href="Menu.php"><i class='bx bx-power-off'></i>INICIO</a>
        </div>
    </header>

    <section>
        <div class="Home">
            <div class="btn-boton">
                <button onclick="location.href='Usuarios.php'" class="btn-refrescar"><i class='bx bx-refresh'></i>Refrescar</button>
                <button class="btn-nuevo" onclick="document.getElementById('myModal').style.display='block'"><i class='bx bx-plus'></i>Nuevo</button>
            </div>
            <div class="a_body">
                <table class="table">
                    <thead>
                        <tr class="titulo">
                            <td>ID User</td>
                            <td>Tipo de Cédula</td>
                            <td>Cédula</td>
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Apellido</td>
                            <td>Correo</td>
                            <td>Teléfono</td>
                            <td>Estado</td>
                            <td>Nivel</td>
                            <td>Rol</td>
                            <td>Acciones</td>


                        </tr>
                    </thead>
                    <tbody class="t_body">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['Id_usuario'] ?></td>
                                <td><?php echo $row['Tipo_cedula'] ?></td>
                                <td><?php echo $row['Cedula'] ?></td>
                                <td><?php echo $row['Nombre'] ?></td>
                                <td><?php echo $row['Apellido_1'] ?></td>
                                <td><?php echo $row['Apellido_2'] ?></td>
                                <td><?php echo $row['Correo'] ?></td>
                                <td><?php echo $row['Telefono'] ?></td>
                                <td><?php echo $row['Estado'] ?></td>
                                <td><?php echo $row['Nivel'] ?></td>
                                <td><?php echo $row['Rol'] ?></td>
                                <td><a href="editar_usuario.php" class="btn-editar"><i class='bx bxs-pencil'></i></a>
                                    <a href="#" class="btn-eliminar"><i class='bx bxs-x-circle'></i></a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">

                <form action="Crearusuario.php" method="post">
                    <label for="tipo_cedula">Tipo de cédula</label><br>
                    <select id="t_cedula" name="t_cedula" required>
                        <option value="" disabled selected>Seleccione</option>
                        <option value="fisica">Fisica</option>
                        <option value="juridica">Jurídica</option>
                        <option value="Dimex">Dimex</option>
                    </select>
                    <br>
                    <label for="cedula">Cédula</label><br>
                    <input type="text" id="cedula" name="cedula" required>
                    <br>
                    <label for="nombre">Nombre</label><br>
                    <input type="text" id="nombre" name="nombre" required>
                    <br>
                    <label for="apeliido">Apellido</label><br>
                    <input type="text" id="apellido1" name="apellido1" required>
                    <br>
                    <label for="apellido">Apellido</label><br>
                    <input type="text" id="apellido2" name="apellido2">
                    <br>
                    <label for="correo">Correo</label><br>
                    <input type="email" id="correo" name="correo" required>
                    <br>
                    <label for="telefono">Telefono</label><br>
                    <input type="num" id="telefono" name="telefono" required>
                    <br>
                    <label for="pass">Contraseña</label><br>
                    <input type="password" id="pass" name="pass" required>
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
                    <button type="submit" class="btn-guardar">Guardar</button>
                    <button onclick="location.href='Usuarios.php'" class="btn-cancelar">Cerrar</button>
                </form>
            </div>
        </div>
        <?php if (isset($_GET['success'])): ?>
            <div class="modal-ok">
                <div class="modal-conte">

                    <p>Usuario agregado exitosamente.</p>
                    <a href="Usuarios.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="modal-not">
                <div class="modal-cont">
                    <h2>Vaya!</h2>
                    <p>Hubo un error al agregar el usuario. Por favor, inténtelo de nuevo.</p>
                    <a href="Usuarios.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'cedula_exists'): ?>
            <div class="modal-cedula">
                <div class="modal-ced">
                    <h2>El numero de cedula ya existe</h2>
                    <p>Verifica los datos ingresados</p>
                    <button class="btn-cerrar" onclick="document.getElementById('errorModal').style.display='none'">Cerrar</button>
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