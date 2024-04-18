<?php
include_once "include/template/header.php";

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "include/functions/recoge.php";

    $nombre = recogePost("nombre");
    $descripcion = recogePost("descripcion");
    $imagen = recogePost("imagen");
    $precio = recogePost("precio");

    $nombreOK = !empty($nombre);
    $descripcionOK = !empty($descripcion);
    $imagenOK = !empty($imagen);
    $precioOK = !empty($precio);

    if (!$nombreOK) {
        $errores[] = "No se digitó el nombre del producto";
    }
    if (!$descripcionOK) {
        $errores[] = "No se digitó el detalle del producto";
    }
    if (!$imagenOK) {
        $errores[] = "No se digitó la URL de la imagen del producto";
    }
    if (!$precioOK) {
        $errores[] = "No se digitó el precio del producto";
    }

    if ($nombreOK && $descripcionOK && $imagenOK && $precioOK) {
        require_once "DL/producto.php";
        if (IngresoProducto($nombre, $descripcion, $imagen, $precio)) {
            header("Location: mainProductos.php");
        }
    }
}
?>

<main class="contenedor-añadirP">
    <h1 class="pos-h1">Registrar la información del producto</h1>

    <div class="productos">
        <ul class="errores">
            <?php
            foreach ($errores as $error) {
                echo "<li>$error</li>";
            }
            ?>
        </ul>

        <form method="post" class="formulario">
            <div class="form-group">
                <label for="nombre">Nombre Producto:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Digite el nombre del producto" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Detalle Producto:</label>
                <input type="text" name="descripcion" id="descripcion" placeholder="Digite la descripción del producto" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen Producto:</label>
                <input type="url" name="imagen" id="imagen" placeholder="Digite la URL de la imagen" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio Producto:</label>
                <input type="number" name="precio" id="precio" placeholder="Digite el precio" required>
            </div>
            <input type="submit" class="formulario__submit" style='background-color: #FF4500' value="Procesar información">
        </form>
    </div>
</main>

<?php
require_once "include/template/footer.php";
?>