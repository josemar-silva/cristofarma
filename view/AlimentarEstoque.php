<?php
    require_once '../model/Produto.php';
    require_once '../model/Estoque.php';
    require_once '../model/ItemCompra.php';
    require_once '../model/Pessoa.php';

    $estoque = new Estoque();
    $produto = new Produto();
    $compra = new ItemCompra();
    $pessoa = new Pessoa();

    $usuarioLogado = $pessoa->login();

                                         // CONDIÇÃO PARA ACESSAR CADASTRO E GERENCIAR ESTOQUE

  if ($usuarioLogado['function'] != 'gerente') {
    echo '<script> alert("Usuário não tem permissão para esta ação!")</script>';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=home.php"/>';
  }
?>

<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Gerenciar Estoque</title>
</head>

<body >    
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

    <div id="divSair"  >
        <a href="AlimentarEstoque.php?sair=<?php echo 1; ?>">Sair</a>
    </div>

    <section id="principalAlimetarEstoque">
        <div id="alimentaEstoque">
            <legend>
                <legend>ALIMENTAR ESTOQUE</legend>
            </legend>

            <?php
                $acaoAtualizaEstoque = filter_input(INPUT_POST, 'gerenciaEstoque'); #filtrar valor que um inpult recebeu

                if ($acaoAtualizaEstoque == 'Atualizar Estoque'){
                    if (isset($_POST['dataCompra']) && isset($_POST['numeroNota'])) {
                        
                        $data_compra = addslashes($_POST['dataCompra']);
                        $numero_nota = addslashes($_POST['numeroNota']);
                        $quantidade_produto_compra = addslashes($_POST['quantidadeAdd']);
                        $id_produto_estoque = addslashes($_GET['id_produto_up_estoque']);
                        $quantidadeAtual = addslashes($_POST['quantidadeEstoque']);

                        if (addslashes($_POST['quantidadeEstoque'] == 0)) {
                            $compra->createItemCompra($data_compra, $numero_nota, $quantidade_produto_compra, $id_produto_estoque);
                            $estoque->createEstoque($quantidade_produto_compra, $id_produto_estoque);

                            echo '<script> alert("Estoque Alimentado com sucesso!")</script>';

                        } else {

                          $compra->createItemCompra($data_compra, $numero_nota, $quantidade_produto_compra, $id_produto_estoque);
                          $estoque->estoqueAdicionar($id_produto_estoque, $quantidade_produto_compra);

                          echo '<script> alert("Estoque Atualizado com sucesso!")</script>';

                        }
                    
                    }
                }
            ?>
 
            <form action="" method="POST">
                <div style="width: 55%; height: 42em; margin-left: auto; margin-right: auto; border:#8b0210 solid 1px; border-radius: 5%; padding: 3%;">

                <div id="adicionaClienteVenda" style="margin-top: 13%; margin-left: 44%;">
                    <a href="ConsultaProdutosUpdateEstoque.php" title="Buscar Produto"><img src="/img/search2.png"></a>
                </div>
               
                <label id="labelDataCompra">Data da compra:</label>&nbsp;
                <input type="date" id="dataCompra" name="dataCompra" class="form-control" style="display: inline; font-size: 13pt;" required></br><br>

                             <label id="labelNumeroNota">Número da nota:</label>&nbsp;
                    <input id="numeroNota" type="text" name="numeroNota" class="form-control" size="15"
                        value="" style="display: inline; font-size: 13pt;" required><br><br><br><br>

                    <label id="labelCodigoProduto">Código do produto:</label>
                    <input id="codigoProduto" type="text" name="codigoProduto" class="form-control" size="5"
                        value="<?php if (isset($_GET['id_produto_up_estoque']) && !empty(['id_produto_up_estoque'])) 
                        {
                                $id_produto_estoque = addslashes($_GET['id_produto_up_estoque']); 
                                    $retornoProduto = $produto->selectProduto($id_produto_estoque); 
                                        if(isset($retornoProduto)){echo $retornoProduto['id_produto'];
                            }
                        }
                            ?>" style="display: inline; font-size: 13pt;" ><br><br>  

                    <label id="labelNomeProduto">Descrição do produto:</label>
                    <input id="nomeProduto" type="text" class="form-control" name="nomeProduto" autofocus size="40" required value="<?php if (isset($_GET['id_produto_up_estoque']) && !empty(['id_produto_up_estoque'])) 
                        {
                                $id_produto_estoque = addslashes($_GET['id_produto_up_estoque']); 
                                    $retornoProduto = $produto->selectProduto($id_produto_estoque); 
                                        if(isset($retornoProduto)){echo $retornoProduto['nome_produto'];
                            }
                        } 
                            ?>" style="display: inline; font-size: 15pt;"><br><br>

                    <label id="labelNomeProduto">Laboratório/Fornecedor:</label>
                    <input id="nomeProduto" type="text" class="form-control" name="nomeProduto" autofocus size="30" required value="<?php if (isset($_GET['id_produto_up_estoque']) && !empty(['id_produto_up_estoque'])) 
                        {
                                $id_produto_estoque = addslashes($_GET['id_produto_up_estoque']); 
                                    $retornoProduto = $produto->selectProduto($id_produto_estoque);

                                    $consultaLike = $retornoProduto['pessoa_id_pessoa'];
                                    $res = $pessoa->selectPessoaFornecedor($consultaLike);

                                        if(isset($retornoProduto)){echo $res[0]['nome'];
                            }
                        } 
                            ?>" style="display: inline; font-size: 15pt;"><br><br> 

                    <label id="labelCodigoBarras">Código de barras:</label>
                    <input id="codigoBarras" type="text" name="codigoBarras " class="form-control" size="30" 
                    value="<?php if (isset($_GET['id_produto_up_estoque']) && !empty(['id_produto_up_estoque'])) 
                        {
                                $id_produto_estoque = addslashes($_GET['id_produto_up_estoque']); 
                                    $retornoProduto = $produto->selectProduto($id_produto_estoque); 
                                        if(isset($retornoProduto)){echo $retornoProduto['codigo_barras'];
                            }
                        }
                            ?>" style="display: inline; font-size: 13pt;"><br><br>

                    <label id="labelQuantidade">Estoque atual (quantidade):</label>&nbsp;
                    <input id="quantidadeEstoque" type="text" class="form-control" name="quantidadeEstoque" autofocus size="5" required
                        value="<?php if (isset($_GET['id_produto_up_estoque']) && 'id_produto_up_estoque' !== NULL) 
                        {
                                $id_prudoto_estoque = addslashes($_GET['id_produto_up_estoque']); 
                                    $retornoConsultaEstoque = $estoque->selectQuantidadeEstoque($id_prudoto_estoque);
                                        if(isset($retornoConsultaEstoque) && $retornoConsultaEstoque != null){                                         
                                                echo $retornoConsultaEstoque['quantidade_estoque']; 
                                        } else {
                                            echo '0';
                                        }
                        } 
                            ?>" style="display: inline; font-size: 13pt;" ><br><br>

                    <label id="labelQuantidade">Quantidade à adcionar:</label>&nbsp;
                    <input id="quantidadeAdd" type="text" class="form-control" name="quantidadeAdd" autofocus size="5" required
                        value=" " style="display: inline; font-size: 13pt;" ><br>
                </div><br>
                        
                        <input class="btn btn-outline-danger" id="gerenciaEstoque" type="submit" name="gerenciaEstoque" 
            style="margin-left: 43%; margin-top: 1%;" onclick="" value="<?php echo 'Atualizar Estoque'; ?>">

            </form>

       
        </div>
    </section>
</body>

</html>