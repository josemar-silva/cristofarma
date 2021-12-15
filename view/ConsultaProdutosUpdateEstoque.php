<?php
require_once '../model/Produto.php';
require_once '../model/Pessoa.php';
require_once '../model/Estoque.php';

$produto = new Produto();
$pessoa = new Pessoa();
$estoque = new Estoque();
$usuarioLogado = $pessoa->login();

?>

<!doctype html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/fontawesome/css/all.css">
  <title>Pesquisar Produtos</title>
</head>

<body>
    <header>

    </header>
    <?php
    if (isset($_GET['pesquisa']))   # select produto pela id enviada no metodo _GET
    {
        $id_up = addslashes($_GET['pesquisa']);
        $retornoConsulta = $produto->selectProduto($id_up); #retorno da consulta armazenado na variavel $retornoConsulta
        echo $id_up;
    }
    ?>
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
    </header>

    <section id="principalConsultaProdutos">
        <div id="divSair">
            <a href="ConsultaProdutos.php?sair=<?php echo 1;?>">Sair</a>
        </div>

        <form action="ConsultaProdutosUpdateEstoque.php" method="GET">
            <legend>CONSULTA PRODUTOS</legend><br><br>

            <label style="margin-left: 25%;"></label>
            <input type="search" id="buscaProdutos" class="form-control" name="buscaProdutoUpestoque" autofocus value="<?php if (isset($_GET['buscaProdutoUpestoque']) && !empty($_GET['buscaProdutoUpestoque']))
                                                                                                                    echo $_GET['buscaProdutoUpestoque'];?>" size=" 50" class="form-control-busca" placeholder="Digte aqui para buscar" style="display: inline; font-size: 13pt;">
            <button class="btn btn-outline-danger" id="btnBuscar" onclick="" style="width: 10%; padding: 2px; margin-left: 3%;">Buscar</button><br><br>
        </form>

                                 <!---------------------- BUSCA %like% = 'quem contem'... ----------------------->

                    <?php
                    
                        if (isset($_GET['buscaProdutoUpestoque'])) {
                    ?>
                            <div class="tableFixHead">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> NOME DO PRODUTO </th>
                                    <th> PREÇO CUSTO </th>
                                    <th> PREÇO VENDA </th>
                                    <th> CÓDIGO DE BARRAS </th>
                                    <th> LABORATÓRIO </th>
                                    <th style="width: 5%;"> ESTOQUE</th>
                                    <th> AÇÃO </th> 
                                </tr>
                            </thead>
            
                            <tbody>
                    <?php
                        $dados = $produto->consultaProdutoLike($consultaLike = "%" . trim($_GET['buscaProdutoUpestoque']) . "%");

                        if (count($dados) > 0)  
                        {
                            for ($i = 0; $i < count($dados); $i++) {
                                echo "<tr>";
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key != "pessoa_id_pessoa") 
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == "pessoa_id_pessoa")
                                    {
                                        $id_up = $value;
                                        $return = $pessoa->selectPessoaFornecedor($id_up);
                                        $result = $return[0]['nome'];

                                        echo "<td>" . $result . "</td>";
                                    }
                                }

                                $returnEstoque = $estoque->selectQuantidadeEstoque($dados[$i]['id_produto']);

                                if ($returnEstoque != null) {
                                    echo '<td>'.$returnEstoque['quantidade_estoque'].'</td>';
                                } else {
                                    echo "<td>"; echo 'null'; echo "</td>";
                                }
                    ?>
                                <td>
                                    <a class="" id="acaoSelecionar" href="AlimentarEstoque.php?id_produto_up_estoque=<?php echo $dados[$i]['id_produto']; ?>"><i class="fas fa-hand-pointer"></i><!--Selecionar--></a>
                                </td>
                    <?php
                                echo "</tr>"; // fecha linha dos dados selecionados
                            }
                        }
                        }                        
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
<?php // FUNÇAO PARA DELETER PRODUTO PELA ID

if (isset($_GET['id_get_del'])) # verificando se existe dados selecionado para exclusão
{
  $id_up = addslashes($_GET['id_get_del']); # pegar ID desejado no array
  $produto->deleteProduto($id_up);
  header("location: ConsultaProdutos.php?buscaProdutos=+"); #atualizar a pagina ao executar a exclusão
}
?>