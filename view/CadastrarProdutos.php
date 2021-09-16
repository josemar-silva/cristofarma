<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Gerencia Produtos</title>
</head>

<body>
    <?php

    require_once 'Conexao.php';
    require_once 'Pessoa.php';
    require_once 'Produto.php';
    require_once 'Estoque.php';

    $produto = new Produto();
    $estoque = new Estoque();


    if (isset($_POST['descricaoProduto'])) {
        $produto_nome = addslashes($_POST['descricaoProduto']);
        $produto_preco_custo = addslashes($_POST['precoCusto']);
        $produto_preco_venda = addslashes($_POST['precoVenda']);
        $produto_codigo_barras = addslashes($_POST['codigoDeBarras']);
        $produto_fornecedor = addslashes($_POST['fornecedor']);

        $quantidade_estoque = addslashes($_POST['quantidade']);

        if (!empty($produto_nome) && !empty($produto_codigo_barras))  // validar se há ao menos um dado a ser cadastrado
        {
            if (!$produto->createProduto($produto_nome, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $produto_fornecedor, $quantidade_estoque)) {
                echo "Produto já está cadastrado!";
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
    ?>

<header>
    <ul class="nav nav-tabs">
 
            <li class="nav-item">
                <a class="nav-link" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Pesquisar.php">PESQUISAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Vendas.php">VENDAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Caixa.php">CAIXA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="CadastrarProdutos.php">PRODUTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Cadastros.php">CADASTROS</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="NotaFiscal.php">NOTA FISCAL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Relatorios.php">RELATÓRIOS</a>
            </li>
    </ul>
    </header>
        <section id="principal">
            <form id="cadastro" method="POST">
                <legend>CADASTRO DE PRODUTOS</legend><br>

                <label id="descricaoProduto">Descrição:</label><br>
                <input id="descricaoProduto" type="text" name="descricaoProduto" size="40"> <br>

                <label id="codigoDeBarras">Código de Barras:</label><br>
                <input id="codigoDeBarras" type="text" name="codigoDeBarras" size="25"><br>

                <label id="fornecedor">Fornecedor:</label><br>
                <input id="fornecedor" type="text" name="fornecedor" size="25">
                <a href="ConsultaFornecedor.php">+</a><br>

                <label id="quantidade">Quantidade:</label><br>
                <input id="quantidade" type="text" name="quantidade" size="10"><br>

                <label id="precoVenda">Preço de Venda:</label><br>
                <input id="precoVenda" type="text" name="precoVenda" size="10"> <br>

                <label id="precoCusto">Preço de Custo:</label><br>
                <input id="precoCusto" type="text" name="precoCusto" size="10"> <br>

                <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes"
                    value="<?php echo "Cadastrar"; ?>">
            </form>
        </section>
</body>

</html>