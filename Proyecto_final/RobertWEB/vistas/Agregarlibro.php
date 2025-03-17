<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: ../vistas/index.php');
    exit();
}
$username = $_SESSION['username'];

include('../funciones/funciones.php');

$result = Libros_data();

if (isset($_GET['edit_id'])) {
    $libro_data = get_libro_data($_GET['edit_id']);
}
if (isset($_GET['delete_id'])) {
    $libro_delete = get_delete_libro($_GET['delete_id']);
}


?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="../Stylecss/Gestionmaterial.css">
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
            <a href="../vistas/Menu.php"><i class='bx bx-power-off'></i>INICIO</a>
        </div>
    </header>

    <seccion>
        <div class="Home">

            <div class="btn-boton">
                <button onclick="location.href='../vistas/Agregarlibro.php'" class="btn-refrescar" id="A_refrescar"><i class='bx bx-refresh'></i>Refrescar</button>
                <button class="btn-nuevo" id="A_nuevo" onclick="document.getElementById('myModal').style.display='block'"><i class='bx bx-plus'></i>Nuevo</button>
            </div>

            <div class="scrollable-table">
                <table class="table">
                    <thead>
                        <tr class="titulo">

                            <th>Nombre del libro</th>
                            <th>Nivel</th>
                            <th>Ruta del archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="t_body">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td style="display: none;"><?php echo $row['Id_materia'] ?></td>
                                <td><?php echo $row['Nombre'] ?></td>
                                <td><?php echo $row['descripcion']; ?></td>
                                <td><?php echo $row['archivo'] ?></td>
                                <td>
                                    <a href="../vistas/Agregarlibro.php?edit_id=<?php echo $row['Id_materia']; ?>" id="A_editar" class="btn-editar"><i class='bx bxs-pencil'></i></a>
                                    <a href="<?php echo $row['archivo']; ?>" target="_blank" id="A_abrir" class="btn-open"><i class='bx bxs-book-open'></i></a>
                                    <a href="../vistas/Agregarlibro.php?delete_id=<?php echo $row['Id_materia']; ?>" id="A_eliminar" class="btn-eliminar"><i class='bx bxs-x-circle'></i></a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>


            <!------------Modales------------->
            <!--------subir libro---------->

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <form action="../funciones/subirmaterial.php" method="post" enctype="multipart/form-data">
                        <label for="nombre">Nombre del libro</label><br>
                        <input type="text" id="nombre" name="nombre" required>
                        <br>
                        <label for="nivel">Nivel</label>
                        <br>
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

                        <button onclick="location.href='../vistasAgregarlibro.php'" class="btn-cancelar">Cerrar</button>
                    </form>
                </div>
            </div>
            <!--------editar libro---------->

            <?php if (isset($libro_data)): ?>
                <div id="myModal" class="modal" style="display:block;">
                    <div class="modal-content">
                        <form action="../funciones/editar_material.php" method="POST">
                            <input type="hidden" id="Id_materia" name="Id_materia" value="<?php echo $libro_data['Id_materia']; ?>">
                            <label for="nombre">Nombre del libro</label><br>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $libro_data['Nombre']; ?>" required>
                            <br>
                            <label for="nivel">Nivel</label>
                            <select id="nivel" name="nivel" required>
                                <option value="" disabled>Seleccione</option>
                                <option value="1" <?php if ($libro_data['Nivel'] == '1') echo 'selected'; ?>>A1</option>
                                <option value="2" <?php if ($libro_data['Nivel'] == '2') echo 'selected'; ?>>A2</option>
                                <option value="3" <?php if ($libro_data['Nivel'] == '3') echo 'selected'; ?>>B1</option>
                                <option value="4" <?php if ($libro_data['Nivel'] == '4') echo 'selected'; ?>>B2</option>
                                <option value="5" <?php if ($libro_data['Nivel'] == '5') echo 'selected'; ?>>C1</option>
                                <option value="6" <?php if ($libro_data['Nivel'] == '6') echo 'selected'; ?>>C2</option>
                            </select>
                            <br>
                            <button type="submit" class="btn-guardar">Guardar</button>
                            <button type="button" onclick="location.href='../vistas/Agregarlibro.php'" class="btn-cancelar">Cerrar</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
            <!--------eliminar libro---------->

            <?php if (isset($libro_delete)): ?>
                <div class="modal-ok">
                    <div class="modal-conte">
                        <h2><i class='bx bx-error'></i></h2>
                        <p>Estas seguro de eliminar este archivo?</p>
                        <form action="../funciones/eliminar_libro.php" method="post">
                            <input type="hidden" id="Id_material" name="Id_material" value="<?php echo $libro_delete['Id_materia']; ?>">

                            <button type="submit" class="btn-guardar">Eliminar</button>
                            <button type="button" onclick="location.href='../vistas/Agregarlibro.php'" class="btn-cancelar">Cancelar</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>


            <!--  Modales mensajes  -->

            <?php if (isset($_GET['success']) && $_GET['success'] == 'update'): ?>
                <div class="modal-ok">
                    <div class="modal-conte">
                        <h2><i class='bx bx-check'></i></h2>
                        <p>Se ha creado el libro correctamente</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>

            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'update'): ?>
                <div class="modal-cedula">
                    <div class="modal-ced">
                        <h2>Vaya!</h2>
                        <p>No se pudo subir el material</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>

            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'pdf'): ?>
                <div class="modal-cedula">
                    <div class="modal-ced">
                        <h2>Formato inválido</h2>
                        <p>Solo se permiten archivos PDF</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>

            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'upload'): ?>
                <div class="modal-cedula">
                    <div class="modal-ced">
                        <h2>Error de subida</h2>
                        <p>Hubo un problema al subir el archivo. Intente nuevamente.</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success']) && $_GET['success']  == 'editado'): ?>
                <div class="modal-ok">
                    <div class="modal-conte">
                        <h2><i class='bx bx-check'></i></h2>
                        <p>Se han registrado los cambios correctamente</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'editado'): ?>
                <div class="modal-cedula">
                    <div class="modal-ced">
                        <h2>Vaya!</h2>
                        <p>No se a podido realizar cambios al documento</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>
            <?php endif; ?>
            <!--------eliminar libro---------->
            <?php if (isset($_GET['success']) && $_GET['success']  == 'delete'): ?>
                <div class="modal-ok">
                    <div class="modal-conte">
                        <h2><i class='bx bx-check'></i></h2>
                        <p>Se elimino el archivo correctamente</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'delete'): ?>
                <div class="modal-cedula">
                    <div class="modal-ced">
                        <h2>Vaya!</h2>
                        <p>No se a podido eliminar el archivo</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'notfound'): ?>
                <div class="modal-cedula">
                    <div class="modal-ced">
                        <h2>Vaya!</h2>
                        <p>No se encontro el archivo</p>
                        <a href="../vistas/Agregarlibro.php" class="close-link">Cerrar</a>
                    </div>
                </div>
            <?php endif; ?>
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