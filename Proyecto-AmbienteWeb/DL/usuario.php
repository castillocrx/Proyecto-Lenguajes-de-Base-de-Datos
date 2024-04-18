<?php

use PSpell\Config;

require_once "conexion.php";

function IngresoUsuario($pNombre, $pCorreo, $pDireccion, $pContrasena, $pTelefono) {
    $retorno = false;

    try {
        $oConexion = Conecta();

        // Encriptar la contraseña utilizando PASSWORD_BCRYPT en PHP
        $hashContrasena = password_hash($pContrasena, PASSWORD_BCRYPT);

        $stmt = oci_parse($oConexion, "BEGIN insertar_usuario(:pNombre, :pCorreo, :pDireccion, :pContrasena, :pTelefono); END;");
        oci_bind_by_name($stmt, ":pNombre", $pNombre);
        oci_bind_by_name($stmt, ":pCorreo", $pCorreo);
        oci_bind_by_name($stmt, ":pDireccion", $pDireccion);
        oci_bind_by_name($stmt, ":pContrasena", $hashContrasena); 
        oci_bind_by_name($stmt, ":pTelefono", $pTelefono);

        if (oci_execute($stmt)) {
            $retorno = true;
        } else {
            $error = oci_error($stmt);
            echo "Error al ejecutar el procedimiento almacenado: " . $error['message'];
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


function getUsuarioByCorreo($correo) {
    try {
        $oConexion = Conecta();

        $stmt = oci_parse($oConexion, "SELECT idUsuario, nombre, correo, direccion, telefono FROM usuarios WHERE correo = :iCorreo");

        oci_bind_by_name($stmt, ":iCorreo", $correo);

        if (oci_execute($stmt)) {
            $usuario = null;

            while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $usuario = $row;
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

    return $usuario;
}
