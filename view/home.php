<!doctype html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
  <link rel="stylesheet" href="../css/estilo.css">

  <title>Home</title>
</head>

<body style="background-color: white;">
  <header>
    <nav class="dp-menu">
      <ul>
        <li><a href="home.php">HOME</a></li>
        <li><a href="#">PESQUISAR</a>
          <ul>
            <li><a href="ConsultaClientes.php">Clientes</a></li>
            <li><a href="ConsultaFornecedor.php">Fornecedores</a></li>
            <li><a href="ConsultaFuncionarios.php">Funcionários</a></li>
            <li><a href="ConsultaProdutos.php">Produtos</a></li>
          </ul>
        </li>
        <li><a href="Vendas.php">VENDAS</a></li>
        <li><a href="Caixa.php">CAIXA</a></li>
        <li><a href="#">PRODUTOS</a>
          <ul>
            <li><a href="CadastrarProdutos.php">Cadastro de Produtos</a></li>
            <li><a href="AlimentarEstoque.php">Estoque de Produtos</a></li>
          </ul>
        </li>
        <li><a href="Cadastros.php">CADASTROS</a></li>
        <li><a href="#">RELATÓRIOS</a>
          <ul>
            <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
            <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>
          </ul>
      </ul>
    </nav>
    <div id="divSair">
      <a id="sair" href="home.php?sair=<?php echo 1; ?>">Sair</a>
    </div>
  </header>

          <?php
              require_once '../model/Pessoa.php';

              $pessoa = new Pessoa();
             
              // CHAMADO A FUNÇÃO QUE CHECA O LOGIN E VERIFICA SE CLICOU EM SAIR PARA DESLOGAR USUÁRIO

              $usuarioLogado = $pessoa->login();
          ?>

  <section id="principalHome" style="padding: 50px;">
    <p>
      <h1 id="nomeEmpresa" style="font-size: 64pt; color: #8b0211; text-align: center;"> DROGARIA CRISTOFARMA PLUS </h1>
    </p>

      <h2 style="font-size: 28pt; color: #8b0211; text-align: center;">Comércio varejista de produtos farmacêuticos, sem manipulação de fórmulas</h2><br>
    
    <fieldset id="missao">
      <legend>
        <h1>Missão:</h1>
      </legend>
      <p style="color: #8b0211;">
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
        sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet,
        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
        sunt in culpa qui officia deserunt mollit anim id est laborum."
      </p> 
    </fieldset>
    <div id="contatos" style="color: #8b0211; text-align: center; margin-top: 5%;">
      <h1>Tele Entregas: (62) 3242-7373</h1>
      <h1>WhatsApp: (62) 98437-1551 / (62) 99279-1340</h1>
    </div>
          <div id="SaidaUsuarioLogado" style="position: absolute; margin-left: -3%; margin-top: 3%; font-size: 10px;"><?php if (isset($usuarioLogado)) {
            echo ('Usuário logado: '.$usuarioLogado['user']);} ?>
          </div>
  </section>
</body>

</html>