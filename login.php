<?php
session_start();

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "";
    $db_username = "";
    $db_password = "";
    $dbname = "";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        $response['error'] = "Conexão falhou: " . $conn->connect_error;
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (!empty($username) && !empty($password)) {
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $username;
                    $_SESSION['tipo_usuario'] = $user['tipo_usuario'];
                    $response['success'] = true;
                    $response['tipo_usuario'] = $user['tipo_usuario'];
                    $response['user_id'] = $user['id']; // adiciona o ID do usuário à resposta
                } else {
                    $_SESSION['mensagem'] = array(
                        'titulo' => 'Erro de login',
                        'texto' => 'Nome de usuário ou senha inválidos.',
                        'tipo' => 'danger'
                    );
                    $response['error'] = "Nome de usuário ou senha inválidos.";
                }
            } else {
                $_SESSION['mensagem'] = array(
                    'titulo' => 'Erro de login',
                    'texto' => 'Nome de usuário ou senha inválidos.',
                    'tipo' => 'danger'
                );
                $response['error'] = "Nome de usuário ou senha inválidos.";
            }
        } else {
            $_SESSION['mensagem'] = array(
                'titulo' => 'Erro de login',
                'texto' => 'Por favor, insira um nome de usuário e senha.',
                'tipo' => 'danger'
            );
            $response['error'] = "Por favor, insira um nome de usuário e senha.";
        }

        $conn->close();
    }
}

header('Content-Type: application/json');
echo json_encode($response);
