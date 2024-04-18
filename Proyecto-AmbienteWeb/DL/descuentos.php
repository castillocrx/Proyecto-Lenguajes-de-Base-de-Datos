<?php

use PSpell\Config;

require_once "conexion.php";

function IngresoDescuento($pNombre, $pDescripcion, $pImagen, $pPrecio, $pFinal) {
    $retorno = false;

    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, "INSERT INTO productos (nombre, descripcion, imagen, precio, fecha_finalizacion) VALUES (:iNombre, :iDescripcion, :iImagen, :iPrecio, :Final)");

        oci_bind_by_name($stmt, ":iNombre", $pNombre);
        oci_bind_by_name($stmt, ":iDescripcion", $pDescripcion);
        oci_bind_by_name($stmt, ":iImagen", $pImagen);
        oci_bind_by_name($stmt, ":iPrecio", $pPrecio);
        oci_bind_by_name($stmt, ":iFinal", $pFinal);

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


function getArray3($sql) {
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

function getObject3($sql) {
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

function eliminarDescuento($idProducto) {
    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, "DELETE FROM productos WHERE idProducto = :idProducto");
        oci_bind_by_name($stmt, ":idProducto", $idProducto);

        if (oci_execute($stmt)) {
            return true;
        } else {
            $error = oci_error($stmt);
            echo "Error al ejecutar la consulta: " . $error['message'];
            return false;
        }
    } catch (\Throwable $th) {
        echo "Error inesperado: " . $th->getMessage();
        error_log("Error inesperado: " . $th->getMessage(), 0);
        return false;
    } finally {
        Desconecta($oConexion);
    }
}


function getProductoById($id) {
    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, "SELECT idProducto, nombre, descripcion, imagen, precio FROM productos WHERE idProducto = :idProducto");
        oci_bind_by_name($stmt, ":idProducto", $id);

        if (oci_execute($stmt)) {
            $producto = null;

            while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $producto = $row;
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

    return $producto;
}




