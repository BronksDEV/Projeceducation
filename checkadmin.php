<?php
session_start();
$response = array();

if (isset($_POST['checkadmin'])) {
    if (isset($_SESSION['tipo_usuario'])) {
        $response['tipo_usuario'] = $_SESSION['tipo_usuario'];
    } else {
        $response['error'] = "Usuário não autenticado.";
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
