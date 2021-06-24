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
            <form id="cadastroProdutos">
                <legend>CADASTRO DE PRODUTOS</legend><br>
                <label id="codigoProduto">Código do Produto:</label>
                <input id="codigoProduto" type="text" name="codigoProduto" size="8"><br>

                <label id="descricao">Descrição:</label>
                <input id="descricao" type="text" name="descricao" size="35"> <br>

                <label id="codigoDeBarras">Código de Barras:</label>
                <input id="codigoDeBarras" type="text" name="codigoDeBarras" size="25"><br>

                <label id="fornecedor">Fornecedor:</label>
                <input id="fornecedor" type="text" name="fornecedor" size="20"><br>

                <label id="quantidade">Quantidade em Estoque:</label>
                <input id="quantidade" type="text" name="quantidade" size="5"><br>

                <label id="precoVenda">Preço de Venda R$:</label>
                <input id="precoVenda" type="text" name="precoVenda" size="5"> <br>

                <label id="precoCusto">Preço de Custo R$:</label>
                <input id="precoCusto" type="text" name="precoCusto" size="5"> <br>
                <button type="submit" id="btnGravarClientes" name="gravarClientes">Gravar</button>
            </form>
        </section>
        <section id="btn">
            <button id="btnCancelarProdutos" name="cancelarProdutos">Cancelar</button>
            <button id="btnGravarProdutos" name="gravarProdutos">Gravar</button>
            <button id="btnExcluirProdutos" name="excluirProdutos">Excluir</button>
        </section>
</body>

</html>