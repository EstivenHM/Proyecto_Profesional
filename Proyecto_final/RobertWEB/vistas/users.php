<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit();
}
$username = $_SESSION['username'];

include('funciones.php');
$result = display_data();

if (isset($_GET['edit_id'])) {
    $user_data = get_user_data($_GET['edit_id']);
    $roles = get_roles();
}

if (isset($_GET['delete_id'])) {
    $user_delete = get_user_delete($_GET['delete_id']);
}

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylecss/users.css">
    <link rel="Stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <header>
        <h1 id="titulo">Bienvenido <?php echo htmlspecialchars($username); ?></h1>
        <div class="Menu-header">
            <a href="Menu.php">INICIO<i class='bx bx-power-off'></i></a>
        </div>
    </header>

    <section>

        <div class="Home">

            <div class="btn-boton">
                <button onclick="location.href='users.php'" id="U_refrescar" class="btn-refrescar"><i class='bx bx-refresh'></i>Refrescar</button>
                <button class="btn-nuevo" id="U_nuevo" onclick="document.getElementById('myModal').style.display='block'"><i class='bx bx-plus'></i>Nuevo</button>
            </div>

            <div class="scrollable-table">
                <table class="table">
                    <thead>
                        <tr class="titulo">
                            <th>ID User</th>
                            <th>Tipo de Cédula</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Nivel</th>
                            <th>Rol</th>
                            <th>Acciones</th>
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
                                <td><?php echo $row['nivel_descripcion'] ?></td>
                                <td><?php echo $row['rol_descripcion'] ?></td>
                                <td>
                                    <a href="users.php?edit_id=<?php echo $row['Id_usuario']; ?>" id="U_editar" class="btn-editar"><i class='bx bxs-pencil'></i></a>
                                    <a href="users.php?delete_id=<?php echo $row['Id_usuario']; ?>" id="U_eliminar" class="btn-eliminar"><i class='bx bxs-x-circle'></i></a>
                                </td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!--Modales-->
        <!-- Modales opciones de usuarios-->

        <div id="myModal" class="modal">
            <div class="modal-content">

                <form action="Crearusuario.php" method="post">
                    <label for="tipo_cedula">Tipo de cédula</label><br>
                    <select id="t_cedula" name="t_cedula" required>
                        <option value="" disabled selected>Seleccione</option>
                        <option value="Fisica">Fisica</option>
                        <option value="Juridica">Jurídica</option>
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
                    <button onclick="location.href='users.php'" class="btn-cancelar">Cerrar</button>
                </form>
            </div>
        </div>

        <?php if (isset($user_data)): ?>
            <div id="myModal" class="modal" style="display:block;">
                <div class="modal-content">
                    <form action="editar_usuario.php" method="post">
                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $user_data['Id_usuario']; ?>">

                        <label for="tipo_cedula">Tipo de cédula</label><br>
                        <select id="t_cedula" name="t_cedula" required disabled>
                            <option value="" disabled>Seleccione</option>
                            <option value="fisica" <?php if ($user_data['Tipo_cedula'] == 'fisica') echo 'selected'; ?>>Fisica</option>
                            <option value="juridica" <?php if ($user_data['Tipo_cedula'] == 'juridica') echo 'selected'; ?>>Jurídica</option>
                            <option value="Dimex" <?php if ($user_data['Tipo_cedula'] == 'Dimex') echo 'selected'; ?>>Dimex</option>
                        </select>
                        <br>

                        <label for="cedula">Cédula</label><br>
                        <input type="text" id="cedula" name="cedula" value="<?php echo $user_data['Cedula']; ?>" required readonly>
                        <br>

                        <label for="nombre">Nombre</label><br>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $user_data['Nombre']; ?>" required readonly>
                        <br>

                        <label for="apellido1">Apellido</label><br>
                        <input type="text" id="apellido1" name="apellido1" value="<?php echo $user_data['Apellido_1']; ?>" required readonly>
                        <br>

                        <label for="apellido2">Apellido</label><br>
                        <input type="text" id="apellido2" name="apellido2" value="<?php echo $user_data['Apellido_2']; ?>" readonly>
                        <br>

                        <label for="correo">Correo</label><br>
                        <input type="email" id="correo" name="correo" value="<?php echo $user_data['Correo']; ?>" required readonly>
                        <br>

                        <label for="telefono">Teléfono</label><br>
                        <input type="num" id="telefono" name="telefono" value="<?php echo $user_data['Telefono']; ?>" required readonly>
                        <br>

                        <label for="estado">Estado</label><br>
                        <select id="estado" name="estado" required>
                            <option value="">Seleccione</option>
                            <option value="Activo" <?php if ($user_data['Estado'] == 'Activo') echo 'selected'; ?>>Activo</option>
                            <option value="Inactivo" <?php if ($user_data['Estado'] == 'Inactivo') echo 'selected'; ?>>Inactivo</option>
                        </select>
                        <br>

                        <label for="nivel">Nivel</label><br>
                        <select id="nivel" name="nivel" required>
                            <option value="">Seleccione</option>
                            <option value="1" <?php if ($user_data['Nivel'] == '1') echo 'selected'; ?>>A1</option>
                            <option value="2" <?php if ($user_data['Nivel'] == '2') echo 'selected'; ?>>A2</option>
                            <option value="3" <?php if ($user_data['Nivel'] == '3') echo 'selected'; ?>>B1</option>
                            <option value="4" <?php if ($user_data['Nivel'] == '4') echo 'selected'; ?>>B2</option>
                            <option value="5" <?php if ($user_data['Nivel'] == '5') echo 'selected'; ?>>C1</option>
                            <option value="6" <?php if ($user_data['Nivel'] == '6') echo 'selected'; ?>>C2</option>
                        </select>
                        <br>
                        <label for="rol">Rol</label><br>
                        <select id="rol" name="rol" required>
                            <option value="">Seleccione</option>
                            <?php
                            $roles = get_roles();
                            foreach ($roles as $rol) {
                                $selected = ($user_data['Rol'] == $rol['Id_rol']) ? 'selected' : '';
                                echo "<option value='{$rol['Id_rol']}' $selected>{$rol['Descripcion']}</option>";
                            }
                            ?>
                        </select>
                        <br>

                        <button type="submit" class="btn-guardar">Guardar</button>
                        <button type="button" onclick="location.href='users.php'" class="btn-cancelar">Cerrar</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($user_delete)): ?>
            <div class="modal-ok">
                <div class="modal-conte">
                    <h2><i class='bx bx-error'></i></h2>
                    <p>Estas seguro de eliminar este usuario?</p>
                    <form action="eliminar_usuario.php" method="post">
                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $user_delete['Id_usuario']; ?>">

                        <button type="submit" class="btn-guardar">Eliminar</button>
                        <button type="button" onclick="location.href='users.php'" class="btn-cancelar">Cancelar</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>


        <!-- Modales Mensajes-->

        <?php if (isset($_GET['success'])): ?>
            <div class="modal-ok">
                <div class="modal-conte">
                    <p>Usuario agregado exitosamente.</p>
                    <a href="users.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'cedula_exists'): ?>
            <div class="modal-cedula">
                <div class="modal-ced">
                    <h2><i class='bx bxs-error'></i></h2>
                    <h2>El numero de cedula ya existe</h2>
                    <p>Verifica los datos ingresados</p>
                    <a href="users.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="modal-not">
                <div class="modal-cont">
                    <h2><i class='bx bxs-error'></i></h2>
                    <p>Hubo un error al agregar el usuario. Por favor, inténtelo de nuevo.</p>
                    <a href="users.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success']  == 'update'): ?>
            <div class="modal-ok">
                <div class="modal-conte">
                    <h2><i class='bx bx-check'></i></h2>
                    <p>Se han registrado los cambios correctamente</p>
                    <a href="users.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'update'): ?>
            <div class="modal-cedula">
                <div class="modal-ced">
                    <h2><i class='bx bxs-error'></i></h2>
                    <p>No se a podido realizar cambios al usuario</p>
                    <a href="users.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success']  == 'delete'): ?>
            <div class="modal-ok">
                <div class="modal-conte">
                    <h2><i class='bx bx-check'></i></h2>
                    <p>Se elimino el usuario correctamente</p>
                    <a href="users.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'delete'): ?>
            <div class="modal-cedula">
                <div class="modal-ced">
                    <h2>Vaya!</h2>
                    <p>No se a podido eliminar el usuario</p>
                    <a href="users.php" class="close-link">Cerrar</a>
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