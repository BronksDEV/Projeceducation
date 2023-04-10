<?php
session_start();
// Verifica se a requisição foi enviada por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera as informações do formulário
    $nomeCompleto = $_POST['nome-completo-atestado'];
    $serie = $_POST['serie-atestado'];
    $turma = $_POST['turma-atestado'];
    $dataInicio = $_POST['data-inicio-atestado'];
    $dataFim = $_POST['data-fim-atestado'];
    $arquivo = $_FILES['arquivo-atestado'];

    // Valida as informações do formulário
    if (empty($nomeCompleto) || empty($serie) || empty($turma) || empty($dataInicio) || empty($dataFim) || $arquivo['error'] !== 0) {
        $_SESSION['mensagem'] = ['tipo' => 'error', 'titulo' => 'Erro!', 'texto' => 'Por favor, preencha todos os campos e selecione um arquivo.'];
    } else {
        // Conecta ao banco de dados
        $conexao = new PDO('mysql:host=;dbname=', '', '');

        // Prepara a consulta SQL para inserir os dados na tabela
        $consulta = $conexao->prepare('INSERT INTO declaracoes (nomeCompleto, serie, turma, dataInicio, dataFim, arquivo) VALUES (?, ?, ?, ?, ?, ?)');

        // Converte as datas para o formato do banco de dados
        $dataInicioFormatada = date('Y-m-d', strtotime($dataInicio));
        $dataFimFormatada = date('Y-m-d', strtotime($dataFim));

        // Executa a consulta SQL, passando as informações como parâmetros
        $consulta->execute([$nomeCompleto, $serie, $turma, $dataInicioFormatada, $dataFimFormatada, $arquivo['name']]);

        // Move o arquivo para a pasta de uploads
        move_uploaded_file($arquivo['tmp_name'], 'uploadsdecs/' . $arquivo['name']);

        $_SESSION['mensagem'] = ['tipo' => 'success', 'titulo' => 'Sucesso!', 'texto' => 'Declaração enviada com sucesso.'];
    }
    header('Location: painel.php');
    exit;
} else {
    // Se a requisição não foi enviada por POST, redireciona para a página inicial
    header('Location: painel.php');
    exit;
}
