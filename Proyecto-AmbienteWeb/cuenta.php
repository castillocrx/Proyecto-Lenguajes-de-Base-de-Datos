<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!-- preload -->
    <link rel="preload" href="css/style.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/cerrarSesion.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-eUHJ93ZejNlG4zrQ9FCEGrjdvR+XszDW5JTCBh58hvOvj2G+P8v9bwIoUqJCyGdg" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Header -->
    <header>
        <div class="pos-logo">
            <a href="mainProductos.php">
                <img class="logo" src="img/logo.jpg" alt="Logo de tienda">
            </a>
            <h2 class="nombre-tienda">Burger Shop</h2>
        </div>
        <nav class="header-pages">
            <a href="nosotros.php" rel="noopener noreferrer">Nosotros</a>
            <a href="contacto.php" rel="noopener noreferrer">Contáctenos</a>
            <a href="descuentos.php" rel="noopener noreferrer">Descuentos</a>
            <a href="cuenta.php" rel="noopener noreferrer">Cuenta</a>
            <a href="carrito.php">
                <img class="logo" src="img/carrito.png" alt="Logo de tienda">
            </a>
        </nav>

    </header>

    <?php
    session_start();

    //Para detener la sesion
    // session_destroy(); 
    ?>

<div class="bienv-pos">
    <h1 class="display-4 bienvenido">Perfil</h1>
</div>

<main class="container mt-5">
    <div class="productos">

        <?php
        if (isset($_SESSION['correo'])) {
            require_once "DL/usuario.php";
            $usuario = getUsuarioByCorreo($_SESSION['correo']);

            if ($usuario) {
                echo "<div class='producto'>";
                echo "<h1 class='h3'>Hola, " . $usuario['NOMBRE'] . "!</h1>";
                echo "<p class='lead'>Correo: " . $usuario['CORREO'] . "</p>";
                echo "<p class='text-muted'>Dirección: " . $usuario['DIRECCION'] . "</p>";
                echo "<p>Teléfono: " . $usuario['TELEFONO'] . "</p>";
                echo "<button class='btn btn-primary boton-admin' style='background-color: #FF4500' id='cerrarSesionBtn'>Cerrar Sesión</button>";
                if (isset($_SESSION['correo']) && $_SESSION['correo'] === 'admin@gmail.com') {
                    echo "<a href='verUsuarios.php' class='boton-admin' style='background-color: #FF4500'>Ver Usuarios</a></th>";
                } 
                echo "</div>";
            } else {
                echo "<p class='text-danger'>Error al obtener la información del usuario</p>";
            }
        } else {
            header("Location: login.php");
            exit();
        }
        ?>

    </div>
</main>

    <?php
    include_once "include/template/footer.php";
