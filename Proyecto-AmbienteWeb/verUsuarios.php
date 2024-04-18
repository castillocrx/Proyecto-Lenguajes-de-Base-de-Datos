<?php
include_once "include/template/header.php";

?>

<main class="contenedor">
    <h1 class="pos-h1">Lista de clientes</h1>

    <div class="productos">
        <?php
        require_once "DL/cliente.php";
        $elSql = "SELECT idCliente, nombre, correo, direccion, telefono FROM clientes";
        $myArray = getArray2($elSql);
        if (!empty($myArray)) {
            foreach ($myArray as $value) {
                echo "<div class='producto'>";
                echo "<h2>Datos del cliente</h2>";
                echo "<table>";
                echo "<tr><th>Nombre</th><td>{$value['NOMBRE']}</td></tr>";
                echo "<tr><th>Correo</th><td>{$value['CORREO']}</td></tr>";
                echo "<tr><th>Dirección</th><td>{$value['DIRECCION']}</td></tr>";
                echo "<tr><th>Teléfono</th><td>{$value['TELEFONO']}</td></tr>";
                echo "</table>";
                echo "<br>";
                echo "<br>";
                echo "</div>";
            }
        } else {
            echo "No hay registros de clientes";
        }

        ?>

    </div>

</main>

<?php
include "include/template/footer.php";
?>