<?php

function Conecta() {
    $host = "localhost"; // Cambia esto por la dirección del servidor de Oracle
    $port = "1521"; // Puerto por defecto de Oracle
    $sid = "orcl"; // SID de tu base de datos Oracle
    $usuario = "admin_tienda"; // Nombre de usuario de Oracle
    $contraseña = "admin123"; // Contraseña del usuario de Oracle

    // Cadena de conexión a Oracle
    $dsn = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SID=$sid)))";

    // Intenta conectar a Oracle
    $conexion = oci_connect($usuario, $contraseña, $dsn);

    if(!$conexion) {
        $error = oci_error();
        echo "Ocurrió un error al establecer la conexión: " . $error['message'];
        return false;
    }

    return $conexion;
}

function Desconecta($conexion) {
    oci_close($conexion);
}
