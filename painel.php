<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: painel.php');
  exit;
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="painelestilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    
</head>
</head>
<body>
   <header>
<h1><a href="#"></a></h1>
        <nav class="nav-top">
          <ul>
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#" onclick="showMessage()"><i class="fa fa-user"></i> Perfil</a></li>
          <li><a href="https://wa.me/61993221251" target="_blank"><i class="fab fa-whatsapp"></i> Contato</a></li>
          <li><a href="https://drive.google.com/file/d/1iOorseTkfreZ14RGn8EMWzdM_wOUBlE1/view?usp=sharing" target="_blank"><i class="fa fa-file"></i> Notas</a></li>
          </ul>
        </nav>
    </header> 

    <!-- A TABELA DA SEC COMEÇA AQUI -->

    <div id="tabela-secretaria" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 100;">
  <div class="tabela-dinamica-container" style="background-color: #fff; padding: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); max-width: 90vw; overflow-x: auto;">
    <input type="text" id="busca-aluno" placeholder="Buscar por nome..." style="margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; width: 100%; max-width: none;">
    <table id="tabela-dinamica" style="border-collapse: collapse; width: 100%; text-align: center;">
      <thead style="background-color: #f2f2f2;">
        <tr>
          <th style="padding: 10px; border: 1px solid #ccc;">Nome Completo</th>
          <th style="padding: 10px; border: 1px solid #ccc;">Série</th>
          <th style="padding: 10px; border: 1px solid #ccc;">Turma</th>
          <th style="padding: 10px; border: 1px solid #ccc;">Disciplina</th>
          <th style="padding: 10px; border: 1px solid #ccc;">Arquivo</th>
          <th style="padding: 10px; border: 1px solid #ccc;">Data de Envio</th>
        </tr>
      </thead>
      <tbody>
        <!-- Dados da tabela serão inseridos aqui dinamicamente -->
      </tbody>
      <tfoot style="background-color: #f2f2f2;">
        <tr>
          <td colspan="6" style="padding: 10px; border: 1px solid #ccc;">
            <button type="button" onclick="fecharTabela()" style="padding: 10px; border: none; background-color: #f44336; color: #fff; cursor: pointer;">Fechar</button>
          </td>
        </tr>
      </tfoot>
    </table>
    <style>
      #tabela-dinamica tr:nth-child(even) {background-color: #f2f2f2;}
      #tabela-dinamica td {padding: 10px; border: 1px solid #ccc;}
      #tabela-dinamica th {padding: 10px; border: 1px solid #ccc;}
      #tabela-dinamica tfoot td {text-align: center;}
      
      #tabela-dinamica th:not(:nth-child(5)),
      #tabela-dinamica td:not(:nth-child(5)) {
        text-transform: uppercase;
      }
    </style>
  </div>
</div>


    <!-- A TABELA DA SEC TERMINA AQUI -->

    <div class="container">
   <div class="sidebar">
        <nav>
            <img class="foto-perfil" src="image.png" alt="Foto de perfil">
            <nav>
                <a href="#" target="_self"><i class="fa fa-file"></i> Documentos</a>
                <a href="#" onclick="showTable(event)">
                 <i class="fas fa-user-secret"></i> Secretaria</a>
                <div id="error-message"></div>
                <div class="message"></div>
                <a href="http://bndigital.bn.gov.br/acervodigital/" target="_blank"><i class="fa fa-book"></i> Biblioteca</a>
                <a href="index.html" class="logout-button" target="_self"><i class="fa fa-sign-out-alt"></i> Sair</a>
            </nav>
        </nav>
   </div>
