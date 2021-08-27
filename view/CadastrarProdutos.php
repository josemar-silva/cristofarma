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

                <label id="fornecedor">Fornecedor:</label><br>
                <input id="fornecedor" type="text" name="fornecedor" size="25"><br>

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