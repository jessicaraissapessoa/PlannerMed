<?php
date_default_timezone_set('America/Sao_Paulo');
session_start(); // inicia a sessão
include('conexao.php');

$login = $_SESSION['login'];

// Obtém a data e hora atual no formato do banco de dados (ano-mês-dia hora:minuto:segundo)
$agora = date('Y-m-d H:i:s');

// Calcula o intervalo de tempo de 1 minuto antes e depois do horário atual
$intervalo_inicio = date('Y-m-d H:i:s', strtotime($agora) - 60);
$intervalo_fim = date('Y-m-d H:i:s', strtotime($agora) + 60);
// Isso é feito para considerar uma margem de segurança na verificação dos alarmes
// e garantir que nenhum alarme relevante seja perdido devido a pequenas variações de tempo.

// Consulta SQL para buscar os alarmes cujo horário esteja dentro do intervalo de tempo
$select = "SELECT me_horario.*, me_medicamento.nome_medicamento
           FROM me_horario
           INNER JOIN me_medicamento ON me_horario.id_medicamento = me_medicamento.id_medicamento
           WHERE me_horario.login = '$login'
           AND me_horario.horario >= '$intervalo_inicio'
           AND me_horario.horario <= '$intervalo_fim'";

$query_alarmes = mysqli_query($conexao, $select);

if (mysqli_num_rows($query_alarmes) > 0) {
  // Exibe o alerta para o usuário com os medicamentos cujo horário esteja dentro do intervalo
  while ($dado_alarme = mysqli_fetch_assoc($query_alarmes)) {
    $nomeMedicamento = $dado_alarme['nome_medicamento'];
    echo "<script>alert('Hora de tomar o remédio: $nomeMedicamento');</script>";
    echo "<audio autoplay><source src='audio/alarme_clock_audio_ringtone.mp3' type='audio/mpeg'></audio>";
  }
} else {
  // Se não houver alarmes no horário atual, agendamos a próxima verificação em 1 minuto
  echo "<script>setTimeout(function() { location.reload(); }, 60000);</script>";
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style_cad_dependente.css">
  <title>Cadastrar Dependente</title>
</head>

<body>
  <center>
    <div id="nav">
      <div id="logo">
        <a href="login.php">
          <img src="img/logo_plannermed.png">
        </a>
      </div>

      <div id="menu">
        <ul>
          <li><a href="principal.php" class="active">Diário</a></li>
          <li><a href="remedios.php">Remédios</a></li>
          <li><a href="addDependente.php">Depedentes</a></li>
          <li><a href="sobre.php">Sobre nós</a></li>
        </ul>
      </div>

      <div id="perfil">
        <img src="img/icon-usuario-dependente-2.svg">
        <label id="nome_perfil"><?php echo $login ?></label>
      </div>

      <div id="menuUser">
        <i id="burguer" class="material-icons" onclick="clickMenu()">menu</i>
        <menu id="itens">
          <ul>
            <li><a href="perfil.php">Dados do perfil</a></li>
            <li><a href="historico.php">Histórico</a></li>
            <li><a href="login.php">Sair</a></li>
          </ul>
        </menu>
      </div>
    </div>
    <div class="box-one">
      <main>
        <h1 id="tituloArea">Cadastrar Novo Perfil de Dependente</h1> <br>
        <form action="cad_dependente_scipting.php" method="POST">
          
          <div id="espacoForm">
            <!-- cadastrar o nome -->
            <label for="nomeDependente">Nome do Dependente:</label>
            <input type="text" name="nomeDependente" required>
          </div>

          <div id="espacoForm">
            <!-- cadastra login -->
            <label for="login_dep">Login:</label>
            <input type="text" name="login_dep" required>
          </div>

          <div id="espacoForm">
            <!-- cadastrar o email -->
            <label for="email">Inserir o e-mail do dependente:</label>
            <input type="email" name="email" required>
          </div>

          <div id="espacoForm">
            <!-- cadastrar senha -->
            <label for="senha">Inserir senha:</label>
            <input type="password" name="senha" required>
          </div>

          <div id="botao">
            <button type="submit" name="cadastrarDependente">Cadastrar</button>
          </div>
          
        </form>
        <form action="addDependente.php">
          <button type="submit" id="botao-voltar">Voltar</button>
        </form>
      </main>
    </div>
    <script>
      // Seleciona a imagem de seta pelo ID
      const setaImg = document.getElementById('seta-img');

      // Seleciona o menu-dropdown pelo ID
      const menuDropdown = document.getElementById('menu-dropdown');

      // Adiciona um evento de clique à imagem de seta
      setaImg.addEventListener('click', function() {
        // Verifica se o menu-dropdown está visível
        const isMenuVisible = menuDropdown.style.display === 'block';

        // Alterna a visibilidade do menu-dropdown
        if (isMenuVisible) {
          menuDropdown.style.display = 'none'; // Oculta o menu-dropdown
        } else {
          menuDropdown.style.display = 'block'; // Exibe o menu-dropdown
        }
      });
      // Supondo que o login esteja armazenado em uma variável chamada "login"
      const login = "<?php echo $_SESSION['login']; ?>";

      setInterval(function() {
        console.log(`Verificando alarmes às ${moment().format('YYYY-MM-DD HH:mm:ss')}`);
        tocarAlarmes(login);
      }, 60000); // Verificar a cada 1 minuto (60000 milissegundos)
    </script>
    <script>
      function clickMenu() {
        if (itens.style.display == 'block') {
          itens.style.display = 'none'; //se estiver visível, ao clicar oculta
        } else {
          itens.style.display = 'block'; //se não, revela
        }
      }
    </script>
  </center>
  </div>
  </div>
</body>

</html>