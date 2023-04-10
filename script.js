// JS DO BOTÃO ATIVIDADES E TRABALHO

const btnEnviar = document.querySelector(".btn-enviar");
const formEnviarAtividade = document.querySelector("#form-enviar-atividade");
const btnFechar = document.querySelector(".btn-fechar");

btnEnviar.addEventListener("click", function () {
  formEnviarAtividade.style.display = "block";
});

btnFechar.addEventListener("click", function () {
  formEnviarAtividade.style.display = "none";
});


// JS DO BOTÃO ATESTADO

const btnAtestado = document.querySelector('.btn-atestado');
const formAtestado = document.querySelector('.form-atestado');

btnAtestado.addEventListener('click', function() {
  formAtestado.style.display = 'block';
});

const btnFecharAtestado = formAtestado.querySelector('.btn-fechar');

btnFecharAtestado.addEventListener('click', function() {
  formAtestado.style.display = 'none';
});


// JS DO BOTÃO HISTÓRICO

const btnHistorico = document.querySelector('.btn-historico');
const formHistorico = document.querySelector('.form-historico');

btnHistorico.addEventListener('click', function() {
  formHistorico.style.display = 'block';
});

const btnFecharHistorico = formHistorico.querySelector('.btn-fechar');

btnFecharHistorico.addEventListener('click', function() {
  formHistorico.style.display = 'none';
});


// Define o tempo de inatividade em milissegundos (10 minutos)
const inactivityTime = 10 * 60 * 1000; 

let timeoutId;

function resetTimer() {
  // Limpa o timer atual
  clearTimeout(timeoutId);

  // Inicia um novo timer
  timeoutId = setTimeout(() => {
    // Redireciona para a página de login
    window.location.href = 'login.html';
  }, inactivityTime);
}

// Reseta o timer ao clicar em algum lugar da página
document.addEventListener('click', resetTimer);

// Reseta o timer ao pressionar alguma tecla
document.addEventListener('keydown', resetTimer);

// Inicia o timer
resetTimer();


// Seleciona o input de telefone
const telefoneInput = document.getElementById('telefone');

// Adiciona um listener para o evento 'input'
telefoneInput.addEventListener('input', function(e) {
  // Remove tudo que não for número
  let telefone = e.target.value.replace(/\D/g, '');

  // Adiciona o parêntese após o DDD
  telefone = telefone.replace(/^(\d{2})(\d)/g, '($1) $2');

  // Adiciona o hífen entre o quarto e o quinto dígitos
  telefone = telefone.replace(/(\d)(\d{4})$/, '$1-$2');

  // Atualiza o valor do input
  e.target.value = telefone;
});

document.addEventListener('DOMContentLoaded', function() {
  var message = document.body.getAttribute('data-message');
  if (message) {
    Swal.fire({
      title: 'Mensagem',
      text: message,
      icon: 'info',
      confirmButtonText: 'OK'
    });
  }
});

// VERIFICA QUEM É ADM

function showTable(event) {
  event.preventDefault();

  Swal.fire({
    title: 'Digite a senha para acessar este local:',
    input: 'password',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Acessar',
    cancelButtonText: 'Cancelar',
    showLoaderOnConfirm: true,
    preConfirm: (senha) => {
      if (senha === "9322") {
        return true;
      } else {
        Swal.showValidationMessage('Senha incorreta!');
        return false;
      }
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('tabela-secretaria').style.display = 'block';
      Swal.fire({
        title: 'Acesso permitido!',
        text: 'Senha correta!',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    }
  });
}

function fecharTabela() {
  document.getElementById('tabela-secretaria').style.display = 'none';
}


// tudo funciona ate aqui krl

function showMessage() {
  Swal.fire({
    icon: 'info',
    title: 'Em breve!',
    text: 'Esta funcionalidade estará disponível em breve.',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'OK'
  });
}