</div>
       <main class="main-conteudo">
  <div class="espaco-trabalhos">
    <h2>Trabalhos e Atividades.</h2>
    <p>Aqui você pode enviar seus trabalhos e atividades.</p>
    <button class="btn-enviar">Enviar Trabalho</button>
    <div id="form-enviar-atividade" class="form-enviar-atividade" style="display: none;">

    <form method="POST" action="enviarDeclaracao.php" enctype="multipart/form-data" style="text-align: center;">
    <label for="nome-completo">Nome Completo</label>
    <input type="text" id="nome-completo" name="nome-completo" onclick="this.value = this.value.toUpperCase()">
    
    <label for="serie" style="display: block; margin-top: 20px;">Série</label>
    <select id="serie" name="serie" style="display: block; margin: 0 auto; padding: 10px; border-radius: 5px; border: none; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);">
  <option value="1">1ª série</option>
  <option value="2">2ª série</option>
  <option value="3">3ª série</option>
</select>
    
    
    <label for="turma" style="display: block; margin-top: 20px;">Turma</label>
    <select id="turma" name="turma" style="display: block; margin: 0 auto; padding: 10px; border-radius: 5px; border: none; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);">
  <option value="turma1">Turma A</option>
  <option value="turma2">Turma B</option>
</select>
    
<label for="disciplina" style="display: block; margin-top: 20px; text-align: center;">Disciplina</label>
    <select id="disciplina" name="disciplina" style="display: block; margin: 0 auto; padding: 10px; border-radius: 5px; border: none; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);">
        <option value="portugues">LÍNGUA PORTUGUESA </option>
        <option value="educacao_fisica">EDUCAÇÃO FÍSICA </option>
        <option value="arte">ARTE </option>
        <option value="ingles">LÍNGUA EST. MODERNA - INGLÊS </option>
        <option value="quimica">QUÍMICA </option>
        <option value="fisica">FÍSICA  </option>
        <option value="historia">HISTÓRIA  </option>
        <option value="filosofia">FILOSOFIA  </option>
        <option value="sociologia">SOCIOLOGIA   </option>
        <option value="matematica">MATEMÁTICA  </option>
    </select>

    <label for="arquivo" style="display: block; margin-top: 20px; text-align: center;">Enviar arquivo:</label>
    <input type="file" id="arquivo" name="arquivo" style="display: block; margin: 0 auto;">

    <label for="data-envio" style="display: block; margin-top: 20px; text-align: center;">Data de envio</label>
    <input type="date" id="data-envio" name="data-envio" style="display: block; margin: 0 auto;">

    <button type="submit" formaction="enviarDeclaracao.php" style="background-color: #ff0808; color: white; border: none; border-radius: 5px; padding: 10px; font-size: 1em; cursor: pointer; margin-top: 20px;">Enviar</button>
    <button type="button" class="btn-fechar" style="margin-top: 20px;">Fechar</button>
</form>



    </div>
  </div>

  <div class="espaco-atestado">
    <h2>Enviar Declaração</h2>
    <p>Aqui você pode enviar seus atestados ou declarações para a secretaria.</p>
    <button class="btn-atestado">Enviar Documento</button>
    <div class="form-atestado" style="display:none;">
    <form method="POST" action="enviardecs.php" enctype="multipart/form-data">
    <label for="nome-completo-atestado" style="display: block; margin-top: 20px; text-align: center;">Nome Completo:</label>
    <input type="text" id="nome-completo-atestado" name="nome-completo-atestado">

    <label for="serie-atestado" style="display: block; margin-top: 20px; text-align: center;">Série</label>
    <select id="serie-atestado" name="serie-atestado" style="display: block; margin: 0 auto; padding: 10px; border-radius: 5px; border: none; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);">
    <option value="1">1ª série</option>
    <option value="2">2ª série</option>
    <option value="3">3ª série</option>
    </select>
    

    <label for="turma-atestado" style="display: block; margin-top: 20px; text-align: center;">Turma</label>
    
    <select id="turma-atestado" name="serie" style="display: block; margin: 0 auto; padding: 10px; border-radius: 5px; border: none; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);">
    <option value="1">1ª série</option>
    <option value="2">2ª série</option>
    <option value="3">3ª série</option>
  </select>
    

    <label for="data-inicio-atestado" style="display: block; margin-top: 20px; text-align: center;"> Data de início da licença:</label>
    <input type="date" id="data-inicio-atestado" name="data-inicio-atestado">

    <label for="data-fim-atestado" style="display: block; margin-top: 20px; text-align: center;" >Data de término da licença:</label>
    <input type="date" id="data-fim-atestado" name="data-fim-atestado" >

    <label for="arquivo-atestado" style="display: block; margin-top: 20px; text-align: center;" >Enviar arquivo:</label>
    <input type="file" id="arquivo-atestado" name="arquivo-atestado">

    <button type="submit" formaction="enviardecs.php" style="background-color: #ff0808; color: white; border: none; border-radius: 5px; padding: 10px; font-size: 1em; cursor: pointer; margin-top: 20px;">Enviar</button>
    <button type="button" class="btn-fechar" style="margin-top: 20px;">Fechar</button>

