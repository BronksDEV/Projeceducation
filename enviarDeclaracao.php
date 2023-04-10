<?php
session_start(); // Inicie a sessão no início do arquivo

// Verifica se a requisição foi enviada por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera as informações do formulário
    $nomeCompleto = $_POST['nome-completo'];
    $serie = $_POST['serie'];
    $turma = $_POST['turma'];
    $disciplina = $_POST['disciplina'];
    $dataEnvio = $_POST['data-envio'];
    $arquivo = $_FILES['arquivo'];

    // Valida as informações do formulário
    if (empty($nomeCompleto) || empty($serie) || empty($turma) || empty($disciplina) || empty($dataEnvio) || $arquivo['error'] != 0) {
        $_SESSION['mensagem'] = ['tipo' => 'error', 'titulo' => 'Erro!', 'texto' => 'Por favor, preencha todos os campos.'];
    } else {
        // Conecta ao banco de dados
        $conexao = new PDO('mysql:host=;dbname=', '', '');

        // Prepara a consulta SQL para inserir os dados na tabela
        $consulta = $conexao->prepare('INSERT INTO atividades (nomeCompleto, serie, turma, disciplina, dataEnvio, arquivo) VALUES (?, ?, ?, ?, ?, ?)');

        // Converte a data para o formato do banco de dados
        $dataEnvioFormatada = date('Y-m-d', strtotime($dataEnvio));

        // Executa a consulta SQL, passando as informações como parâmetros
        $consulta->execute([$nomeCompleto, $serie, $turma, $disciplina, $dataEnvioFormatada, $arquivo['name']]);

        // Move o arquivo para a pasta de uploads
        move_uploaded_file($arquivo['tmp_name'], 'uploads/' . $arquivo['name']);

        $_SESSION['mensagem'] = ['tipo' => 'success', 'titulo' => 'Sucesso!', 'texto' => 'Atividade enviada com sucesso.'];
    }
    header('Location: painel.php');
    exit;
} else {
    // Se a requisição não foi enviada por POST, redireciona para a página inicial
    header('Location: painel.php');
    exit;
}

?>
