<?php

use PSpell\Config;

require_once "conexion.php";

function IngresoCliente($pNombre, $pCorreo, $pDireccion, $pTelefono, $pContrasena) {
    $retorno = false;

    try {
        $oConexion = Conecta();

        // Hash de la contraseña utilizando Bcrypt (opcional en Oracle)
        $hashContrasena = password_hash($pContrasena, PASSWORD_BCRYPT);

        $stmt = oci_parse($oConexion, "INSERT INTO clientes (nombre, correo, direccion, telefono, password) VALUES (:iNombre, :iCorreo, :iDireccion, :iTelefono, :iContrasena)");
        
        oci_bind_by_name($stmt, ":iNombre", $pNombre);
        oci_bind_by_name($stmt, ":iCorreo", $pCorreo);
        oci_bind_by_name($stmt, ":iDireccion", $pDireccion);
        oci_bind_by_name($stmt, ":iTelefono", $pTelefono);
        oci_bind_by_name($stmt, ":iContrasena", $hashContrasena); // Almacenar el hash en lugar de la contraseña original

        if (oci_execute($stmt)) {
            $retorno = true;
        } else {
            $error = oci_error($stmt);
            echo "Error al ejecutar la consulta: " . $error['message'];
        }

    } catch (\Throwable $th) {
        echo "Error inesperado: " . $th->getMessage();
        error_log("Error inesperado: " . $th->getMessage(), 0);
    } finally {
        Desconecta($oConexion);
    }

    return $retorno;
}


function getArray2($sql) {
    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, $sql);
        
        if (oci_execute($stmt)) {
            $retorno = array();

            while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $retorno[] = $row;
            }
        } else {
            $error = oci_error($stmt);
            echo "Error al ejecutar la consulta: " . $error['message'];
        }

    } catch (\Throwable $th) {
        echo "Error inesperado: " . $th->getMessage();
        error_log("Error inesperado: " . $th->getMessage(), 0);
    } finally {
        Desconecta($oConexion);
    }

    return $retorno;
}


function getObject2($sql) {
    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, $sql);
        
        if (oci_execute($stmt)) {
            $retorno = null;

            while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $retorno = $row;
            }
        } else {
            $error = oci_error($stmt);
            echo "Error al ejecutar la consulta: " . $error['message'];
        }

    } catch (\Throwable $th) {
        echo "Error inesperado: " . $th->getMessage();
        error_log("Error inesperado: " . $th->getMessage(), 0);
    } finally {
        Desconecta($oConexion);
    }

    return $retorno;
}


function getClienteByCorreo($correo) {
    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, "SELECT idCliente, nombre, correo, direccion, telefono FROM clientes WHERE correo = :iCorreo");

        oci_bind_by_name($stmt, ":iCorreo", $correo);

        if (oci_execute($stmt)) {
            $cliente = null;

            while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $cliente = $row;
            }
        } else {
            $error = oci_error($stmt);
            echo "Error al ejecutar la consulta: " . $error['message'];
        }

    } catch (\Throwable $th) {
        echo "Error inesperado: " . $th->getMessage();
        error_log("Error inesperado: " . $th->getMessage(), 0);
    } finally {
        Desconecta($oConexion);
    }

    return $cliente;
}
