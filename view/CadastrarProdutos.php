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
            if (!$produto->createProduto($produto_nome, $produto_fonecedor, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $produto_quantidade)) {
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
            <p><a href="Pesquisar.php">CONSULTAS</a></p>
            <p><a href="Vendas.php">VENDAS</a></p>
            <p><a href="Caixa.php">CAIXA</a></p>
            <p><a href="CadastrarProdutos.php">PRODUTOS</a></p>
            <p><a href="CadastrarFornecedores.php">FORNECEDOR</a></p>
            <p><a href="CadastrarClientes.php">CLIENTES</a></p>
            <p><a href="CadastrarUsuarios.php">USUÁRIOS</a></p>
            <p><a href="NotaFiscal.php">NOTA FISCAL</a></p>
            <p><a href="Relatorios.php">RELATÓRIO</a></p>
        </section>
        <section id="principal">
            <form id="cadastro" method="POST">
                <legend>CADASTRO DE PRODUTOS</legend><br>

                <label id="descricao">Descrição:</label><br>
                <input id="descricao" type="text" name="descricaoProduto" size="40"> <br>

                <label id="codigoDeBarras">Código de Barras:</label><br>
                <input id="codigoDeBarras" type="text" name="codigoDeBarras" size="25"><br>

                <label id="IdFornecedor">ID Fornecedor:</label><br>
                <input id="IdFornecedor" type="text" name="IdFornecedor" size="25"><br>

                <label id="quantidade">Qtd em Estoque:</label><br>
                <input id="quantidade" type="text" name="quantidadeProduto" size="10"><br>

                <label id="precoVenda">Preço de Venda:</label><br>
                <input id="precoVenda" type="text" name="precoVenda" size="10"> <br>

                <label id="precoCusto">Preço de Custo:</label><br>
                <input id="precoCusto" type="text" name="precoCusto" size="10"> <br>

                <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes"
                    value="<?php echo "Cadastar"; ?>">
            </form>
        </section>
</body>

</html>