<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Gerencia Produtos</title>
</head>

<body>
    <header>

    </header>

    <?php

require_once 'Produto.php';
require_once 'Estoque.php';


    $produto = new Produto();

    if (isset($_POST['descricaoProduto'])) {
        $produto_nome = addslashes($_POST['descricaoProduto']);
        $produto_fonecedor = addslashes($_POST['IdFornecedor']);
        $produto_quantidade = addslashes($_POST['quantidadeProduto']);
        $produto_preco_custo = addslashes($_POST['precoCusto']);
        $produto_preco_venda = addslashes($_POST['precoVenda']);
        $produto_codigo_barras = addslashes($_POST['codigoDeBarras']);
        if (!empty($produto_nome) && !empty($produto_codigo_barras))  // validar se há ao menos um dado a ser cadastrado
        {
            if (!$produto->createProduto($produto_nome, $produto_fonecedor, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras,$produto_quantidade)) {
                echo "Produto já está cadastrado!";
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
    ?>

    <section>
        <section id="menu">
            <p><a href="index.php">HOME</a></p>
            <p><a href="Vendas.php">VENDAS</a></p>
            <p><a href="Caixa.php">CAIXA</a></p>
            <p><a href="Produtos.php">PRODUTOS</a></p>
            <p><a href="Fornecedores.php">FORNECEDOR</a></p>
            <p><a href="Clientes.php">CLIENTES</a></p>
            <p><a href="Usuarios.php">USUÁRIOS</a></p>
            <p><a href="NotaFiscal.php">NOTA FISCAL</a></p>
            <p><a href="Relatorios.php">RELATÓRIO</a></p>
        </section>
        <section id="principal">
            <form id="cadastroProdutos" method="POST">
                <legend>CADASTRO DE PRODUTOS</legend><br>

                <label id="descricao">Descrição:</label>
                <input id="descricao" type="text" name="descricaoProduto" size="35"> <br>

                <label id="codigoDeBarras">Código de Barras:</label>
                <input id="codigoDeBarras" type="text" name="codigoDeBarras" size="25"><br>

                <label id="IdFornecedor">ID Fornecedor:</label>
                <input id="IdFornecedor" type="text" name="IdFornecedor" size="20"><br>

                <label id="Nomefornecedor">Nome do Fornecedor:</label>
                <input id="Nomefornecedor" type="text" name="Nomefornecedor" size="20"><br>

                <label id="quantidade">Quantidade em Estoque:</label>
                <input id="quantidade" type="text" name="quantidadeProduto" size="5"><br>

                <label id="precoVenda">Preço de Venda R$:</label>
                <input id="precoVenda" type="text" name="precoVenda" size="5"> <br>

                <label id="precoCusto">Preço de Custo R$:</label>
                <input id="precoCusto" type="text" name="precoCusto" size="5"> <br>

                <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes" value="<?php echo "Cadastar"; ?>">
            </form>
        </section>
</body>

</html>