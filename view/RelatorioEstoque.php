<?php
  require_once '../model/Pessoa.php';

  $pessoa =  new Pessoa();
  $usuarioLogado = $pessoa->login();
?>
<!doctype html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <title>Relatórios</title>
</head>

<body>
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
      <a href="RelatorioEstoque.php?sair=<?php echo 1;?>">Sair</a>
    </div>

    </header>
    <section id="principalEstoque">
        <div id="relatorioGerencialVendas" style="margin-left: 5%;">
                <legend style="text-align: left;">RELATÓRIO GERAL DE ESTOQUE</legend><br>

      
      <div id="imgRelatorio" style=" float: right; background-repeat: no-repeat; overflow: hidden; background-image: url(../img/comprimido.png); width: 40%; height: 42em;
               background-size: 93%; opacity: 0.3; margin-right: 3%;">   
      </div>
            
            <input type="radio" id="estoque" name="tipoRelatorioEstoque" value="estoque" checked>&nbsp; &nbsp;
            <label for="estoque" style="font-size: 13pt;">Relatório de Estoque</label><br><br>

      <div id="imgRelatorio" style=" float: left; background-repeat: no-repeat; overflow: hidden; background-image: url(../img/pilulas.png); width: 30%; height: 30em;
              background-size: 90%; opacity: 0.3; margin-left: 10%; margin-top: 7%;">   
      </div>


<form action="RelatorioEstoqueSaida.php" method="POST">

            
<button class="btn btn-outline-danger" id="btnGerarRelatorioGerencial" name="btnGerarRelatorioGerencial" onclick="" style="margin-left: auto; margin-right: auto; margin-top: 34%; position: absolute">Gerar Relatório</button>
</form>        
      </div>
    </section>
</body>

</html>