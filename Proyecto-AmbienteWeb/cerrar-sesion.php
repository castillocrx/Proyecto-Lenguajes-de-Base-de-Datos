<?php
session_start();

$response = [];

if (isset($_SESSION['correo'])) {
    session_unset();

    // Destruir la sesión
    session_destroy();

    if (!isset($_SESSION['correo'])) {
        $response['success'] = true;
        $response['message'] = 'Sesión cerrada correctamente';
        header('Location: mainProductos.php');
        exit(); 
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al cerrar la sesión';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No hay sesión activa para cerrar';
}

echo json_encode($response);
?>