</form>

    </div>
  </div>

  <div class="espaco-historico">
  <h2>Solicitar Histórico</h2>
  <p>Aqui você pode solicitar seu Histórico escolar.</p>
  <button class="btn-historico">Solicitar Histórico</button>
  <form class="form-historico" style="display:none;" novalidate method="POST" action="enviarhistorico.php">
  <label for="nome-completo" style="display: block; margin-top: 20px; text-align: center;" >Nome Completo:</label>
  <input type="text" id="nome-completo" name="nome-completo" required style="max-width: 100%; margin-bottom: 10px;">

  <label for="ano-conclusao" style="display: block; margin-top: 20px; text-align: center;">Ano de Conclusão</label>
    <select id="ano-conclusao" name="serie-atestado" style="display: block; margin: 0 auto; padding: 10px; border-radius: 5px; border: none; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);">
    <option value="">Selecione o ano de conclusão</option>
    <option value="2022">2023</option>
    <option value="2022">2022</option>
    <option value="2021">2021</option>
    <option value="2020">2020</option>
    <option value="2019">2019</option>
    <option value="2018">2018</option>
    <option value="2017">2017</option>
  </select>

  <label for="email" style="display: block; margin-top: 20px; text-align: center;">E-mail:</label>
  <input type="email" id="email" name="email" required style="max-width: 100%; margin-bottom: 10px;">

  <label for="telefone" style="display: block; margin-top: 20px; text-align: center;" >Telefone:</label>
  <input type="tel" id="telefone" name="telefone" required minlength="15" maxlength="15" style="max-width: 100%; margin-bottom: 10px;">

  <button type="submit" formaction="enviarhistorico.php" style="width: 100px; margin-right: 10px;">Solicitar</button>
  <button type="button" class="btn-fechar" style="width: 100px;">Fechar</button>
</form>

</div>
</main>
</section>
<footer>
  <div class="social-icons">
    <a href="mailto:seuemail@exemplo.com" target="_blank" rel="noopener noreferrer" aria-label="Email">
      <i class="fas fa-envelope"></i>
    </a>
    <a href="https://www.facebook.com/seuperfil" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://www.instagram.com/seuperfil" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
      <i class="fab fa-instagram"></i>
    </a>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="tabela-dinamica.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.2.0/sweetalert2.min.js"></script>
<script src="//code.jivosite.com/widget/OTkL9Gz2vY" async></script>
<script src="script.js"></script>
<script>
<?php
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    $tipo = $mensagem['tipo'] === 'success' ? 'success' : 'error';
    $titulo = $mensagem['titulo'];
    $texto = $mensagem['texto'];

    // Remove a mensagem da sessão após exibi-la
    unset($_SESSION['mensagem']);
?>
    Swal.fire({
        icon: '<?php echo $tipo; ?>',
        title: '<?php echo $titulo; ?>',
        text: '<?php echo $texto; ?>'
    });
<?php } ?>
</script>

</body>
</html>