<?php
// Definir as informações de conexão com o banco de dados
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Criar uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi bem sucedida
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fazer uma consulta para buscar as informações da tabela "atividades"
$sql = "SELECT nomeCompleto, serie, turma, disciplina, dataEnvio, arquivo FROM atividades";
$result = $conn->query($sql);

// Gerar a tabela HTML dinamicamente
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["nomeCompleto"] . "</td>";
    echo "<td>" . $row["serie"] . "</td>";
    echo "<td>" . $row["turma"] . "</td>";
    echo "<td>" . $row["disciplina"] . "</td>";
    echo "<td><a href='uploads/" . $row["arquivo"] . "' download>" . $row["arquivo"] . "</a></td>";
    echo "<td>" . $row["dataEnvio"] . "</td>";
    echo "</tr>";
  }
}
