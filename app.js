document.addEventListener('DOMContentLoaded', () => {
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");
  
    sign_up_btn.addEventListener('click', () => {
      container.classList.add('sign-up-mode');
    });
  
    sign_in_btn.addEventListener('click', () => {
      container.classList.remove('sign-up-mode');
    });
  
    const signInForm = document.querySelector('.sign-in-form');
    const loginError = document.getElementById('login-error');
  
    signInForm.addEventListener('submit', async (event) => {
      event.preventDefault();
  
      const formData = new FormData(signInForm);
      const response = await fetch('login.php', {
        method: 'POST',
        body: formData
      });
  
      const jsonResponse = await response.json();
  
      if (jsonResponse.error) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: jsonResponse.error
        });
      } else {
        window.location.href = 'painel.php';
      }
    });
  
    const signUpForm = document.querySelector('.sign-up-form');
  
    signUpForm.addEventListener('submit', async (event) => {
      event.preventDefault();
  
      const formData = new FormData(signUpForm);
      const response = await fetch('register.php', {
        method: 'POST',
        body: formData
      });
  
      const jsonResponse = await response.json();
  
      if (jsonResponse.error) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: jsonResponse.error
        });
      } else {
        Swal.fire({
          icon: 'success',
          title: 'Cadastro realizado com sucesso',
          showConfirmButton: false,
          timer: 1500
        }).then(() => {
          window.location.href = 'index.html';
        });
      }
    });
});
