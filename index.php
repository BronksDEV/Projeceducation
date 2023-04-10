<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <script src="https://kit.fontawesome.com/3a7225da88.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" />
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="login.php" class="sign-in-form" method="POST">
                    <h2 class="signin title">Login</h2>

                    <div class="input-field">
                        <i class="fas  fa-user"></i>
                        <input type="text" name="username" placeholder="Nome" required>
                    </div>
                    
                    <div class="input-field">
                        <i class="fas  fa-lock"></i>
                        <input type="password" name="password" placeholder="Senha" required>
                    </div>
                    <p class="error-message" id="login-error"></p>
                    <input type="submit" value="ENTRAR" class="btn solid">
                    <div class="error-message">
                        
                    </div>
                </form>

                <form action="register.php" class="sign-up-form" method="POST">
                    <h2 class="signup title">CADASTRO</h2>

                    <div class="input-field">
                        <i class="fas  fa-user"></i>
                        <input type="text" name="username" placeholder="Nome" required>
                    </div>
                    
                    <div class="input-field">
                        <i class="fas  fa-envelope"></i>
                        <input type="text" name="email" placeholder="Email" required>
                    </div>
                    
                    <div class="input-field">
                        <i class="fas  fa-lock"></i>
                        <input type="password" name="password" placeholder="Senha" required>
                    </div>

                    <input type="submit" value="CADASTRAR" class="btn solid">
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Novo aqui?</h3>
                    <p>Faça seu cadastro agora mesmo.</p>
                    <button class="btn transparent" id="sign-up-btn">Cadastrar-se</button>
                </div>

                <img src="undraw_maker_launch_crhe.svg" class="image" alt="Rock">
            </div>


            <div class="panel right-panel">
                <div class="content">
                    <h3>Já tem uma conta?</h3>
                    <p>Faça Login agora mesmo.</p>
                    <button class="btn transparent" id="sign-in-btn">Entrar</button>
                </div>

                <img src="undraw_press_play_bx2d.svg" class="image" alt="Rock">
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.2.0/sweetalert2.min.js"></script>
    <script src="app.js"></script>
</body>

</html>