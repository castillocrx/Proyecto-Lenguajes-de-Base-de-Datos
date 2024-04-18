<?php
include_once "include/template/header.php";
session_start();
?>

<div class="bienv-pos">
    <h1 class="bienvenido">Nuestras hamburguesas.</h1>
</div>

<main class="contenedor">
    <div class="productos">
        <?php
        require_once "DL/producto.php";
        $elSql = "select idProducto, nombre, descripcion, imagen, precio from productos";
        $myArray = getArray($elSql);
        if (!empty($myArray)) {
            foreach ($myArray as $value) {
                echo "<div class='producto'>";
                echo "<h2>{$value['NOMBRE']}</h2>";
                echo "<p>{$value['DESCRIPCION']}</p>";
                echo "<img src='{$value['IMAGEN']}' alt='Imagen del producto' height='100'>";
                echo "<p>Precio: {$value['PRECIO']}</p>";
                echo "<a href=mostrar-producto.php?id={$value['IDPRODUCTO']} class='boton-admin' style='background-color: #FF4500'>Ver Producto</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay productos disponibles.</p>";
        }
        ?>
    </div>
</main>
<?php
if (isset($_SESSION['correo']) && $_SESSION['correo'] === 'admin@gmail.com') {
    echo "<a href='añadir-producto.php' style='background-color: #FF4500' class='boton-admin'>Añadir Productos</a>";
}




require_once "include/template/footer.php";
?>