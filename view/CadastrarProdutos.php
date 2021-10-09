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

        if (!empty($produto_nome) && !empty($produto_codigo_barras))  // validar se há ao menos um dado a ser cadastrado
        {
            if (!$produto->createProduto($produto_nome, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $produto_fornecedor)) {
                echo "Produto já está cadastrado!";
            }
        } else {
            echo "Preencha todos os campos!";
        } 
        //echo '<script> alert("Produto cadastrado com sucesso!")</script>';
    }
    ?>

<header>
<nav class="dp-menu">
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="Pesquisar.php">PESQUISAR</a>
                <ul>
                    <li><a href="#">Clientes</a></li>
                    <li><a href="#">Fornecedores</a></li>
                    <li><a href="#">Funcionários</a></li>
                    <li><a href="#">Produtos</a></li>                    
                </ul>
            </li>
            <li><a href="Vendas.php">VENDAS</a></li>
            <li><a href="Caixa.php">CAIXA</a></li>
            <li><a href="CadastrarProdutos.php">PRODUTOS</a>
                 <ul>
                    <li><a href="#">Estoque</a></li>                                        
                </ul>
            </li>
            <li><a href="Cadastros.php">CADASTROS</a></li>
            <li><a href="NotaFiscal.php">NOTA FISCAL</a></li>
            <li><a href="Relatorios.php">RELATÓRIOS</a></li>
        </ul>
    </nav>
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    </header>
        <section id="principal">
            <form id="cadastro" method="POST">
                <legend>CADASTRO DE PRODUTOS</legend><br>

                <label id="descricaoProduto">Descrição:</label>
                <input id="descricaoProduto" type="text" name="descricaoProduto" size="60"> <br>

                <label id="codigoDeBarras">Código de Barras:</label>
                <input id="codigoDeBarras" type="text" name="codigoDeBarras" size="40"><br>

                <label id="fornecedor">Fornecedor:</label>
                <input id="fornecedor" type="text" name="fornecedor" size="30">
                <a href="ConsultaFornecedor.php">+</a><br>

                <label id="precoCusto">Preço de Custo:</label>
                <input id="precoCusto" type="text" name="precoCusto" size="20"> <br>

                <label id="precoVenda">Preço de Venda:</label>
                <input id="precoVenda" type="text" name="precoVenda" size="20"> <br>

                <input class="btn btn-outline-danger" type="submit" id="btnCadastrar" name="btnGravarClientes"
                    value="<?php echo "Cadastrar"; ?>">
            </form>
        </section>

</body>

</html>