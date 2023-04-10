<?php
header('Content-Type: application/json');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "";
    $db_username = "";
    $db_password = "";
    $dbname = "";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(['error' => 'Conexão falhou: ' . $conn->connect_error]);
        exit();
    }

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error' => 'Email inválido.']);
        exit();
    }

    if (strlen($password) < 7) {
        echo json_encode(['error' => 'A senha deve ter pelo menos 7 caracteres.']);
        exit();
    }

    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['error' => 'Já existe um usuário com esse nome ou email.']);
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    $stmt->execute();

    if ($stmt->affected_rows == 1) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Ocorreu um erro ao registrar o usuário.']);
    }

    $stmt->close();
    $conn->close();
}
?>
