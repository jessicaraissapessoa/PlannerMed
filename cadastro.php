<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style_cadastro.css">
</head>

<body>

    <div class="container">

        <Center>

            <div class="box-one">
                <div class="box-logo">
                    <a href="login.php">
                        <img src="img/logo_plannermed.png" class="logo-image">
                    </a>
                </div>

                <div id="formulario_de_cadastro">
                    <form action="cadastro_scripting.php" method="post" onsubmit="return validateForm()">

                        <ul>
                            <li id="tituloArea">Digite seu nome:</li>
                            <li>
                                <input type="text" name="nome" id="nome" required required oninput="validateNome()">
                            </li>
                            <li id="feedback">
                                <span class="feedback" id="nome-feedback"></span>
                            </li>
                        </ul>

                        <ul>
                            <li id="tituloArea">Digite seu login (nome de usuário):</li>
                            <li>
                                <input type="text" name="login" id="login" required oninput="validateLogin()">
                            </li>
                            <li id="feedback">
                                <span class="feedback" id="login-feedback"></span>
                            </li>
                        </ul>

                        <ul>
                            <li id="tituloArea">Digite seu e-mail:</li>
                            <li>
                                <input type="email" name="email" id="email" required onkeyup="validateEmail()">
                            </li>
                            <li id="feedback">
                                <span class="feedback" id="email-feedback"></span>
                            </li>
                        </ul>

                        <ul>
                            <li id="tituloArea">Digite sua senha:</li>
                            <li>
                                <input type="password" name="senha" id="senha" required onkeyup="validatePassword()">
                            </li>
                            <li id="feedback">
                                <span class="feedback" id="senha-feedback"></span>
                            </li>
                        </ul>

                        <ul>
                            <li id="tituloArea">Confirme sua senha:</li>
                            <li>
                                <input type="password" name="confirma" id="confirma" required onkeyup="validatePassword()">
                            </li>
                            <li id="feedback">
                                <span class="feedback" id="senha-feedback"></span>
                            </li>
                        </ul>

                        <ul>
                            <li id="tituloArea">Informe tipo de usuário</li>
                            <li>
                                <select name="tipo_usuario" id="tipo_usuario">
                                    <option value="1">Usuário comum</option>
                                    <option value="2">Dependente</option>
                                </select>
                            </li>
                        </ul>

                        <p>Mostrar Senha:<input id="resetar" type="checkbox" onclick="mostrarOcultarSenha()"></p>

                        <button type="submit" id="cadastrar">Cadastrar</button>

                    </form>

                    <form action="login.php">
                        <button type="submit" id="voltar">Voltar</button>
                    </form>
                </div>
            </div>

        </Center>
    </div>

    <script>
        //Verifica se o campo nome está em branco ou preenchido
        function validateNome() {
            var nomeInput = document.getElementById("nome");
            var nomeFeedback = document.getElementById("nome-feedback");
            var nome = nomeInput.value;

            if (nome.trim() === "") {
                nomeFeedback.textContent = "O campo de nome não pode estar em branco.";
                nomeInput.style.backgroundColor = "lightcoral";
            } else {
                nomeFeedback.textContent = "";
                nomeInput.style.backgroundColor = "lightgreen";
            }
        }

        //Verifica se o login tem espaços entre os caracteres e os remove
        function validateLogin() {
            var loginInput = document.getElementById("login");
            var loginFeedback = document.getElementById("login-feedback");
            var login = loginInput.value;

            if (login.includes(" ")) {
                loginInput.value = login.replace(/\s/g, ""); // Remover espaços
                loginFeedback.textContent = "O login não pode conter espaços. Espaços removidos automaticamente.";
                loginInput.style.backgroundColor = "lightcoral";

            } else {
                loginFeedback.textContent = "";
                loginInput.style.backgroundColor = "lightgreen";
            }
        }

        //Verifica se oq está sendo digitado na caixa email é realmente um email
        function validateEmail() {
            var emailInput = document.getElementById("email");
            var emailFeedback = document.getElementById("email-feedback");
            var email = emailInput.value;

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailRegex.test(email)) {
                emailInput.style.backgroundColor = "lightgreen";
                emailFeedback.textContent = "";
            } else {
                emailInput.style.backgroundColor = "lightcoral";
                emailFeedback.textContent = "Por favor, insira um email válido.";
            }
        }

        //Quando selecionado mostra a senha que o usuário digitou
        function mostrarOcultarSenha() {
            let senha = document.getElementById("senha");
            if (senha.type == "password") {
                senha.type = "text";
            } else {
                senha.type = "password";
            }
        }

        //Valida a senha se ela é igual a confirmar senha 
        function validatePassword() {
            var senhaInput = document.getElementById("senha");
            var confirmaInput = document.getElementById("confirma");
            var senhaFeedback = document.getElementById("senha-feedback");
            var confirmaFeedback = document.getElementById("confirma-feedback");

            var senha = senhaInput.value;
            var confirmaSenha = confirmaInput.value;

            if (senha === confirmaSenha) {
                senhaInput.style.backgroundColor = "lightgreen";
                confirmaInput.style.backgroundColor = "lightgreen";
                senhaFeedback.textContent = "";
                confirmaFeedback.textContent = "";
            } else {
                senhaInput.style.backgroundColor = "lightcoral";
                confirmaInput.style.backgroundColor = "lightcoral";
                senhaFeedback.textContent = "As senhas não coincidem. Por favor, verifique novamente.";
                confirmaFeedback.textContent = "As senhas não coincidem. Por favor, verifique novamente.";
            }
        }
        
        function validateForm() {
            var inputs = document.querySelectorAll("input");
            var invalidFields = false;

            inputs.forEach(function (input) {
                if (input.style.backgroundColor === "lightcoral") {
                    invalidFields = true;
                }
            });

            if (invalidFields) {
                return false; // Cancela o envio do formulário
            }

            return true; // Permite o envio do formulário
        }
    </script>
</body>

</html>