<?php
include_once "include/template/header.php";

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "include/functions/recoge.php";

    $correo = recogePost("correo");
    $contrasena = recogePost("contrasena");

    //Investigar expresiones regulares en PHP
    if ($correo == "") {
        $errores[] = "No se digito el correo";
    }
    if ($contrasena == "") {
        $errores[] = "No se digito la contraseña";
    }

    if (empty($errores)) {
        // echo "Ingreso datos a base de datos";
        require_once "DL/cliente.php";
        $query = "select idCliente, nombre, correo, direccion, telefono, password from clientes where correo = '$correo'";
        $mySession = getObject2($query);

        if($mySession != null){
            $auth = password_verify($contrasena, $mySession['PASSWORD']);
            if($auth){
                session_start();
                $_SESSION['correo'] = $mySession['CORREO'];
                $_SESSION['idCliente'] = $mySession['IDCLIENTE'];
                $_SERVER['login'] = true;
                header("Location: cuenta.php");
            }else{
                $errores[] = "No se pudo iniciar sesión";
            }
        }else{
            $errores[] = "Usuario no existe";
        }
    }
}
?>

<main class="contenedor-añadirP">
    <h1 class="pos-h1">Inicio de sesión</h1>

    <div class="pos-logo-nosotros">

        <ul class="errores">
            <?php
            foreach ($errores as $error) {
                echo "<li>$error</li>";
            }
            ?>
        </ul>
        <form method="post" class="formulario">
            <!-- novalidate -->
            <div class="form-group">
                <label for="correo">Digite el Correo:</label>
                <input type="email" name="correo" id="correo" placeholder="Digite su correo">
            </div>
            <div class="form-group">
                <label for="contrasena">Digite la contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" placeholder="Digite su contraseña">
            </div>
            <input type="submit" class="formulario__submit" style='background-color: #FF4500' value="Ingreso"><br>
            <a href="datosCliente.php"  class="boton-admin" style='background-color: #FF4500' rel="noopener noreferrer">Agregar cuenta</a>
        </form>
    </div>

</main>
