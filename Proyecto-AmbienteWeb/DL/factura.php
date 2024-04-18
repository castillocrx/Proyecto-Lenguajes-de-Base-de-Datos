<?php
use PSpell\Config;

require_once "conexion.php";

function crearFactura($idCliente, $idProducto, $fecha, $precioTotal) {
    $conexion = Conecta();
    $stmt = $conexion->prepare("INSERT INTO facturas (factura_idCliente, factura_idProducto, fecha, precioTotal) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisd", $idCliente, $idProducto, $fecha, $precioTotal);

    return $stmt->execute();
}
