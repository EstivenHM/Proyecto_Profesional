<?php
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: ../vistas/Menu.php');
    exit();
}
?>

<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="../Stylecss/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>

    <div class="container">

        <form action="../auth/Login.php" method="POST">

            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="usuario" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock'></i>
            </div>
            <div class="Forgot-password">
                <a href="#"></a>
            </div>
            <button type="submit" class="btn"> Login</button>
            <div class="contact">
                <p>Don't have an acount? <a href="https://wa.me/+50683427778" target="_blank">Contact me</a></p>

            </div>

        </form>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'password'): ?>
        <div class="modal-mensaje">
            <div class="modal-msj">
                <h2><i class='bx bxs-error'></i></h2>
                <p>Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo.</p>
                <a href="../vistas/index.php" class="close-link">Cerrar</a>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'inactivo'): ?>
            <div class="modal-mensaje">
                <div class="modal-msj">
                    <h2><i class='bx bxs-error'></i></h2>
                    <p>Tu usuario se encuentra inactivo.</p>
                    <p>Contacta con el administrador.</p>
                    <a href="../vistas/index.php" class="close-link">Cerrar</a>
                </div>
            </div>
        <?php endif; ?>
        
</body>

</html>