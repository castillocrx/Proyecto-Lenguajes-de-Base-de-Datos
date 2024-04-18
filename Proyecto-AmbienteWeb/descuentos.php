<?php
include_once "include/template/header.php";
?>



<div class="bienv-pos">
    <h1 class="bienvenido">Nuestros descuentos.</h1>
</div>

<main class="contenedor">
    <div class="productos">
        <?php
        require_once "DL/producto.php";
        $elSql = "SELECT id, nombre, descripcion, imagen, precio FROM productos WHERE precio < 5000";
        $myArray = getArray($elSql);

        if (!empty($myArray)) {
            foreach ($myArray as $value) {
                echo "<div class='producto'>";
                echo "<h2>{$value['nombre']}</h2>";
                echo "<p>{$value['descripcion']}</p>";
                echo "<img src='{$value['imagen']}' alt='Imagen del producto' height='100'>";
                echo "<p>Precio: {$value['precio']}</p>";
                echo "<a href=mostrar-producto.php?id={$value['id']} class='boton-admin' style='background-color: #FF4500'>Ver Producto</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay descuentos disponibles en este momento.</p>";
        }
        ?>
    </div>
</main>
<?php
require_once "include/template/footer.php";
?>
