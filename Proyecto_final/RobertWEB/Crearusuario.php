<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylecss/newuser.css">
    <link rel="Stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Add new user</title>
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
            <form>
                <div class="input-box">
                    <input type="text" name="Cedula" placeholder="Numero de Cedula" required>
                </div>

                <div class="input-box">
                    <input type="text" name="nombre" placeholder="Nombre de usuario" required>
                </div>

                <div class="input-box">
                    <input type="text" name="apellido1" placeholder="Ingrese el primer apellido" required>
                </div>

                <div class="input-box">
                    <input type="text" name="apellido2" placeholder="Ingrese el segundo apellido (opcional)">
                </div>

                <div class="input-box">
                    <input type="mail" name="mail" placeholder="Ingrese el correo electronico" required>
                </div>

                <div class="input-box">
                    <input type="num" name="usuario" placeholder="Ingrese el numero de telefono" required>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Ingrese una contraseña temporal" required>
                </div>

                <button type="submit" class="btn"> Guardar usuario</button>

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