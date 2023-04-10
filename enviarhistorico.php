<?php
session_start(); // Inicie a sessão no início do arquivo

// Verifica se a requisição foi enviada por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera as informações do formulário
    $nomeCompleto = $_POST['nome-completo'];
    $anoConclusao = $_POST['ano-conclusao'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Valida as informações do formulário
    if (empty($nomeCompleto) || empty($anoConclusao) || empty($email) || empty($telefone)) {
        $_SESSION['mensagem'] = ['tipo' => 'error', 'titulo' => 'Erro!', 'texto' => 'Por favor, preencha todos os campos.'];
    } else {
        // Conecta ao banco de dados
        $conexao = new mysqli('', '', '', '');

        // Verifica se a conexão foi estabelecida com sucesso
        if ($conexao->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Prepara a consulta SQL para inserir os dados na tabela
        $consulta = $conexao->prepare('INSERT INTO historico (nome_completo, ano_conclusao, email, telefone) VALUES (?, ?, ?, ?)');

        // Executa a consulta SQL, passando as informações como parâmetros
        $consulta->bind_param('ssss', $nomeCompleto, $anoConclusao, $email, $telefone);
        $consulta->execute();

        $_SESSION['mensagem'] = ['tipo' => 'success', 'titulo' => 'Sucesso!', 'texto' => 'Dados inseridos com sucesso.'];

        // Fecha a conexão com o banco de dados
        $conexao->close();
    }

    // Redireciona para a página inicial
    header('Location: painel.php');
    exit;
}
?>
