<?php

use PSpell\Config;

require_once "conexion.php";

function IngresoProducto($pNombre, $pDescripcion, $pImagen, $pPrecio) {
    $retorno = false;

    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, "INSERT INTO productos (nombre, descripcion, imagen, precio) VALUES (:iNombre, :iDescripcion, :iImagen, :iPrecio)");

        oci_bind_by_name($stmt, ":iNombre", $pNombre);
        oci_bind_by_name($stmt, ":iDescripcion", $pDescripcion);
        oci_bind_by_name($stmt, ":iImagen", $pImagen);
        oci_bind_by_name($stmt, ":iPrecio", $pPrecio);

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


function getArray($sql) {
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

function getObject($sql) {
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

function eliminarProducto($idProducto) {
    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, "BEGIN eliminar_producto(:idProducto); END;");
        oci_bind_by_name($stmt, ":idProducto", $idProducto);

        if (oci_execute($stmt)) {
            return true;
        } else {
            $error = oci_error($stmt);
            echo "Error al ejecutar el procedimiento almacenado: " . $error['message'];
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




