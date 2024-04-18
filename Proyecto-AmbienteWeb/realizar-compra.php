<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detalles de Compra</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="container mt-5">
    <?php
    session_start();

    if (isset($_POST['comprar']) && isset($_POST['id'])) {
        $id = $_POST['id'];

        if (!isset($_SESSION['carrito'][$id])) {
            header("Location: carrito.php");
            exit();
        }

        require_once "DL/factura.php";
        require_once "DL/usuario.php";
        require_once "DL/producto.php";

        $producto = getProductoById($id);

        if (!$producto) {
            header("Location: carrito.php");
            exit();
        }

        $usuario = getusuarioByCorreo($_SESSION['correo']);

        if (!$usuario) {
            header("Location: carrito.php");
            exit();
        }

        $precioTotal = $producto['precio'] + 700;

        $fecha = date('Y-m-d');

        if (crearFactura($usuario['idusuario'], $producto['id'], $fecha, $precioTotal)) {
            echo "<h1 class='display-4'>Detalles de la Compra</h1>";
            echo "<p><strong>Nombre del usuario:</strong> {$usuario['nombre']}</p>";
            echo "<p><strong>Correo del usuario:</strong> {$usuario['correo']}</p>";
            echo "<p><strong>Nombre del Producto:</strong> {$producto['nombre']}</p>";
            echo "<p><strong>Descripción del Producto:</strong> {$producto['descripcion']}</p>";
            echo "<img src='{$producto['imagen']}' alt='Imagen del producto' class='img-thumbnail' height='100'>";
            echo "<p><strong>Precio del Producto:</strong> {$producto['precio']}</p>";
            echo "<p><strong>Fecha de Factura:</strong> $fecha</p>";
            echo "<p><strong>Precio Total de la Factura:</strong> $precioTotal</p>";

            // eliminar el producto del carrito después de comprar
            unset($_SESSION['carrito'][$id]);

            echo "<a href='carrito.php' class='btn btn-primary' style='background-color: #FF4500' >Volver al Carrito</a>";
        } else {
            echo "<p class='alert alert-danger'>Error al realizar la compra</p>";
        }
    } else {
        header("Location: carrito.php");
        exit();
    }
    ?>

    <!-- Enlace a Bootstrap JS y jQuery (opcional, según tus necesidades) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>