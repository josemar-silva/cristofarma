<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

    <title>Gerencia Produtos</title>
</head>

<body>
    <?php

    require_once '../model/Conexao.php';
    require_once '../model/Pessoa.php';
    require_once '../model/Produto.php';
    require_once '../model/Estoque.php';

    $produto = new Produto();
    $estoque = new Estoque();
    $pessoa = new Pessoa();


    if (isset($_POST['descricaoProduto'])) {
        $produto_nome = addslashes($_POST['descricaoProduto']);
        $produto_preco_custo = addslashes($_POST['precoCusto']);
        $produto_preco_venda = addslashes($_POST['precoVenda']);
        $produto_codigo_barras = addslashes($_POST['codigoDeBarras']);
        $produto_fornecedor = addslashes($_POST['fornecedor']);

        if (!empty($produto_nome) && !empty($produto_codigo_barras))  // validar se há ao menos um dado a ser cadastrado
        {
            if (!$produto->createProduto($produto_nome, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $produto_fornecedor)) {
                echo "Produto já está cadastrado!";
            }
        } else {
            echo '<script> alert("Preencha todos os campos!")</script>';
        } 
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
            <li><a href="CupomFiscal.php">CUPOM FISCAL</a></li>
            <li><a href="#">RELATÓRIOS</a>
                <ul>
                    <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
                    <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>                                        
                </ul>
        </ul>
    </nav>
    <div id="divSair" >
        <a href="index.php">Sair</a>
    </div>

    </header>
        <section id="principal">
            <form id="cadastro" method="POST">
                <legend>CADASTRO DE PRODUTOS</legend><br>

                <label for="fornecedor">Fornecedor:</label><br>
                <input id="fornecedor" class="form-control" type="text" type="text" autofocus required  
                    name="fornecedor" size="25" value="<?php if (isset($_GET['id_fornecedor_produto_get_up'])){ $id_fornecedor_produto_get_up = addslashes($_GET['id_fornecedor_produto_get_up']); 
                        $retornoConsulta = $pessoa->selectPessoaFornecedor($id_fornecedor_produto_get_up); if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome'];}}?>"><br><br>

                <div id="selecionarFornecedor">
                <a href="ConsultaFornecedor.php?buscaFornecedor=+" id="alinhamento" title="Selecionar Laboriatório"><img src="/img/search2.png"></a>
                </div><br><br>
                
                <label for="descricaoProduto"> Descrição do Produto:</label><br>
                <input id="descricaoProduto" class="form-control"  type="text" name="descricaoProduto" required size="50"> <br><br>
                
                <label for="codigoDeBarras"> Código de Barras:</label><br>
                <input id="codigoDeBarras" class="form-control"  type="text" type="text" name="codigoDeBarras" maxlength="40" required size="40"><br><br>              

                <label for="precoCusto">Preço de Custo:</label><br>
                <input id="precoCusto" class="form-control"  placeholder="R$" type="text" type="text" name="precoCusto" required size="10"><br><br>
                
                <label for="precoVenda">Preço de Venda:</label><br>
                <input id="precoVenda" class="form-control"  placeholder="R$" type="text" type="text" name="precoVenda" required size="10"><br> <br>

                <input class="btn btn-outline-danger" type="submit" id="btnCadastrar" name="btnGravarClientes" style="margin-left: 40%; margin-top: 5%;"
                    value="<?php echo "Cadastrar"; ?>">
            </form>
        </section>
</body>

</html>