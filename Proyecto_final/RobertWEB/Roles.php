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

            <div class="list-container">
                <form method="post" action="">
                    <input type="Combobox" name="search_left" placeholder="Buscar..."><br><br>
                    <select name="left_list[]" multiple size="10">
                        <!-- Opciones generadas dinámicamente por PHP -->
                        <?php
                        // Ejemplo estático
                        echo '<option value="1">Estiven Hurtado</option>';
                        echo '<option value="1">Roberto Cascante</option>';
                        ?>
                    </select><br><br>
                    <button type="submit" name="move_right">&gt;</button>
                </form>
            </div>

            <div class="list-container">
                <form method="post" action="">
                    <input type="text" name="search_right" placeholder="Buscar..."><br><br>
                    <select name="right_list[]" multiple size="10">
                        <!-- Opciones generadas dinámicamente por PHP -->
                        <?php
                        // Ejemplo estático
                        echo '<option value="2">Usuario 1</option>';
                        echo '<option value="2">Estiven Hurtado</option>';

                        ?>
                    </select><br><br>
                    <button type="submit" name="move_left">&lt;</button>
                </form>
            </div>
            <div class="save-button">
                <form method="post" action="">
                    <button type="submit" name="save_changes">Guardar cambios</button>
                </form>
            </div>
        </div>


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