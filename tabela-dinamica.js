$(document).ready(function() {
    // Carrega a tabela dinâmica quando a página carrega
    loadTable();
  
    // Quando o botão Secretaria é clicado, exibe a tabela dinâmica
    $('#btn-secretaria').on('click', function() {
      $('#tabela-secretaria').show();
      $('.tabela-dinamica-container').show();
      $('#busca-aluno').val('');
      loadTable();
    });
  
    // Quando o campo de busca é preenchido, filtra a tabela dinâmica
    $('#busca-aluno').on('keyup', function() {
      filterTable($(this).val());
    });
  });
  
  // Função para carregar a tabela dinâmica
function loadTable() {
    $.ajax({
      url: 'tabela.php',
      type: 'GET',
      dataType: 'html',
      success: function(data) {
        // Formata os dados em maiúsculo
        var dados = data.toUpperCase();
        // Insere os dados na tabela
        $('#tabela-dinamica tbody').html(dados);
      },
      error: function() {
        alert('Erro ao carregar dados da tabela.');
      }
    });
  }
  
  
  // Função para filtrar a tabela dinâmica
  function filterTable(value) {
    $('#tabela-dinamica tbody tr').each(function() {
      var found = 'false';
      $(this).each(function() {
        if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
          found = 'true';
        }
      });
      if (found == 'true') {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }
  
  function fecharTabela() {
    document.getElementById("tabela-secretaria").style.display = "none";
  }


  