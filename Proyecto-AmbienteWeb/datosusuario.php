<?php
include_once "include/template/header.php";

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "include/functions/recoge.php";

    $nombre = recogePost("nombre");
    $correo = recogePost("correo");
    $direccion = recogePost("direccion");
    $telefono = recogePost("telefono");
    $contrasena = recogePost("contrasena");

    $nombreOK = false;
    $correoOK = false;
    $direccionOK = false;
    $telefonoOK = false;
    $contrasenaOK = false;

    if ($nombre == "") {
        $errores[] = "No se digito el nombre del usuario";
    } else {
        $nombreOK = true;
    }
    if ($correo == "") {
        $errores[] = "No se digito el correo del usuario";
    } else {
        $correoOK = true;
    }
    if ($direccion == "") {
        $errores[] = "No se digito direccion del usuario";
    } else {
        $direccionOK = true;
    }
    if ($telefono == "") {
        $errores[] = "No se digito el telefono del usuario";
    } else {
        $telefonoOK = true;
    }
    if ($contrasena == "") {
        $errores[] = "No se digito contraseña del usuario";
    } else {
        $contrasenaOK = true;
    }

    if ($nombreOK && $correoOK && $direccionOK && $telefonoOK && $contrasenaOK) {
        echo "Ingreso datos a base de datos";
        require_once "DL/usuario.php";
        if (IngresoUsuario($nombre, $correo, $direccion, $contrasena, $telefono)) {
            header("Location: verUsuarios.php");
        }
    } else {
        echo "Ocurrió un error al ingresar los datos";
    }
}

?>

<main class="contenedor-añadirP">
    <h1 class="pos-h1">Registrar la información del usuario</h1>

    <div class="pos-logo-nosotros">

        <ul class="errores">
            <?php
            foreach ($errores as $error) {
                echo "<li>$error</li>";
            }
            ?>
        </ul>
        <form method="post" class="formulario">
            <p class="pos-h1">
                Registre la información que se le solicita
            </p>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Digite su nombre">
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" placeholder="Digite su correo">
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" placeholder="Digite su direccion">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="number" name="telefono" id="telefono" placeholder="Digite su teléfono">
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" placeholder="Digite su contraseña">
            </div>

            <input type="submit" class="formulario__submit" style='background-color: #FF4500' value="Procesar información">
        </form>
    </div>

</main>

<?php
include "include/template/footer.php";
?>