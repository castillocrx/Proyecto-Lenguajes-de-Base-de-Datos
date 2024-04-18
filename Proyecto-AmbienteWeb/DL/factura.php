<?php

use PSpell\Config;

/*
require_once "conexion.php";

function crearFactura($idusuario, $idProducto, $fecha, $precioTotal) {
    $conexion = Conecta();
    $stmt = $conexion->prepare("INSERT INTO facturas (factura_idusuario, factura_idProducto, fecha, precioTotal) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisd", $idusuario, $idProducto, $fecha, $precioTotal);

    return $stmt->execute();
}

