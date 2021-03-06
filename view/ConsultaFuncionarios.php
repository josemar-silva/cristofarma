<?php
require_once '../model/Pessoa.php';
$pessoa = new Pessoa();
$usuarioLogado = $pessoa->login(); 

              
?>

<!doctype html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/fontawesome/css/all.css">
  <title>Pesquisar Clientes</title>
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
      <a href="ConsultaFuncionarios.php?sair=<?php echo 1;?>">Sair</a>
    </div>

    <form action="ConsultaFuncionarios.php" method="GET">
      <legend>CONSULTA FUNCIONÁRIOS</legend><br><br>

      <label style="margin-left: 25%;"></label>
      <input type="search" id="buscaFuncionario" class="form-control" name="buscaFuncionario" autofocus value="<?php if (isset($_GET['buscaFuncionario']) && !empty($_GET['buscaFuncionario']))
                                                                                                                  echo $_GET['buscaFuncionario']; ?>" size=" 50" class="form-control-busca" placeholder="Digte aqui para buscar" style="display: inline; font-size: 13pt;">

      <button class="btn btn-outline-danger" id="btnBuscar" onclick="" style="width: 10%; padding: 2px; margin-left: 3%;">Buscar</button><br><br>
    </form>
    <?php

    if (isset($_GET['buscaFuncionario'])) {
      $tipoConsulta = "funcionario";

    ?>
      <div class="tableFixHead"  style="height: 40em;">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th> ID </th>
              <th> NOME DO FUNCIONÁRIO</th>
              <th> CPF/CNPJ</th>
              <th> EMAIL </th>
              <th> TELEFONE FIXO </th>
              <th> TELEFONE CELULAR </th>
              <th> MATRICULA </th>
              <th> FUNCAO </th>
              <th> ENDEREÇO DO FUNCIONÁRIO</th>
              <?php 
                    if ($usuarioLogado['function'] == 'gerente') { 
              ?>       <th> AÇÃO </th> 
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php


            $dados = $pessoa->consultaClienteFornecedorLike($consultaLike = "%" . trim($_GET['buscaFuncionario']) . "%", $tipoConsulta);


            //echo"<pre>"; // organizar o array (matriz de array)
            //var_dump($dados); // imprimir na tela o resultado do array
            //echo"</pre>"; // organizar o array (matriz de array)

            if (count($dados) > 0) {
              for ($i = 0; $i < count($dados); $i++) {
                echo "<tr>"; // abre a linha dos dados selecionados
                foreach ($dados[$i] as $key => $value) {
                  if ($key != "senha" && $key != "tipo_pessoa") // ignorar coluna
                  {
                    echo "<td>" . $value . "</td>";
                  }
                }

      if ($usuarioLogado['function'] == 'gerente') {
          ?>
            <td>
              <a class="acaoVerde" id="acaoEditar" href="AtualizaFuncionario.php?id_get_up=<?php echo $dados[$i]['id_pessoa']; ?>"><i class="fas fa-edit"></i>
                      
              </a>
              <a class="acaoVermelho" id="acaoExcluir" href="ConsultaFuncionarios.php?id_get_del=<?php echo $dados[$i]['id_pessoa']; ?>"><i class="fas fa-trash"></i>
                      
              </a>
              </td>
          <?php
                }
            ?>
                
            <?php
                echo "</tr>"; // fecha linha dos dados selecionados
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    <?php
    }
    ?>
    </section>
</body>

</html>

<?php

if (isset($_GET['id_get_del'])) # verificando se existe dados selecionado para exclusão
{
  $id_up = addslashes($_GET['id_get_del']); # pegar ID desejado no array
  $pessoa->deletePessoa($id_up);
  header("location: ConsultaFuncionarios.php?buscaFuncionario=+"); #atualizar a pagina ao executar a exclusão
}
?>