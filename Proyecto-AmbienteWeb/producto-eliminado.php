<?php
include_once "include/template/header.php";

?>

<main class="contenedor">
    <h1 class="pos-h1">Producto seleccionado</h1>

    <div class="productos">
            <?php
            require_once "DL/producto.php";
            require_once "include/functions/recoge.php";

            $idProducto = filter_var(recogeGet('id'), FILTER_VALIDATE_INT);

            if ($idProducto !== false) {
                if (eliminarProducto($idProducto)) {
                    echo "Producto eliminado correctamente.";
                } else {
                    echo "Error al eliminar el producto.";
                }
            } else {
                echo "ID de producto no válido.";
            }
            ?>

    </div>

</main>
